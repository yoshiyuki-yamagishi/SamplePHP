<?php
/**
 * APCuのユーティリティクラス
 *
 */

namespace App\Utils;

/**
 * APCuのユーティリティクラス
 *
 */
class ApcUtil {

    /**
     * 保存
     *
     * @param $key
     * @param $data
     * @return array|bool|void
     */
    public static function add($key, $data) {
        if (!extension_loaded('apcu')) {
            return false;
        }
        // apcuが使えるか確認
        if (!apcu_enabled()) {
            return false;
        }
        // キャッシュに保存
        return apcu_store($key, $data);
    }

    /**
     * 取得
     *
     * @param $key
     * @return mixed|void|null
     */
    public static function get($key) {
        if (!extension_loaded('apcu')) {
            return null;
        }
        // apcuが使えるか確認
        if (!apcu_enabled()) {
            return null;
        }
        // キャッシュに保存
        $success = false;
        $ret = apcu_fetch($key, $success);
        return $success ? $ret : null;
    }
}
