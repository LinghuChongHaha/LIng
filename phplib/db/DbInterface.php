<?php
/**
 * define the common method of DB
 */

interface DbInterface {

    // connect to the database
    public function connect(); 

    // 
    public function create($arrData);

    //
    public function update($arrData, $arrWhere);

    //
    public function deleteData($arrWhere);

    //
    public function findByConds($arrWhere);

    //
    public function findOneByConds($arrWhere);

}

?>
