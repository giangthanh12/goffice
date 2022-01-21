<?php
class recruitment_result extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
    
        require "layouts/header.php";
        $this->view->render("recruitment_result/index");
        require "layouts/footer.php";
    }

    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }


    

    
    


    


}
?>