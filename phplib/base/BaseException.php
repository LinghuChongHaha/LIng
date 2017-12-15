<?php
/**
 * @author Ling
 * @date 2017.12.15
 *
 * define our own exception
 *
 */

class BaseException extends Exception {

    public $errNo;
    public $errMsg;
    public $errTrace;

    public function __construct($errNo, $errMsg){
        parent::__construct();
        $this->errNo = $errNo;
        $this->errMsg = $errMsg;

    }
}

?>
