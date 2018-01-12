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
        #两种方式，一种是通过controller,找到对应的action
        #第二种凡是，通过/dictory/file找到对应的action默认寻找
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
