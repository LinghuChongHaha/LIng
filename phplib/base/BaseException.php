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
        parent::__construct($errMsg, $errNo);
        $this->errNo = $errNo;
        $this->errMsg = $errMsg;
        $this->errTrace = $this->getTrace();
        //$this->errTrace = debug_backtrace();
    }

    /**
     * print debug detail
     */
    public function getTraceDetail() {
        $strTrace = '[erro] '.$this->errNo.',[errmsg] '.$this->errMsg;
        foreach ($this->errTrace as $trace) {
            $strTrace .= $trace['line'].': '.$trace['file'].',function:'.$trace['function']."\r\n";
        }

        return $strTrace;
    }


}

?>
