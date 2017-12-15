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

    }

	/***
     *
     * auto load user related files*
     * dynamci loading
     * like directorys:
     * Service, Data,Dao
     */
    public static function autoloadDynamicClass($className){
        $separator = '_';
        $intPosition = strpos($separator,$className);
        if ($intPosition === false || $intPosition === 0) {
            return false;
        }   

        $arrDirectorys = explode($separator, $className);
        foreach ($arrDirectorys as &$directory){
           $directory = ucfirst($directory); 
        }   
        $strPath = implode('/',$arrDirectorys);
        $strPath .= '.php';

        return ROOT.$strPath;
    } 

    /**
     * define class map
     */
    public static function getClassMaps(){
        return array(
            'BaseRouter' => dirname(__FILE__).'/base/BaseRouter.php',
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
