<?php
/**
 * 計算用のユーティリティクラス
 *
 */

namespace App\Utils;

/**
 * 計算用のユーティリティクラス
 *
 */
class MathUtil {

    /**
     * 配列にあるビット数値をビット和演算する
     *
     * @param $bitArr
     * @return int
     */
    public static function sumUseBit($bitArr) {
        $ret = 0;

        // 配列でなければ、なにも立ってないビットを返す
        if (!is_array($bitArr)) {
            return $ret;
        }

        // 配列にあるビットを全てビット和計算
        foreach ($bitArr as $bit) {
            $ret = $ret | $bit;
        }

        return $ret;
    }

    /**
     * 比較
     *
     * @param integer $a 割られる数
     * @param integer $b 割る数
     * @return integer 切り上げ
     */
    public static function intdiv_ceil($a, $b) {
        return intdiv($a + $b - 1, $b);
    }

    /**
     * 2進数で、ビットが立っている数
     *
     * @param integer $a 対象
     * @return integer ビット数
     */
    public static function bit_count($a) {
        assert($a >= 0);
        $count = 0;
        while ($a != 0) {
            if (($a & 1) == 1) {
                ++$count;
            }

            $a = ($a >> 1);
        }

        return $count;
    }

    /**
     * 負の数を0にする
     *
     * @param integer $a 対象
     * @return integer 負なら0になる
     */
    public static function nTo0($a) {
        if ($a <= 0) {
            return 0;
        }
        return $a;
    }

    /**
     * 指定してIdxのフラグ位置を返す
     *
     * @param $idx
     * @return false|int|string|void
     */
    public static function getIdxBitFlag($idx) {
        if ($idx <= 0) {
            return false;
        }
        $checkBit = decbin(1);
        if ($idx > 1) {
            $checkBit <<= ($idx - 1);
        }
        return $checkBit;
    }

    /**
     * 渡したパラメータの指定Idx位置のフラグチェック
     *
     * @param $checkPrm
     * @param $idx
     * @return bool|void
     */
    public static function checkIdxBitFlag($checkPrm, $idx) {
        $checkBit = self::getIdxBitFlag($idx);
        return boolval($checkPrm & $checkBit);
    }

    /**
     * 渡したパラメータの指定Idx位置のフラグ更新
     *
     * @param $updPrm
     * @param $idx
     * @param bool $flag
     * @return integer|false|int|string|void
     */
    public static function updIdxBitFlag($updPrm, $idx, bool $flag=true) {
        $updBit = self::getIdxBitFlag($idx);
        if ($flag) {
            $updPrm |= $updBit;
        } else {
            if (self::checkIdxBitFlag($updPrm, $idx)) {
                $updPrm ^= $updBit;
            }
        }
        return $updPrm;
    }

}
