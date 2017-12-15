<?php
/**
 * default router class
 *
 * automatic loading of files*
 **
 */
class BaseRouter {
    
    public function __construct() {
        
    }


    /***
     *
     * auto load user related files*
     */
    public static function autoloadClass($className){
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
}

?>
