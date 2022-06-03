<?php
/**
 * デバッグ用のユーティリティクラス
 *
 */

namespace App\Utils;

/**
 * デバッグ用のユーティリティクラス
 *
 */
class DebugUtil {

    /**
     * デバッグ用ログ出力
     *
     * @param string $fname ファイル名
     * @param string $value 値
     * @return なし
     */
    public static function e_log_raw($path, $value) {
        PathUtil::prepare_file_dir($path);

        error_log($value, "3", $path);
    }

    /**
     * デバッグ用ログ出力
     *
     * @param string $fname ファイル名
     * @param string $value 値
     * @return なし
     */
    public static function e_log_bin_raw($path, $data) {
        PathUtil::prepare_file_dir($path);

        $handle = fopen($path, 'wb');
        fwrite($handle, $data);
    }

    /**
     * デバッグ用ログ出力
     *
     * @param string $fname ファイル名
     * @param string $name 変数名
     * @param string $value 値
     * @return なし
     */
    public static function e_log($fname, $name, $value) {
        // フォルダーが無いときはログを出力しない //
        $dir = storage_path("test_logs");
        if (!file_exists($dir)) {
            return;
        }

        self::e_log_raw(
            $dir."/".$fname,
            "---- [".$name."]\n".print_r($value, true)."\n"
        );
    }

    /**
     * デバッグ用ログ出力 (var_dump 詳細版)
     *
     * @param string $fname ファイル名
     * @param string $name 変数名
     * @param string $value 値
     * @return なし
     */
    public static function e_log_ex($fname, $name, $value) {
        // フォルダーが無いときはログを出力しない //
        $dir = storage_path("test_logs");
        if (!file_exists($dir)) {
            return;
        }

        ob_start();
        var_dump($value);
        $_value = ob_get_contents();
        ob_end_clean();

        self::e_log_raw(
            $dir."/".$fname,
            "---- [".$name."]\n".$_value."\n"
        );
    }


    /**
     * デバッグ用ログ1行出力
     *
     * @param string $fname ファイル名
     * @param string $line 出力文字列
     * @return なし
     */
    public static function e_log_line($fname, $line, $targetDir = 'test_logs') {
        // フォルダーが無いときはログを出力しない //
        $dir = storage_path($targetDir);
        if (!file_exists($dir)) {
            return;
        }

        self::e_log_raw(
            $dir."/".$fname,
            $line."\n"
        );
    }

    /**
     * デバッグ用ログ削除
     *
     * @param string $fname ファイル名
     * @return なし
     */
    public static function unlink_e_log($fname) {
        // フォルダーが無いときはログを削除しない //
        $dir = storage_path("test_logs");
        $path = $dir."/".$fname;
        if (!file_exists($path)) {
            return;
        }

        unlink($path);
    }

    /**
     * Laravel ログ削除
     *
     * @return なし
     */
    public static function unlink_laravel_logs() {
        $dir = storage_path("logs");
        $search = $dir."/laravel-*.log";

        foreach (glob($search) as $path) {
            // self::e_log('unlink_laravel_logs', 'path', $path);
            unlink($path);
        }
    }

    /**
     * デバッグ用ログフォルダー削除
     *
     * @param string $fname ファイル名
     * @return なし
     */
    public static function unlink_e_dir($fname) {
        // フォルダーが無いときはログを削除しない //
        $dir = storage_path("test_logs");
        $path = $dir."/".$fname;
        if (!file_exists($path)) {
            return;
        }

        PathUtil::rm_dir($path);
    }

    /**
     * デバッグ用ログバイナリファイル出力
     *
     * @param string $fname ファイル名
     * @param string $data 出力データ
     * @return なし
     */
    public static function e_log_bin($fname, $data) {
        // フォルダーが無いときはログを出力しない //
        $dir = storage_path("test_logs");
        if (!file_exists($dir)) {
            return;
        }

        self::e_log_bin_raw(
            $dir."/".$fname, $data
        );
    }

    public static function calcMemSize($t) {
        if (!is_array($t)) {
            return strlen($t);
        }

        $size = 0;
        foreach ($t as $key => $value) {
            $size += self::calcMemSize($key);
            $size += self::calcMemSize($value);
        }
        return $size;
    }

}
