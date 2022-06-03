<?php
/**
 * ファイルパス用のユーティリティクラス
 *
 */

namespace App\Utils;

/**
 * ファイルパス用のユーティリティクラス
 *
 */
class PathUtil {

    /**
     * ファイルパスから、フォルダーパスを計算する
     *
     * @param string $path ファイルパス
     * @return なし
     */
    public static function file_dir($path) {
        $pos = mb_strrpos($path, '/');
        if ($pos === false) {
            return '';
        }

        return substr($path, 0, $pos);
    }

    /**
     * フォルダーを用意する (ファイルのパスを指定する)
     *
     * @param string $path ファイルパス
     * @return なし
     */
    public static function prepare_file_dir($path, $mode = 0777) {
        $dir = self::file_dir($path);
        if (!$dir) {
            return;
        }
        if (file_exists($dir)) {
            return;
        }

        mkdir($dir, $mode, true); // 再帰的
    }

    public static function rm_dir($path) {
        if (is_dir($path) and !is_link($path)) {
            array_map('self::rm_dir', glob($path.'/*', GLOB_ONLYDIR));
            array_map('unlink', glob($path.'/*'));
            rmdir($path);
        }
    }

}
