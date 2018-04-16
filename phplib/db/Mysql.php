<?php

class Mysql implements DbInterface {

    // static variable
    private static $objConnection;
    public $host;
    public $port;
    public $userName;
    public $password;
    public $dbName;

    // construct 啥都不做，
    // 防止用户new后，没有实质的数据库操作，从而导致空连接
    public function __construct($host, $port, $userName, $password, $dbName) {
        $this->host = $host;
        $this->port = $port;
        $this->userName = $userName;
        $this->dbName = $dbName;
    }


    // 获取连接句柄
    // 如果为空，则连接,复用连接
    public function connect() {
        if (empty(self::$objConnection)) { 
            self::$objConnection = mysqli_connect($this->host, $this->userName, $this->password,
                $this->dbName, $this->port);
        }
        return self::$objConnection;
    }

    public function create($arrData) {
    }
    public function update($arrData, $arrWhere) {
    }
    public function deleteData($arrWhere) {
    }

    /**
     * query for find
     * @param array $arrWhere
     * ex : array(
     *              "field" => $value
     *      )
     * 
     *
     */
    public function findByConds($arrWhere, $arrFields) {
        $this->connect();

        //$querySql =; 
//        mysqli_query($this->objConnection,
    }
    public function findOneByConds($arrWhere) {
    }

    /**
     * return the formate sql 
     * note: SQL注入风险
     * @param $arrParams
     * $arrParam = array(
     *      "key = " => $value,
     *      "key > " => $value,
     *      1 => $value,
     *      2 => array('key','in',array(1,2)) 
     *      3 => 'a =1 or a=2'
     * );
     *
     */
    public function getCommonSql($arrParams) {
        $arrParams = $this->checkSql($arrParams);

        $arrSql = array();
        $arrJoin = array('in','not in');

        foreach ($arrParams  as $key =>$value) {
            if (is_int($key) && is_string($value)) {
                $arrSql[] = '('.$value.')';
            } else if (is_string($key)) {
               $arrSql[] =  '('.$key." ".$value.')';
            } else if (is_array($value) && in_array($value[1],$arrJoin) ) {
                $list = implode(',', $value[2]);
                $arrSql[] = "($value[0] $value[1] ($list))"; 
            }
        }

        $strSql = implode(' and ', $arrSql);
        return $strSql;
    }

    
    public function checkSql($arrParams) {
        foreach ($arrParams as $key => &$param) {
            if (is_string($param)) {
                $param = "'".addslashes($param)."'";
            } else if (is_array($param)) {
                $param = $this->checkSql($param);
            }
        }
        return $param;
    }

}

?>
