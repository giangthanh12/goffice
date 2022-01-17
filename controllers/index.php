<?php
class index extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        require "layouts/header.php";
        $this->view->render("index/index");
        require "layouts/footer.php";
    }


}

?>
