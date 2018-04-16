<?php
/**
 * @author Ling
 * @date 2017.12.15
 * this class is config file
 *
 * You can modify the config as you want
 *
 */
class Config{

    public static $arrConfig = array(
        'log_path' => SYS_ROOT.'logs/', 

        //header route ,the default head of the request path
        //ex. example.com/ling/xx/xx
        'head_route' => 'ling',

        // this configure defines the way of routing path
        // have two ways: controller,path
        // controller: define the route path in file
        // path : get the route path from the request path
        'router' => 'controller',


        //db config
        'db' => array(
            'driver' => 'mysql',
            // ip addresses
            'host' => '127.0.0.1:3309',
            'port' => '3309',
            // username
            'username' => 'yunying',
            'password' => 'yunying',
        ),

    );
}

?>
