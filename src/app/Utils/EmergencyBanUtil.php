<?php
/**
 * 緊急BAN対応のユーティリティクラス
 *
 */

namespace App\Utils;

use App\Config\Constants;
use App\Config\ExtraBanConst;
use App\Models\PlayerBan;
use Illuminate\Support\Facades\Cache;

/**
 * 緊急BAN対応のユーティリティクラス
 *
 */
class EmergencyBanUtil {

    public static function banCheck($playerId) {
        if (self::checkCache($playerId, "white")) {
            return false;
        }
        if (self::checkCache($playerId, "black")) {
            return true;
        }

        $banListPath = app_path('Resources/BanData/ban_list.csv');
        $banListStr = file_get_contents($banListPath);
        $banListTmp = explode("\n", $banListStr, -1);
        $banList = array_fill_keys($banListTmp, true);

        if (array_key_exists($playerId, $banList)) {
            // BAN対象ヒット
            self::setCache($playerId, "black");
            return true;
        }
        // BAN対象じゃない
        self::setCache($playerId, "white");
        return false;
    }

    public static function getDummyPlayerBanData($status) {
        return (object)[
            'ban_status' => PlayerBan::STATUS_BAN,
            'start_at' => "2021-05-20 13:00:00",
            'end_at' => "2500-12-31 23:59:59",
            'message' => ExtraBanConst::statusMsg($status)
        ];
    }

    private static function setCache($playerId, $key) {
        $cacheDriver = config("cache.default");
        if ($cacheDriver == "apc") {
            $env = config("app.env");
            if ($env == Constants::PRODUCT) {
                $cacheDriver = "memcached";
            } else {
                $cacheDriver = "redis";
            }
        }
        Cache::store($cacheDriver)->forever("EmeBan-$key-$playerId", true);
    }

    private static function checkCache($playerId, $key) {
        $cacheDriver = config("cache.default");
        if ($cacheDriver == "apc") {
            $env = config("app.env");
            if ($env == Constants::PRODUCT) {
                $cacheDriver = "memcached";
            } else {
                $cacheDriver = "redis";
            }
        }
        $data = Cache::store($cacheDriver)->get("EmeBan-$key-$playerId");
        return !is_null($data);
    }
}


