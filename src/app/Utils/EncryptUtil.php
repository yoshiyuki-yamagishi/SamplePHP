<?php
/**
 * 暗号化・復合化のユーティリティクラス
 *
 */

namespace App\Utils;

use MessagePack\MessagePack;
use App\Utils\DebugUtil;

/**
 * 暗号化・復合化のユーティリティクラス
 *
 */
class EncryptUtil {

    const FALSIFICATION_PREFIX = 'BB-';        // 接頭辞
    const FALSIFICATION_SUFFIX = '-DW4649Ne';    // 接尾辞

    // デバッグ用 (リリース時には、true)
    const DECRYPT_REQUEST = true;
    const ENCRYPT_RESPONSE = true;

    /**
     * リクエストを複合化するか返す
     *
     * @return boolean true: 複合化する, false: しない
     */
    public static function isDecryptRequest() {
        if (config('app.debug')) {
            return false;
        }
        return self::DECRYPT_REQUEST;
    }

    /**
     * レスポンスを暗号化するか返す
     *
     * @return boolean true: 暗号化する, false: しない
     */
    public static function isEncryptResponse() {
        if (config('app.debug')) {
            return false;
        }
        return self::ENCRYPT_RESPONSE;
    }

    /**
     * 暗号化、複合化を行う。
     *
     * @param string $data 暗号化、複合化を行うデータ
     * @return string 暗号化、複合化したデータ
     */
    public static function encryptDecryptData($data) {
        // 現在は、暗号化も、複合化も同じコード (対称) //
        if (config('app.unusecrypt') === true) {
            return $data;
        }
        $len = intdiv(strlen($data), 4) * 4;
        // $len = floor(strlen($data) / 4) * 4;

        for ($i = 0; $i < $len; $i += 4) {
            $a = ord($data[$i + 0]);
            $b = ord($data[$i + 1]);
            $c = ord($data[$i + 2]);
            $d = ord($data[$i + 3]);

            if ($a != 0x00 || $a != 0xAC) {
                $data[$i + 0] = chr($a ^ 0xAC);
            }
            if ($b != 0x00 || $b != 0xBD) {
                $data[$i + 1] = chr($b ^ 0xBD);
            }
            if ($c != 0x00 || $c != 0xCE) {
                $data[$i + 2] = chr($c ^ 0xCE);
            }
            if ($d != 0x00 || $d != 0xDF) {
                $data[$i + 3] = chr($d ^ 0xDF);
            }
        }

        return $data;
    }


    /**
     * 暗号化を行う。
     *
     * @param string $data 暗号化を行うデータ
     * @return string 暗号化したデータ
     */
    public static function encryptData($data) {
        return self::encryptDecryptData($data);
    }

    /**
     * 復号化を行う。
     *
     * @param string $data 復号化を行うデータ
     * @return string 復号化したデータ
     */
    public static function decryptData($data) {
        return self::encryptDecryptData($data);
    }

    /**
     * レスポンスの暗号化を行う。
     *
     * @param array $data 暗号化を行うデータ
     * @return string 暗号化したデータ
     */
    public static function encryptResponse($data) {
        $data = MessagePack::pack($data);

        return self::encryptData($data);
    }

    /**
     * レスポンスの複合化を行う。
     *
     * @param string $data 復号化を行うデータ
     * @return array 復号化したデータ
     */
    public static function decryptResponse($data) {
        $data = self::decryptData($data);

        return MessagePack::unpack($data);
    }

    /**
     * データチェック用ハッシュ値を計算する
     *
     * @param string data データ
     * @return string ハッシュ値
     */
    public static function calcCode($data) {
        $d = self::FALSIFICATION_PREFIX.$data.self::FALSIFICATION_SUFFIX;

        $code = md5($d);
        // DebugUtil::e_log('calcCode', 'data', $d);
        // DebugUtil::e_log('calcCode', 'code', $code);
        return $code;
    }

