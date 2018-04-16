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
        $actionName = '';
        $strPath = BaseRequest::getPathInfo();

        $routerWay = Config::$arrConfig['router'];
        $headRoute = Config::$arrConfig['head_route'];


        //fisrt check the controller weather have the request 
        if ($routerWay == 'controller') {
        
            $strController = self::getControllerPath($strPath, $headRoute);
            if (empty($strController))
                $strController = 'index';

            $strControllerName = self::getControllerName($strController);
            if (class_exists($strControllerName)) {
                $actionName = self::loadAction($strControllerName, $strPath, $headRoute); 
            }

            if (empty($actionName)) {
               throw new BaseSystemException(1, 'load action is empty ,controller:'.$strController);
            }


        } else if ($routerWay == 'path') {

            $actionName = self::getActionNameByPath($strPath);
            if (empty($actionName))
                $actionName = 'Action_Index';

        }

        return $actionName;
        
    }

    /**
     * @param $controllerName
     * @param $path
     * @desc load the action class according to the controller or the path
     *
     */
    public static function loadAction($controllerName, $path, $headRoute) {
        //wipe the url head
        $len = strlen($headRoute) + 1;
        $path = substr($path, $len);
        if (empty($path))
            $path = 'index';
        
        $arrMapPath = $controllerName::getMapPath();
        
        if (!empty($arrMapPath[$path])) {
            $mapPath = $arrMapPath[$path];
            $filePath = SYS_ROOT.$mapPath;

            if (!is_file($filePath)) {
                throw new BaseSystemException(1, 'the path '.$newPath,'error ,no file');
            }
            include $mapPath;
            
            return self::getActionName($mapPath); 

        } else {
            //没有找到path，要报错
            throw new BaseSystemException(1, 'controller exists,the path:'.$path .' not fund');
        }
    }

    /**
     * default
     * get the action name  from the request path
     */
    public static function getActionNameByPath($path) {
        $strHeadRoute = Config::$arrConfig['HEAD_ROUTE'];

        if (strpos($path,$strHeadRoute) !== 0) {
            throw new BaseSystemException(1, 'the url is invalid,missing the url head');
        }


        $arrPath = explode('/',$path);
        if (empty($arrPath))
            return '';

        //wipe the url head
        unset($arrPath[0]);

        array_map('ucfirst', $arrPath);
        $actionName = implode('_', $arrPath);
        return $actionName;
      }



    /**
     * by controller
     * get the controller path from the controller map according the request pathh
     */
    public static function getControllerPath($path, $headRoute) {
        $strControllerPath = '';
        $intIndex = 1;

        if (strpos($path, $headRoute) !== 0) {
            throw new BaseSystemException(1, 'the url is invalid,missing the url head');
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
     * @param $filePath
     * @desc get the action name 
     */
    public static function getActionName($filePath) {

        $intPosition = strpos($filePath, '.');
        $newPath = substr($filePath, 0, $intPosition);
        $arrPath = explode('/', $newPath); 
        $arrPath = array_map('ucfirst', $arrPath);

        return implode('_', $arrPath);
    }
}

?>
