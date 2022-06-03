<?php
/**
 * ソート用のユーティリティクラス
 *
 */

namespace App\Utils;

/**
 * ソート用のユーティリティクラス
 *
 */
class SortUtil {

    /**
     * クラス配列の指定キーソート
     * $cmpProperty1 は第二ソート指定キー
     * @param $classArr
     * @param $cmpProperty1
     * @param null $cmpProperty2
     */
    public static function classUSort(&$classArr, $cmpProperty1, $cmpProperty2 = null) {
        // 比較キーが存在するか判定
        property_exists(reset($classArr), $cmpProperty1);

        if (is_null($cmpProperty2)) {
            // 第二キーがない場合は単一比較
            usort($classArr, function ($a, $b) use ($cmpProperty1, $cmpProperty2)
            {
                self::val_cmp($a->{$cmpProperty1}, $b->{$cmpProperty1});
            });
        } else {
            // 第二キーがあるならそちらも存在判定
            property_exists(reset($classArr), $cmpProperty2);

            // 第二キー含め比較
            usort($classArr, function ($a, $b) use ($cmpProperty1, $cmpProperty2)
            {
                $cmp = self::val_cmp($a->{$cmpProperty1}, $b->{$cmpProperty1});
                if ($cmp != 0) {
                    return $cmp;
                }
                return self::val_cmp($a->{$cmpProperty2}, $b->{$cmpProperty2});
            });
        }
    }

    /**
     * 比較
     *
     * @param object $a 比較変数1
     * @param object $b 比較変数2
     * @return 1, -1, 0
     */
    public static function val_cmp($a, $b) {
        if ($a > $b) {
            return 1;
        }
        if ($a < $b) {
            return -1;
        }
        return 0;
    }

    /**
     * 値を基準で近い順にソート
     * @param $targetArray
     * @param $basisValue
     * @param $cmpProperty1
     */
    public static function closeUSort(&$targetArray, $basisValue, $columnName) {
        // 比較キーが存在するか判定
        if (isset($columnName)) {
            usort($targetArray, function ($element, $nextElement) use ($basisValue, $columnName)
            {
                $tempCalcElement = abs($basisValue - $element->{$columnName});
                $tempCalcNextElement = abs($basisValue - $nextElement->{$columnName});
                if ($tempCalcElement == $tempCalcNextElement) {
                    return 0;
                }
                return ($tempCalcElement < $tempCalcNextElement) ? -1 : 1;
            });
        }

    }

}
