<?php
class nguonuv extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("nguonuv/index");
        require "layouts/footer.php";
    }

    function combo(){
        $json = $this->model->get_data_combo();
        echo json_encode($json);
    }
}
?>