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

    /**
     * @param $type the log type
     */
    public static function getLogPath($type) {
        $logPath = Config::$arrConfig['log_path'];
        if (empty($logPath)){
            throw new  BaseException(BaseError::$systemError, 'missing the log path config');
        }
        //split log 
        $logPath = $logPath.$type.'_'.date('Ymd');

        return $logPath;
    }

    public static function getCommonLogMsg() {
        $commonLogMsg = '';

    }

    public static function accessLog($errMsg){
        
        $logPath = self::getLogPath();
        $errMsg = date('Y-m-d H:i:s').' ACCESS: '.$errMsg;
        error_log($errMsg, 3, $logPath);


    }

    /**
     *
     * write the error log
     * the rd can set the different log file
     * @param $errNo
     * @param $errMsg
     * @param $type the log type
     */
    public static function errorLog($errNo, $errMsg, $type = 'system') {
        
        $logPath = self::getLogPath($type.'_error');
        
        $errMsg = date('Y-m-d H:i:s')." ERROR: errNo[$errNo],errMsg:$errMsg"."\r\n";
        error_log($errMsg, 3, $logPath);
    }
}


?>
