<?php
/**
 * @author Ling
 * @date 2017.12.15
 * all access starts from this class
 *
 */
class BaseApplication {


    public function run() {
        try {
            $actionName = BaseRouter::router();
            $class      = new $actionName();
            $data = $class->myExecute();
            
        } catch (BaseException $e) {
            $result['errno'] = $e->getCode;
            $result['errmsg'] = $e->getMsg();
        } catch (BaseSystemException $e) {
            BaseLogger::errorLog($e->getCode(),$e->getTraceDetail()); 
            $result['errno'] = $e->getCode();
            $result['errmsg'] = 'system error';
        } catch (Exception $e) {
            BaseLogger::errorLog($e->getCode(),$e->getMsg());
            $result['errno'] = $e->getCode();
            $result['errmsg'] = 'exception,please try again'; 
        }

        $result['errno'] = 0;
        $result['errmsg'] = '';
        $result['data'] = $data;
            
        echo $this->encodeResult($result);


    }


    public function encodeResult($data) {
        //header('Content-type:application/json;charset=utf-8');
        return json_encode($data); 
    }
}

?>
