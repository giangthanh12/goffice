<?php

class calendar extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {

        $this->view->render("calendar/index");
   
    }


}

?>
