<?php
/**
 * @author Ling
 * @date  2018-01-10
 * @desc
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
     * set the rote according the path
     */
    public static function router() {
        $strPath = BaseRequest::getPathInfo();

        //fisrt check the controller weather have the request 
        $strController = self::getControllerPath($strPath);
        $strControllerName = self::getControllerName($strController);
        if (class_exists($strControllerName)) {
            self::loadAction($strControllerName, $strPath); 
        }
        
    }

    /**
     * @param $controllerName
     * @param $path
     * @desc load the action class according to the controller or the path
     *
     */
    public static function loadAction($controllerName, $path) {
        $arrMapPath = $controllerName::getMapPath();
        
        if (!empty($arrMapPath[$path])) {
            $mapPath = $arrMapPath[$path];
            $mapPath = ROOT.$mapPath;

            if (!is_file($mapPath)) {
                throw new BaseException(1, 'the path '.$newPath,'error ,no file');
            }
            include $mapPath;
            
            return self::getActionName($mapPath); 

        } else {
            //没有找到path，要报错
            throw new BaseException(1, 'controller exists,the path:'.$path .' not fund');
        }
    }

    /**
     * get the controller path from the request path
     */
    public static function getControllerPath($path) {
        $strControllerPath = '';
        $intIndex = 0;
        $strHeadRoute = Config::$arrConfig['HEAD_ROUTE'];

        if (strpos($path,$strHeadRoute) === 0) {
            // match the head route successfully
            $intIndex = 1; 
        } else {
            // failed,return the first one
            $intIndex = 0; 
        }

        $arrPath = explode('/',$path);
        return $arrPath[$intIndex];
      }

    /**
     * return the controller class name
     */
    public static function getControllerName($name) {
        return 'Controller_'.$name;
    }

    /**
     * @param $path
     * @desc get the action name 
     */
    public static function getActionName($path) {

        $intPoisition = strpos('.', $path);
        $newPath = substr($path, 0, $intPoisition);
        $arrPath = explode('/', $path); 
        $arrPath = array_map('ucfirst', $arrPath);

        return implode('_', $arrPath);
    }
}

?>
