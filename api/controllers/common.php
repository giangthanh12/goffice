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

    function loaikh()
	{
		$jsonObj = $this->model->loaikh();
		echo json_encode($jsonObj);
	}

    function tinhtrangdata()
    {
        $jsonObj = $this->model->tinhtrangdata();
        echo json_encode($jsonObj);
    }

    function phanloaidata()
    {
        $jsonObj = $this->model->phanloaidata();
        echo json_encode($jsonObj);
    }

    function mangdata()
    {
        $jsonObj = $this->model->mangdata();
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