<?php
/***
 * this is a path map file
 * note: controller name rule: Controller_
 */
class Controller_Index {

    public static function  getMapPath() {
        return array(
            //default router the index
           'index' => 'action/Index.php',
        );
    } 

}

?>