    /**
     * リクエストパラメータの暗号化を行う。
     *
     * @param array $req_data 暗号化を行うリクエストパラメータ
     * @param string $req_code 改ざんチェック文字列を返す
     * @return string 暗号化したデータ
     */
    public static function encryptRequest($req_data, &$req_code) {
        // メッセージパック
        $req_data = MessagePack::pack($req_data);

        // 暗号化
        $req_data = self::encryptData($req_data);

        // Base64エンコード

        $req_data = base64_encode($req_data);

        // URL エンコード

        $req_data = urlencode($req_data);

        // チェックコード生成
        $req_code = self::calcCode($req_data);
        return $req_data;
    }

    /**
     * リクエストパラメータの復号化を行う。
     *
     * @param string $req_data 復号化を行うリクエストパラメータ
     * @param string $req_code 改ざんチェック文字列
     * @return array 復号化したデータ
     */
    public static function decryptRequest($req_data, $req_code) {

        // チェックコード比較
        $code = self::calcCode($req_data);
        if ($code != $req_code) {
            // DebugUtil::e_log('decryptRequest', '! true code is: ', $code);
            return [];
        }

        // URL デコード

        $req_data = urldecode($req_data);

        // Base64デコード

        $req_data = base64_decode($req_data);

        // 複合化
        $req_data = self::decryptData($req_data);

        if (!isset($req_data)) {
            return [];
        }

        // form 形式
        // parse_str($req_data, $ret);
        // return $ret;

        // メッセージパック形式
        return MessagePack::unpack($req_data);
    }

    /**
     * リクエストパラメータをダンプ出力する
     *
     * @param string $request 暗号化を行うリクエストパラメータ
     */
    public static function dumpRequest($request) {
        $params = $request->all();
        if (isset($params['__req_data'])) {
            unset($params['__req_data']);
        }
        if (isset($params['__req_code'])) {
            unset($params['__req_code']);
        }

        // メッセージパック
        $packed = MessagePack::pack($params);

        // 暗号化
        $encrypted = self::encryptData($packed);

        // Base64エンコード
        $base64 = base64_encode($encrypted);

        // URL エンコード
        $req_data = urlencode($base64);

        // チェックコード生成
        $req_code = self::calcCode($req_data);

        // Postman 向けにもう 1 回エンコードしたもの
        $urlEncoded = urlencode($req_data);

        // 正規の API との整合性チェック //
        {
            $_code = null;
            $_data = self::encryptRequest($params, $_code);
            if ($_data != $req_data) {
                DebugUtil::e_log('dumpRequest', 'invalid data !!', '');
            }
            if ($_code != $req_code) {
                DebugUtil::e_log('dumpRequest', 'invalid code !!', '');
            }
        }

        // 復元してみるチェック//
        {
            $_params = self::decryptRequest($req_data, $req_code);
            if ($_params != $params) {
                DebugUtil::e_log('dumpRequest', 'restore failed !!', $_params);
            }
        }

        DebugUtil::e_log('dumpRequest', 'params', $params);
        DebugUtil::e_log('dumpRequest', 'params (JSON)', json_encode($params));
        DebugUtil::e_log('dumpRequest', 'base64', $base64);
        DebugUtil::e_log('dumpRequest', '__req_data', $req_data);
        DebugUtil::e_log('dumpRequest', '__req_code', $req_code);
        DebugUtil::e_log('dumpRequest', 'urlEncoded', $urlEncoded);
    }

    /**
     * シナリオから送られてくるデーターをエンコードする
     * @param $req_data
     * @param $req_code
     */
    public static function debugRequestEncrypt(&$req_data, &$req_code) {

        $req_data = json_decode($req_data, true);

        // メッセージパック
        $req_data = MessagePack::pack($req_data);
        // 暗号化
        $req_data = self::encryptData($req_data);
        // Base64エンコード
        $req_data = base64_encode($req_data);
        // URL エンコード
        $req_data = urlencode($req_data);

        //req_code md5
        $req_code = self::calcCode($req_data);

    }


    /**
     * @param $ret
     */
    public static function debugResponseDecrypt($ret) {
        $data = self::encryptData($ret);
        return json_encode(MessagePack::unpack($data));
    }
}
