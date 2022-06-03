<?php
/**
 * AWS S3 のユーティリティクラス
 *
 */

namespace App\Utils;

use Storage;


/**
 * AWS S3 のユーティリティクラス
 *
 */
class AwsS3Util {

    /**
     * ディスク
     */
    private $disk = null;

    /**
     * コンストラクタ
     * @param string disk_name ディスク名
     */
    public function __construct($disk_name = 's3_contents') {
        $this->disk = Storage::disk($disk_name);
    }

    /**
     * 一覧の取得
     * ファイルも、ディレクトリ名も取得する
     *
     * @param string $directory ディレクトリ
     * @return array 一覧
     */
    public function list($directory) {
        $list = [];
        if ($this->disk === null) {
            return $list;
        }

        try {
            $directories = $this->disk->directories($directory);
            $files = $this->disk->files($directory);
            $list = array_merge($directories, $files);
        } catch (Exception $error) {
            // TODO: ログを出力する
            //$e->getMessage();
        }

        return $list;
    }

    /**
     * ディレクトリ一覧の取得
     *
     * @param string $directory ディレクトリ
     * @return array 一覧
     */
    public function directories($directory) {
        $list = [];
        if ($this->disk === null) {
            return $list;
        }

        try {
            $list = $this->disk->directories($directory);
        } catch (Exception $error) {
            // TODO: ログを出力する
            //$e->getMessage();
        }

        return $list;
    }

    /**
     * ファイル一覧の取得
     *
     * @param string $directory ディレクトリ
     * @return array 一覧
     */
    public function files($directory) {
        $list = [];
        if ($this->disk === null) {
            return $list;
        }

        try {
            $list = $this->disk->files($directory);
        } catch (Exception $error) {
            // TODO: ログを出力する
            //$e->getMessage();
        }

        return $list;
    }

    /**
     * ファイルの保存
     *
     * @param string $file_path ファイルパス
     * @param string $contents 保存するデータ
     * @return boolean 処理結果
     */
    public function put($file_path, $contents) {
        $ret = false;
        if ($this->disk === null) {
            return $ret;
        }

        try {
            $ret = true;
            $this->disk->put($file_path, $contents);
        } catch (Exception $error) {
            // TODO: ログを出力する
            //$e->getMessage();
        }

        return $ret;
    }

    /**
     * ファイルの取得
     *
     * @param string $file_path ファイルパス
     * @return string 取得したデータ
     */
    public function get($file_path) {
        $ret = '';
        if ($this->disk === null) {
            return $ret;
        }

        try {
            $ret = $this->disk->get($file_path);
        } catch (Exception $error) {
            // TODO: ログを出力する
            //$e->getMessage();
        }

        return $ret;
    }


}
