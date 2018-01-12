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
        'LOG_PATH' => ROOT.'/logs/', 

        //header route ,the default head of the request path
        //ex. /ling/xx/xx
        'HEAD_ROUTE' => '/ling',
    );
}

?>
