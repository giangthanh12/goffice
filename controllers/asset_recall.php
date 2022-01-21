<?php
class asset_recall extends Controller{
    static protected $funcs;
    function __construct(){
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('asset_recall');
        if ($checkMenuRole == false)
        header('location:' . HOME);
        self::$funcs = $model->getFunctions('asset_recall'); 
    }

    function index(){
        $this->view->funs  = self::$funcs;
        require "layouts/header.php";
        $this->view->render("asset_recall/index");
        require "layouts/footer.php";
    }

    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }


    function loaddata()
    {
        $id=isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }
  


    function taisan()
    {
        $json = $this->model->taisan();
        echo json_encode($json);
    }
    function capphat()
    {
        $json = $this->model->capphat();
        echo json_encode($json);
    }

    
    


    


}
?>