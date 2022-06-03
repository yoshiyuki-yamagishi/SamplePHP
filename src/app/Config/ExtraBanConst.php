<?php
/**
 * 定数設定
 *
 */

namespace App\Config;

/**
 * 定数一元管理用
 *
 */
class ExtraBanConst {

    const STATUS_NONE = 0;
    const STATUS_TRADER_ACCOUNT = 1;

    const MSG_TMP = 'あなたのアカウントは、アクセスを停止しています。';
    const MSG_TRADER_ACCOUNT = 'あなたのアカウントは、利用規約の禁止行為に抵触する
疑いのあるプレイ状況が検知されたため、
アクセスを停止しています。';

    public static function statusMsg($status) {
        $msgList = [
            self::STATUS_TRADER_ACCOUNT => self::MSG_TRADER_ACCOUNT,
        ];

        $msg = self::MSG_TMP;
        if (array_key_exists($status, $msgList)) {
            $msg = $msgList[$status];
        }

        return $msg;
    }
}
