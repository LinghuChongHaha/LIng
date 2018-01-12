<?php
/**
 * this is a input file
 * all program access it.*
 */
include('config/Init.php');
var_dump($_SERVER);exit;
var_dump(Controller_Ling::getMapPath());exit;
try {
    $aplication = new BaseApplication();
    $res = $aplication->run();
} catch (Exception $e) {
    BaseLogger::error($e->getCode(), $e->getMessage());
}
return $res;


?>
