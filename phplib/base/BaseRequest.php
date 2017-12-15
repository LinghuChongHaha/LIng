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
     * handle url 
     *
     */
    public static function getPathInfo() {
        $requestUri = $_SERVER['REQUEST_URI'];
        $pathInfo = explode('?', $requestUri);
        
        return $pathInfo[0];
    }
}

?>
