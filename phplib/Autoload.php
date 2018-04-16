<?php
/**
 * @author Ling
 * @date 2017.12.15
 * autoload class 
 */
class Autoload {

    public static function autoloadClass ($className){
        $classMaps = self::getClassMaps(); 
        $path = $classMaps[$className];
        if (!empty($path)) {
            include $path;
            return true;
        }

        $dynamicPath = self::autoloadDynamicClass($className);
        if (!empty($dynamicPath)) {
            //suggest use include ranther than include_once
            include $dynamicPath;
            return true;
        }

        //write error log
        if (empty($path)) { 
            BaseLogger::errorLog(1, 'autoload className:'.$className.' failed'); 
        }

        return false;
    }

	/***
     *
     * auto load user related files*
     * dynamci loading
     * like directorys:
     * Action_Ling, Data_Ling,Dao_Ling, Data_Ling
     */
    public static function autoloadDynamicClass($className){
        $separator = '_';
        $strPath   = '';
        $intPosition = strpos($className, $separator);
        if ($intPosition === false || $intPosition === 0) {
            return false;
        } 

        $arrDirectorys = explode($separator, $className);
        //get the last one
        $fileName = array_pop($arrDirectorys);
        foreach ($arrDirectorys as &$directory){
           $strPath .= strtolower($directory).DIRECTORY_SEPARATOR; 
        }
        $strPath .= ucfirst($fileName).'.php';

        return SYS_ROOT.$strPath;
    } 

    /**
     * define class map
     */
    public static function getClassMaps(){
        return array(
            'BaseRouter' => dirname(__FILE__).'/base/BaseRouter.php',
            'BaseException' => dirname(__FILE__).'/base/BaseException.php',
            'BaseSystemException' => dirname(__FILE__).'/base/BaseSystemException.php',
            'BaseLogger' => dirname(__FILE__).'/base/BaseLogger.php',
            'BaseRequest' => dirname(__FILE__).'/base/BaseRequest.php',
            'BaseApplication' => dirname(__FILE__).'/base/BaseApplication.php',
            'BaseError' => dirname(__FILE__).'/base/BaseError.php',
            'Config' => dirname(dirname(__FILE__)).'/Config/Config.php',
            'DbInterface' => dirname(__FILE__).'/db/DbInterface.php',
            'DbFactory' => dirname(__FILE__).'/db/DbFactory.php',
        );
    }

}


if (function_exists("__autoload")){
    spl_autoload_register("__autoload");
}

spl_autoload_register(array('Autoload','autoloadClass'));

?>
