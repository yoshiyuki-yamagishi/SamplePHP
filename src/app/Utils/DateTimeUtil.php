<?php
/**
 * 日時のユーティリティクラス
 *
 */

namespace App\Utils;

use App\Config\Constants;
use App\Models\GameMaster;
use App\Models\PlayerTimeSetting;
use App\Models\TimeSetting;
use DateTime;
use DateInterval;
use Exception;


/**
 * 日時のユーティリティクラス
 *
 */
class DateTimeUtil {

    /**
     * 日時をDB形式に変換
     * 日時を Y-m-d H:i:s形式で返します。
     * @param DateTime $date 日時
     * @return string 現在日時(Y-m-d H:i:s形式)
     */
    public static function formatDB($date) {
        return ($date->format('Y-m-d H:i:s'));
    }

    public static function getFarPast() {
        // 今より古ければ問題無しだが一応、100年前
        return '1900-01-01 00:00:00';
    }

    public static function getFarFuture() {
        return '9999-01-01 00:00:00';
    }

    public static function DB_to_YMD($date) {
        if (empty($date)) {
            return '';
        }

        $_date = new DateTime($date);
        return $_date->format('Y-m-d');
    }

    /**
     * 現在日時の取得
     * 現在日時を Y-m-d H:i:s形式で返します。
     *
     * @return string 現在日時(Y-m-d H:i:s形式)
     */
    public static function getNOW() {
        return self::formatDB(new DateTime());
    }

    /**
     * タイム取得（プレイヤータイムセッティング優先、次点でサーバー設定）
     * ゲームマスターのみ
     * @param $playerId
     * @return false|string|void
     */
    public static function getCurrentTime($playerId = null) {
//        if ($playerId) {
//            if (GameMaster::checkGM($playerId)) {
//                $timeSetting = PlayerTimeSetting::getOneByPlayerId($playerId);
//                if ($timeSetting) {
//                    return date('Y-m-d H:i:s', strtotime($timeSetting->diff_min.' minute'));
//                }
//                //全体の時間設定取得
//                $serverTime = TimeSetting::getOneCurrent();
//                if ($serverTime) {
//                    return date('Y-m-d H:i:s', strtotime($serverTime->diff_min.' minute'));
//                }
//            }
//        }
        //プレイヤーIDがない、もしくはゲームマスターでない場合は現在時刻を返す
        return self::getNOW();
    }

    /**
     * 日時 の比較
     *
     * @param string $d1 日時 1(Y-m-d H:i:s形式)
     * @param string $d2 日時 2(Y-m-d H:i:s形式)
     * @return integer $d1が$d2より日時が前の場合は < 0 を 、$d1が$d2より日時が後の場合は > 0 を、等しい場合は0を返す
     */
    public static function compareDate($d1, $d2) {
        try {
            $t1 = new DateTime($d1);
            $t2 = new DateTime($d2);
            $t1 = $t1->format('YmdHis');
            $t2 = $t2->format('YmdHis');
            return ($t1 - $t2);
        } catch (Exception $e) {
            return (0);
        }
    }

    /**
     * 秒数を加算した日時を取得
     *
     * @param string $date 日時(Y-m-d H:i:s形式)
     * @param integer $seconds 加算する秒
     * @param string $format 日付フォーマット
     * @return string Y-m-d H:i:s形式。
     * 処理に失敗した場合は、引数で指定した値を返す。
     */
    public static function addSecondsToDate($date, $seconds, $format = 'Y-m-d H:i:s') {
        $ret = $date;

        try {
            $date = new DateTime($date);
            $interval = DateInterval::createFromDateString("$seconds seconds");
            $date->add($interval);
            $ret = $date->format($format);
        } catch (Exception $e) {

        }

        return ($ret);
    }

    /**
     * $startDateから$endDateまでの日数を求める
     *
     * @param string $startDate 開始日時(Y-m-d H:i:s形式)
     * @param string $endDate 終了日時(Y-m-d H:i:s形式)
     * @param integer $startDateから $endDateまでの日数
     */
    public static function diffDays($startDate, $endDate) {
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
        $interval = $start->diff($end);
        $days = (int)$interval->format('%a') + 1;
        return $days;
    }

    /**
     * $startDateから$endDateまでの日数を求める
     *
     * @param string $startDate 開始日時(Y-m-d H:i:s形式)
     * @param string $endDate 終了日時(Y-m-d H:i:s形式)
     * @param integer $startDateから $endDateまでの日数
     */
    public static function diffSeconds($startDate, $endDate) {
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
        return $end->getTimeStamp() - $start->getTimeStamp();
    }

    /**
     * UNIX タイムスタンプ、ミリ秒を設定する
     *
     * @return DateTime 日付
     */
    public static function FromTimestampMs($time) {
        $timeSec = intdiv($time, 1000);
        $timeMsec = ($time - $timeSec * 1000) / 1000;
        $date = new DateTime("@".$timeSec);
        // DebugUtil::e_log('FromTimestampMs', 'date0', $date);

        $interval = new DateInterval('PT0S');
        $interval->f = $timeMsec;
        $date->add($interval);
        // DebugUtil::e_log('FromTimestampMs', 'date1', $date);

        return $date;
    }

