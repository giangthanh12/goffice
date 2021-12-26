<?php
class Taisankhauhao extends Controller{
    function __construct(){
        parent::__construct();
    }

    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }


}
?>