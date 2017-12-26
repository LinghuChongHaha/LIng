<?php
/**
 * @author Ling
 * @date 2017.12.15
 * all access starts from this class
 *
 */
class BaseApplication {

    public function run() {
        $path = $_SERVER['REQUEST_URI'];

    }

    public function runController($urlRoute) {
        if (empty($urlRoute)) {
           $urlRoute = $this->defaultRoute; 
        }

        //first map the config routeMap
        //you can config the url you want
        if (in_array($urlRoute, self::$routeMap)) {
            
        }

        // second match the url to controller
        

    
    }
}

?>
