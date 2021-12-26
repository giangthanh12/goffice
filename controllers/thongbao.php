<?php
class thongbao extends Controller{
    function __construct(){
        parent::__construct();
    }
    function index(){
        require "layouts/header.php";
        $this->view->render("thongbao/index");
        require "layouts/footer.php";
    }

}
?>