<?php
/**
 * http 用のユーティリティクラス
 *
 */

namespace App\Utils;

/**
 * http 用のユーティリティクラス
 *
 */
class HttpUtil {

    /**
     * http リクエストのサイズ取得
     *
     * @param object $request
     * @return integer メモリーサイズ
     */
    public static function calcRequestSize($request) {
        $size = 0;

        // ヘッダーサイズの取得 //
        {
            $reqHeader = $request->header();
            // DebugUtil::e_log('reqHeader', 'reqHeader', $reqHeader);
            $size += DebugUtil::calcMemSize($reqHeader);
        }

        // body のサイズ //
        {
            $reqContent = $request->getContent();
            // DebugUtil::e_log('reqContent', 'reqContent', $reqContent);
            $size += strlen($reqContent);
        }

        return $size;
    }

    /**
     * http レスポンスのサイズ取得
     *
     * @param object $response
     * @return integer メモリーサイズ
     */
    public static function calcResponseSize($response) {
        $size = 0;

        // ヘッダーサイズの取得 //
        {
            $resHeader = apache_response_headers();
            // $resHeader = $response->header(); うまくいかない
            // DebugUtil::e_log('resHeader', 'resHeader', $resHeader);
            $size += DebugUtil::calcMemSize($resHeader);
        }

        // body のサイズ //
        {
            $resContent = $response->content();
            // DebugUtil::e_log('resContent', 'resContent', $resContent);
            $size += strlen($resContent);
        }

        return $size;
    }

}
