<?php
class recruitment_result extends Controller{

    function __construct(){
     
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('recruitment_result');
        if ($checkMenuRole == false)
            header('location:' . HOME);
    
       
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