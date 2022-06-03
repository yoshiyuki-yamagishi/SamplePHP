<?php
/**
 * SQL用のユーティリティクラス
 *
 */

namespace App\Utils;

use Illuminate\Support\Facades\DB;

/**
 * SQL用のユーティリティクラス
 *
 */
class SqlUtil {

    /**
     * 生の SQL 文実行
     *
     * @param string $sqlStatements 生の SQL 文 (; 区切り)
     * @return なし
     */
    public static function execRawSqls($query) {
        $list = explode(';', $query);
        foreach ($list as $item) {
            $item = trim($item);
            if (!empty($item)) {
                DB::statement($item);
            }
        }
    }
}
