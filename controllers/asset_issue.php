<?php
class asset_issue extends Controller{
    static protected $funcs;
    function __construct(){
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('asset_issue');
        if ($checkMenuRole == false)
        header('location:' . HOME);
        self::$funcs = $model->getFunctions('asset_issue'); 
    }

    function index(){
        $this->view->funs  = self::$funcs;
        require "layouts/header.php";
        $this->view->render("asset_issue/index");
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

    function getAsset()
    {
        $json = $this->model->getAsset();
        echo json_encode($json);
    }
    function getAllAsset()
    {
        $json = $this->model->getAllAsset();
        echo json_encode($json);
    }
    function getStaff()
    {
        $json = $this->model->getStaff();
        echo json_encode($json);
    }

}
?>