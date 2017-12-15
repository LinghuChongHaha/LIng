<?php
/**
 * Initialize runtime environment
 * define a set of variables
 *
 */
$rootPath = dirname(dirname(__FILE__));
$rootPath = $rootPath.DIRECTORY_SEPARATOR;

ini_set('display_errors',0);
ini_set('error_reporting','E_ALL & ~E_NOTICE');

define("ROOT", $rootPath);

include(ROOT.'phplib/Autoload.php');

?>
