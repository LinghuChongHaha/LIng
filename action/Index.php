<?php
/**
 * @author Ling
 * @date 2018-01-09
 * @desc There are a name rule: Action_Directory_ClassName
 */
class Action_Index {
    
    public function myExecute() {
        $data = new Data_Index();
        return $data->execute();
    }

}

?>