    /**
     * 引数の日時情報から同日ログイン、継続ログイン、非継続ログインを判定する
     *
     * @param string $baseDate 最終ログイン日時
     * @param string $compareDate ログイン日時
     * @return integer 0:同日ログイン、1:継続ログイン、2:非継続ログイン
     */
    public static function checkContinue($baseDate, $compareDate) {
        $ret = Constants::LOGIN_SAME_DAYS;

        if (!isset($baseDate)) {
            $ret = Constants::LOGIN_NEW_DAYS_RESTART;
            return $ret;
        }

        $_baseDate = self::_baseLoginDate($baseDate);
        $_compareDate = self::_baseLoginDate($compareDate);

        // 日数差をチェックする
        $diff = $_baseDate->diff($_compareDate);
        if ($diff->invert == Constants::LOGIN_SAME_DAYS) {
            if ($diff->d == 1)        // 1日差
            {
                $ret = Constants::LOGIN_NEW_DAYS_CONTINUE;
            } elseif ($diff->d > 1)    // 2日差以上
            {
                $ret = Constants::LOGIN_NEW_DAYS_RESTART;
            }
        }

        return $ret;
    }

    /**
     * 対象日時が、範囲に入っているかチェックする
     *
     * @param string $now 対象日時
     * @param string $start 開始日時
     * @param string $end 終了日時
     * @return true: 範囲内
     */
    public static function isBetween($now, $start, $end) {
        $_now = new DateTime($now);
        if (!empty($start)) {
            $_start = new DateTime($start);
            if ($_now < $_start) {
                return false;
            }
        }
        if (!empty($end)) {
            $_end = new DateTime($end);
            if ($_now > $_end) {
                return false;
            }
        }
        return true;
    }


    /**
     * 引数情報の日時からデイリークエストの開始時刻を求める
     *
     * @param DateTime $date
     * return DateTime デイリーミッション開始時刻
     */
    public static function dailyQuestStartDate($date) {
        // 今のところログイン基準日と同じ、0:0 スタート
        return self::_baseLoginDate($date);
    }

    /**
     * 引数情報の日時からデイリーミッションの開始時刻を求める
     *
     * @param DateTime $date
     * return DateTime デイリーミッション開始時刻
     */
    public static function dailyMissionStartDate($date) {
        // 今のところログイン基準日と同じ、0:0 スタート
        return self::_baseLoginDate($date);
    }

    /**
     * 引数情報の日時からデイリーガチャの開始時刻を求める
     *
     * @param DateTime $date
     * return DateTime デイリーガチャ開始時刻
     */
    public static function dailyGachaStartDate($date) {
        // 今のところログイン基準日と同じ、0:0 スタート
        return self::_baseLoginDate($date);
    }

    /**
     * 製品購入回数のリセット日付を得る
     *
     * @param DateTime $date
     * return DateTime 製品購入回数のリセット日付
     */
    public static function dailyProductStartDate($date) {
        // 今のところログイン基準日と同じ、0:0 スタート
        return self::_baseLoginDate($date);
    }

    /**
     * デイリーパックのスタート日付を得る
     *
     * @param DateTime $date
     * return DateTime デイリーパックのスタート日付
     */
    public static function dailyPackStartDate($date) {
        // 今のところログイン基準日と同じ、0:0 スタート
        return self::_baseLoginDate($date);
    }

    /**
     * ログインポイントのスタート日付を得る
     *
     * @param DateTime $date
     * return DateTime ログインポイントのスタート日付
     */
    public static function loginPointStartDate($date) {
        // 今のところログイン基準日と同じ、0:0 スタート
        return self::_baseLoginDate($date);
    }

    /**
     * 製品購入支払い額のリセット日付を得る
     *
     * @param DateTime $date
     * return DateTime 製品購入支払い額のリセット日付
     */
    public static function monthlyProductStartDate($date) {
        return self::_monthStartDate($date);
    }

    /**
     * 引数情報の日時からログイン基準日を求める
     *
     * @param DateTime $date
     */
    private static function _baseLoginDate($date) {
        $dateTime = new DateTime($date);

        $subDate = sprintf(
            '%s hour %s minutes %s second',
            $dateTime->format('H'),
            $dateTime->format('i'),
            $dateTime->format('s')
        );

        $interval = DateInterval::createFromDateString($subDate);
        $dateTime->sub($interval);
        return $dateTime;
    }

    /**
     * 引数情報の日時から月の開始時間を求める
     *
     * @param DateTime $date
     */
    private static function _monthStartDate($date) {
        $dateTime = new DateTime($date);
        // DebugUtil::e_log('_monthStartDate', 'date', $date);
        $ret = new DateTime($dateTime->format('Y-m-01 00:00:00'));
        // DebugUtil::e_log('_monthStartDate', 'ret', $ret);
        return $ret;
    }

    /**
     * 秒を分単位変換切り捨て(キャッシュモデル用)
     * 0以下の場合最低1分の時間補正するフラグ追加
     * @param $second
     */
    public static function secondToMinute($second) {
        $minute = $second / 60;
        return $minute;
    }
}
