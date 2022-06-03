<?php
/**
 * ランダム処理用のユーティリティクラス
 *
 */

namespace App\Utils;

/**
 * ランダム処理用のユーティリティクラス
 *
 */
class RandUtil {

    /**
     * 確率で 1 アイテムを決定する
     *
     * @param list $list アイテムのリスト
     * @param string $rateColName 確率の列名
     * @param inteeger $totalRate 確率の分母
     * @return 1 アイテムか、null
     */
    public static function calcOneItem(
        $list, $rateColName, $totalRate = null
    ) {
        if (empty($list)) {
            return null;
        }

        // トータルの確率が指定されていない場合、合計で求める //

        if (empty($totalRate)) {
            $totalRate = 0;
            foreach ($list as $item) {
                $totalRate += $item->$rateColName;
            }
        }

        if ($totalRate < 1) {
            return null;
        }

        // 確率でアイテムを取得する //

        $r = mt_rand(1, $totalRate);

        $rateSum = 0;
        foreach ($list as $item) {
            $rateSum += $item->$rateColName;
            if ($r <= $rateSum) {
                return $item;
            }
        }

        return null;
    }


}
