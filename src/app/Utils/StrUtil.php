<?php
/**
 * 文字列用のユーティリティクラス
 *
 */

namespace App\Utils;

use App\Config\Constants;

/**
 * 文字列用のユーティリティクラス
 *
 */
class StrUtil {

    /**
     * 文字列の接頭辞の比較
     *
     * @param string $a 比較変数1
     * @param string $b 比較変数2
     * @return boolean 等しいとき true
     */
    public static function prefixEq($a, $b) {
        $aLen = strlen($a);
        $bLen = strlen($b);
        if ($aLen > $bLen) {
            return substr($a, 0, $bLen) == $b;
        }
        return substr($b, 0, $aLen) == $a;
    }

    /**
     * 文字列パラメータのデコード
     *
     * @param string $a [a:1,b:2],[c:3] のようなデータ
     * @return array デコード結果、連想配列の配列
     */
    public static function decodeGeneralParams($a) {
        // スペースを認めないかわりに、速い
        $params = explode('],[', $a);
        $cb = count($params);
        if ($cb == 0) {
            return [];
        }

        $params[0] = preg_replace('/^\[/', '', $params[0]);
        $params[$cb - 1] = preg_replace('/\]$/', '', $params[$cb - 1]);

        $ret = [];
        foreach ($params as $param) {
            $values = explode(',', $param);
            $item = [];
            foreach ($values as $value) {
                if ($value == '') {
                    continue;
                }

                $pos = strpos($value, ':');
                if ($pos === false) {
                    $item[$value] = '';
                } else {
                    $item[substr($value, 0, $pos)] = substr($value, $pos + 1);
                }
            }
            $ret[] = $item;
        }

        return $ret;
    }

    /**
     * 文字列パラメータのデコード
     *
     * @param string $a a,b,c のようなデータ
     * @return array デコード結果、文字列の配列
     */
    public static function decodeSimpleCsv($a) {
        $a = trim($a);
        if ($a == "") {
            return [];
        } // 空文字列の場合、空リスト

        // 空文字列で実行すると、空文字列 1 コのリストになる
        return array_map('trim', explode(',', $a));
    }

    /**
     * RequestのUser-AgentからPlatformを取得
     *
     * @param $userAgent
     * @return int
     */
    public static function getPlatform4userAgent($userAgent) {
        if (preg_match('/(iPhone)|(iPad)|(Macintosh)|(CFNetwork)|(Darwin)/', $userAgent)) {
            return Constants::PLATFORM_IOS;
        }
        if (preg_match('/(Android)|(UnityPlayer)/', $userAgent)) // Unityからのアクセスの場合、疑似的にAndroidとして扱う
        {
            return Constants::PLATFORM_ANDROID;
        }

        // -1なら正規のもの出ないとする
        return -1;
    }

    /**
     * RequestのUser-AgentからPlatformを取得(お知らせ用)
     *
     * @param $userAgent
     * @return int
     */
    public static function getInformationPlatform4userAgent($userAgent) {
        if (preg_match('/(iPhone)|(iPad)|(CFNetwork)|(Darwin)/', $userAgent)) {
            return Constants::PLATFORM_IOS;
        }
        if (preg_match('/(Android)|(UnityPlayer)/', $userAgent)) // Unityからのアクセスの場合、疑似的にAndroidとして扱う
        {
            return Constants::PLATFORM_ANDROID;
        }
        // それ以外ならWebで認識する
        return Constants::PLATFORM_WEB;
    }

    /**
     * ランダム文字列生成
     *
     * @param $length
     * @return false|string
     */
    public static function createRandomStr($length) {
        return substr(str_shuffle('0123456789ABCDEFGHJKLMNPQRSTUVWXYZ'), 0, $length);
    }

    /**
     * スネークケース文字列をパスカルケースに変換
     * 'sample_case' -> 'SampleCase'
     *
     * @param $string
     * @return string|string[]
     */
    public static function snakeCase2PascalCase($string) {
        $string = strtolower($string);
        $string = str_replace('_', ' ', $string);
        $string = ucwords($string);
        $string = str_replace(' ', '', $string);
        return $string;
    }

    /**
     * 文字列状態のTrue or Falseをboolに変換
     * ※true以外はfalseのぬるめ判定
     *
     * @param $str
     * @return bool
     */
    public static function str2Bool($str) {
        if (strtolower($str) === "true") {
            return true;
        }
        return false;
    }
}
