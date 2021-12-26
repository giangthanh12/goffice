<?php
class loaihd extends Controller{
    function __construct(){
        parent::__construct();
    }

    function combo(){
        $json = $this->model->get_data_combo();
        echo json_encode($json);
    }

    
}
?>