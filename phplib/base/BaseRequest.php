<?php
/***
 * parse url 
 * initialize releated params and path
 *
 */

class BaseRequest {

    public function __construct(){
    
    }

    /**
     * merge all params like $_POST and $_GET ,even file://put
     */
    public static function getAllParams() {
        
    }

    /**
     * get the path uri 
     *
     */
    public static function getPathInfo() {
        $requestUri = $_SERVER['REQUEST_URI'];
        //wipe off the /
        $requestUri = substr($requestUri,1);
        $pathInfo = explode('?', $requestUri);
        
        return $pathInfo[0];
    }
}

?>
