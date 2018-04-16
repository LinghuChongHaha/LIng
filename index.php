<?php
/**
 * this is a input file
 * all program access it.*
 */
include './config/Init.php';
$mysql = DbFactory::getDbInstance('yunying');
var_dump($mysql);exit;
exit;
//$mysql->connect();exit;
try {
    $aplication = new BaseApplication();
    $res = $aplication->run();
} catch (Exception $e) {
    BaseLogger::error($e->getCode(), $e->getMessage());
}


?>
