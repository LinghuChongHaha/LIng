<?php
/**
 * @author Ling
 * @date  2017.12.15
 * Log class
 * RD can use this class to write your own log to log files.
 *
 */

class BaseLogger{

    public static $errNo;
    public static $errMsg;
    public static $logPath;

    public function __construct() {
        self::$logPath = Config::$arrConfig['LOG_PATH'];
        if (empty(self::$logPath)){
            throw new  Exception('missing the log path config');
        }
    }

    public static function accessLog($errMsg){
        
        $logPath = self::$logPath;
        //split log 
        $logPath = $logPath.'access_'.date('Ymd');

        $errMsg = date('Y-m-d H:i:s').' ACCESS: '.$errMsg;
        error_log($errMsg, 3, $logPath);


    }

    public static function errorLog($errNo, $errMsg) {
        
        $logPath = self::$logPath;
        $logPath = $logPath.'error_'.date('Ymd');
        
        $errMsg = date('Y-m-d H:i:s')." ERROR: errNo[$errNo],errMsg:$errMsg";
        error_log($errMsg, 3, $logPath);
    }
}


?>
