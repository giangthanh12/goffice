<?php
class position extends Controller{
    function __construct(){
        parent::__construct();
    }

    function listPositions()
    {
        $data = $this->model->listPositions();
        echo json_encode($data);
    }

}
?>