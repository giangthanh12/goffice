<?php

class common extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function thanhpho() {
        $data = $this->model->thanhpho();
        echo json_encode($data);
    }

    function linhvuc()
    {
        $jsonObj = $this->model->linhvuc();
        echo json_encode($jsonObj);
    }

    function nhanvien()
    {
        $jsonObj = $this->model->nhanvien();
        echo json_encode($jsonObj);
    }

    function listStaff(){
        $json = $this->model->getListStaff();
        echo json_encode($json);
    }

    function typeContracts(){
        $json = $this->model->getTypeContracts();
        echo json_encode($json);
    }
    function departments(){
        $json = $this->model->getDepartments();
        echo json_encode($json);
    }
    function positions(){
        $json = $this->model->getPositions();
        echo json_encode($json);
    }

    function shifts(){
        $json = $this->model->getShifts();
        echo json_encode($json);
    }

    function branchs(){
        $json = $this->model->getBranchs();
        echo json_encode($json);
    }

    function workPlaces(){
        $json = $this->model->getWorkPlaces();
        echo json_encode($json);
    }

    function listGroup(){
        $json = $this->model->getListGroup();
        echo json_encode($json);
    }

    function datasource()
	{
		$jsonObj = $this->model->datasource();
		echo json_encode($jsonObj);
	}

    function datatype()
	{
		$jsonObj = $this->model->datatype();
		echo json_encode($jsonObj);
	}

    function datastatus()
    {
        $jsonObj = $this->model->datastatus();
        echo json_encode($jsonObj);
    }

    function tinhtranglienhe()
    {
        $jsonObj = $this->model->tinhtranglienhe();
        echo json_encode($jsonObj);
    }

    function tinhtrangkh()
    {
        $jsonObj = $this->model->tinhtrangkh();
        echo json_encode($jsonObj);
    }

    function nhacungcap()
    {
        $jsonObj = $this->model->nhacungcap();
        echo json_encode($jsonObj);
    }

    function thang()
    {
        $jsonObj = [
            ["id" => "01", "text" => "Tháng 1"],
            ["id" => "02", "text" => "Tháng 2"],
            ["id" => "03", "text" => "Tháng 3"],
            ["id" => "04", "text" => "Tháng 4"],
            ["id" => "05", "text" => "Tháng 5"],
            ["id" => "06", "text" => "Tháng 6"],
            ["id" => "07", "text" => "Tháng 7"],
            ["id" => "08", "text" => "Tháng 8"],
            ["id" => "09", "text" => "Tháng 9"],
            ["id" => "10", "text" => "Tháng 10"],
            ["id" => "11", "text" => "Tháng 11"],
            ["id" => "12", "text" => "Tháng 12"],
        ];
        echo json_encode($jsonObj);
    }

    function nam()
    {
        $jsonObj = [
            ["id" => "2020", "text" => "2020"],
            ["id" => "2021", "text" => "2021"],
            ["id" => "2022", "text" => "2022"],
            ["id" => "2023", "text" => "2023"],
            ["id" => "2024", "text" => "2024"],
            ["id" => "2025", "text" => "2025"],
            ["id" => "2026", "text" => "2026"],
            ["id" => "2027", "text" => "2027"],
            ["id" => "2028", "text" => "2028"],
            ["id" => "2029", "text" => "2029"],
            ["id" => "2030", "text" => "2030"],
            ["id" => "2031", "text" => "2031"],
        ];
        echo json_encode($jsonObj);
    }

}

?>