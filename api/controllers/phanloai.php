<?php
class Phanloai extends Controller{
    private $_Data;
    function __construct(){
        parent::__construct();
        $this->_Data = new Model();
    }

    function combo(){
        $json = $this->model->get_data_combo();
        echo json_encode($json);
    }
}
?>