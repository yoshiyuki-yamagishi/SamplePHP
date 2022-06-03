<?php
/**
 * リスト用のユーティリティクラス
 *
 */

namespace App\Utils;

/**
 * リスト用のユーティリティクラス
 *
 */
class ListUtil {

    /**
     * リストから値の取得
     *
     * @param string $list 連想配列
     * @param $keys 連想配列のキーの配列
     * @param $default 無い場合に返す値
     * @return boolean 等しいとき true
     */
    public static function get_if($list, $keys, $default) {
        $temp = $list;
        foreach ($keys as $key) {
            if (!array_key_exists($key, $temp)) {
                return $default;
            }

            $temp = $temp[$key];
        }
        return $temp;
    }

    /**
     * リストに値の格納
     *
     * @param string $list 連想配列
     * @param $keys 連想配列のキーの配列
     * @param $default 無い場合に返す値
     * @return boolean 等しいとき true
     */
    public static function set(&$list, $keys, $value) {
        $count = count($keys);

        $temp = &$list;
        for ($i = 0; $i < $count; ++$i) {
            $key = $keys[$i];

            if ($i == $count - 1) {
                $temp[$keys[$i]] = $value;
                break;
            }

            if (!array_key_exists($key, $temp)) {
                $temp[$key] = [];
            }

            $temp = &$temp[$key];
        }
    }

}
