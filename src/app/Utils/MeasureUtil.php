<?php
/**
 * 計測用のユーティリティクラス
 *
 */

namespace App\Utils;

/**
 * 計測用のユーティリティクラス
 *
 */
class MeasureUtil {

    const DEF_FILE_NAME = "api_measure";
    const DEF_NAME = "measure";

    public static $__instance = null;

    public $name = "";
    public $start = 0;
    public $prev = 0;
    public $cnt = 0;
    public $writeLog = "";

    public static function measureStart($name = self::DEF_NAME) {
        if (!isset(self::$__instance)) {
            self::$__instance = new self($name);
        } else {
            self::$__instance->_init($name);
        }
    }

    public function __construct($name) {
        $this->_init($name);
    }

    public function _init($name) {
        $this->name = $name;
        $now = microtime(true);
        $this->start = $now;

        $this->writeLog = "----- Measure Start -----\n";

        $this->prev = $this->start;
        $this->cnt++;
    }

    public static function measure($func) {
        if (!isset(self::$__instance)) {
            return;
        }
        self::$__instance->_measure($func);
    }

    public function _measure($func) {
        $now = microtime(true);
        $total = $now - $this->start;
        $diff = $now - $this->prev;

        $this->writeLog .= $this->__writeLog($func, $total, $diff);

        $this->prev = $now;
        $this->cnt++;
    }

    public static function end() {
        if (!isset(self::$__instance)) {
            return;
        }
        self::$__instance->_end();
    }

    public function _end() {
        $now = microtime(true);
        $total = $now - $this->start;
        $diff = $now - $this->prev;

        $this->writeLog .= $this->__writeLog("Finish", $total);

        DebugUtil::e_log(self::DEF_FILE_NAME, $this->name, $this->writeLog);
    }

    public function __writeLog($msg, $total, $diff = "") {
        $str = str_pad($msg, 30)
            .": ".str_pad("total[".round($total, 5)."]", 15);
        if ($diff != "") {
            $str .= "- ".str_pad("diff[".round($diff, 5)."]", 15)."\n";
        } else {
            $str .= "\n";
        }
        return $str;
    }

}
