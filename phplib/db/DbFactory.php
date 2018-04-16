<?php
class DbFactory {

    // the object
    private static $dbInstance;

    //  the databases list that we can support
    public static $arrDataBaseMap = array(
       'mysql' =>  'Mysql.php',
    );

    // private 
    private  function __construct() {
    }
    
    // private
    private function __clone(){
    } 

    /**
     * 单例模式
     * get the only one connectio globally
     * 实现连接复用
     * @param $dbName
     *
     */
    public static function getDbInstance($dbName) {
        $dbConfig = Config::$arrConfig['db'];
        $dbDriver = $dbConfig['driver'];
        if (empty($dbDriver) || !in_array($dbDriver, array_keys(self::$arrDataBaseMap))) {
            BaseLogger::errorLog(BaseError::$systemDbError, 'config not have db info,or the configed db not in supported list');
            return false;
        }

        $dbClassName = ucfirst($dbDriver);
        if (!class_exists($dbClassName, false)) {
            // load the file
            $includePath = self::$arrDataBaseMap[$dbDriver];
            $includePath = dirname(__FILE__).DIRECTORY_SEPARATOR.$includePath;
            include $includePath;
        }

        if (empty(self::$dbInstance)) {
            $host = $dbConfig['host'];
            $port = $dbConfig['port'];
            $userName = $dbConfig['username'];
            $password = $dbConfig['password'];
            self::$dbInstance = new $dbClassName($host, $port, $userName, $password, $dbName);
        }

        return self::$dbInstance; 
    }

}
?>
