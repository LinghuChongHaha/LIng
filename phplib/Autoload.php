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
            include($path);
            return true;
        }

        $dynamicPath = self::autoloadDynamicClass($className);
        if (!empty($dynamicPath)) {
            //suggest use include ranther than include_once
            include($dynamicPath);
            return true;
        }

        //write error log
        BaseLogger::error(1, 'autoload className:'.$className.' failed'); 

    }

	/***
     *
     * auto load user related files*
     * dynamci loading
     * like directorys:
     * LingActioner, LingData,LingDao, LingData
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
           $strPath .= strtolower($directory).'/'; 
        }
        $strPath .= ucfirst($fileName).'.php';

        return ROOT.$strPath;
    } 

    /**
     * define class map
     */
    public static function getClassMaps(){
        return array(
            'BaseRouter' => dirname(__FILE__).'/base/BaseRouter.php',
            'BaseException' => dirname(__FILE__).'/base/BaseException.php',
            'BaseLogger' => dirname(__FILE__).'/base/BaseLogger.php',
            'BaseRequest' => dirname(__FILE__).'/base/BaseRequest.php',
            'BaseApplication' => dirname(__FILE__).'/base/BaseApplication.php',
            'Config' => dirname(dirname(__FILE__)).'/Config/Config.php',
        );
    }

}


if (function_exists("__autoload")){
    spl_autoload_register("__autoload");
}

spl_autoload_register(array('Autoload','autoloadClass'));

?>
