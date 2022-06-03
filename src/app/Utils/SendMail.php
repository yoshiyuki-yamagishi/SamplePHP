<?php
/**
 * メール送信のユーティリティクラス
 *
 */

namespace App\Utils;

use Exception;
use SendGrid;
use SendGrid\Mail\Mail as Email;

/**
 * メール送信のユーティリティクラス
 *
 */
class SendMail
{
    const SENDMAIL_TYPE_NEW = 0;
    const SENDMAIL_TYPE_UPDATE = 1;

    const FROM_ADRESS = "bbdw_accountsupport@arcsy.co.jp";
    const TITLE = "BBDW払戻し登録受付メール";
    const UPDATE_TITLE = "BBDW払戻し登録情報修正完了メール";
    const MAIN_MESSAGE = <<<EOM
平素はブレイブルー オルタナティブ ダークウォー（ＢＢＤＷ）をご利用頂きまして誠にありがとうございます。<br/>
<br/>
お客様の払戻し申請を受け付けました。<br/>
尚、本メールでは払戻しの手続きを行うことはできません。<br/>
後ほど送信される【ＢＢＤＷ代金払戻しの案内】メールの内容をご確認いただき、<br/>
案内に従って払戻し手段の登録をお願い致します。<br/>
<br/>
万が一数日経っても【ＢＢＤＷ代金払戻しの案内】のメールが届かない場合は<br/>
下記サポートアドレスへ問い合わせください。<br/>
<br/>
払戻しに関わるメールは＠arcsy.co.jpより配信されます。<br/>
@arcsy.co.jpからのメールを受け取れるよう迷惑メールフィルターの設定は外していただけるようお願い致します。<br/>
<br/>
*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*<br/>
ＢＢＤＷ運営サポート<br/>
お問合せ先：bbdw_accountsupport@arcsy.co.jp<br/>
*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
EOM;

    const MAIN_UPDATE_MESSAGE = <<<EOM
平素はブレイブルー オルタナティブ ダークウォー（ＢＢＤＷ）をご利用頂きまして誠にありがとうございます。<br/>
<br/>
お客様の登録メールアドレスの変更を受け付けました。<br/>
尚、本メールでは払戻しの手続きを行うことはできません。<br/>
後ほど送信される【ＢＢＤＷ代金払戻しの案内】メールの内容をご確認いただき、<br/>
案内に従って払戻し手段の登録をお願い致します。<br/>
<br/>
払戻しの申請を完了しますと、以降は登録メールアドレスの変更をお受けできません。<br/>
必ず【手続き完了】メールを受信いただけるメールアドレスをご登録いただくようにお願い致します。<br/>
<br/>
払戻しに関わるメールは＠arcsy.co.jpより配信されます。<br/>
@arcsy.co.jpからのメールを受け取れるよう迷惑メールフィルターの設定は外していただけるようお願い致します。<br/>
<br/>
*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*<br/>
ＢＢＤＷ運営サポート<br/>
お問合せ先：bbdw_accountsupport@arcsy.co.jp<br/>
*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
EOM;

    const TROUBLE_TITLE = "メール送信エラー";

    const TROUBLE_MESSAGE = <<<EOM
返金申請手続きメール送信に失敗しました<br/>
<br/>
送信失敗PlayerID:__PLAYER_ID__
送信宛先メールアドレス:__ADDRESS__<br/>
エラーメッセージ:<br/>
__ERR_MSG__
EOM;

    /**
     * メール送信
     * @param $mailAddress
     * @param $sendmailType
     * @throws SendGrid\Mail\TypeException
     */
    public static function send($mailAddress, $sendmailType, $playerId) {
        $sendgridApiKey = config('app.sendgrid_api_key');
        $sendgrid = new SendGrid($sendgridApiKey);
        $email = new Email();

        $email->setFrom(self::FROM_ADRESS);
        if ($sendmailType == self::SENDMAIL_TYPE_NEW) {
            $email->setSubject(self::TITLE);
        } else {
            $email->setSubject(self::UPDATE_TITLE);
        }
        $email->addTo($mailAddress);
        if ($sendmailType == self::SENDMAIL_TYPE_NEW) {
            $email->addContent("text/html", self::MAIN_MESSAGE);
        } else {
            $email->addContent("text/html", self::MAIN_UPDATE_MESSAGE);
        }

        try {
            $response = $sendgrid->send($email);
        } catch (Exception $e) {
            $sendgrid = new SendGrid($sendgridApiKey);
            $email = new Email();

            $email->setFrom(self::FROM_ADRESS);
            $email->setSubject(self::TROUBLE_TITLE);
            $email->addTo(self::FROM_ADRESS);

            $msg = self::TROUBLE_MESSAGE;
            $msg = str_replace("__PLAYER_ID__",$playerId, $msg);
            $msg = str_replace("__ADDRESS__",$mailAddress, $msg);
            $msg = str_replace("__ERR_MSG__",$e->getMessage(), $msg);
            $response = $sendgrid->send($email);
        }
    }
}
