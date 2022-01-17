<?php
class lead_temp extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        require "layouts/header.php";
        $this->view->lead = $this->model->getLead();
        $this->view->customer = $this->model->getCustomer();
        // print_r($this->model->getlead());
        $this->view->render("lead_temp/index");
        require "layouts/footer.php";
    }

    function getCustomerById()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getCustomerById($id);
        echo json_encode($json);
    }

    function getTakeCareHistory()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getTakeCareHistory($id);
        echo json_encode($json);
    }

    function insertTakeCareHistory()
    {
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $comment = $_REQUEST['comment'];
            $data = ['leadId' => $id, 'staffId' => $_SESSION['user']['staffId'], 'content' => $comment, 'dateTime' => date('Y-m-d H:i:s'), 'status' => 1];
            $temp = $this->model->insertTakeCareHistory($data);
            if ($temp == []) {
                $jsonObj['msg'] = "Cập nhật không thành công";
                $jsonObj['success'] = false;
            } else {
                $jsonObj['list'] = $temp;
                $jsonObj['success'] = true;
            }
            $jsonObj = json_encode($jsonObj);
            echo $jsonObj;
        }
    }

    function insertLead()
    {
        if(isset($_REQUEST['leadName']) && $_REQUEST['leadCustomer']){
        $title = $_REQUEST['leadName'];
        $desc = $_REQUEST['leadDes'];
        $customer = $_REQUEST['leadCustomer'];
        $opportunity = $_REQUEST['opportunity'];
        $data = array(
            'name' => $title, 'customerId' => $customer, 'description' => $desc, 'opportunity' => $opportunity, 'dateTime' => date('Y-m-d H:i:s'),
            'staffInCharge' => $_SESSION['user']['staffId'], 'status' => 1, 
        );
        $temp = $this->model->insertLead($data);
        if ($temp == true) {
            $jsonObj['message'] = "Cập nhật thành công";
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = 'Cập nhật không thành công';
            $jsonObj['code'] = 401;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }
    }

    function leadSearch() {
        $fromDate = isset($_REQUEST['fromDate']) && $_REQUEST['fromDate'] != '' ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['fromDate']))) : '';
        $toDate = isset($_REQUEST['toDate']) && $_REQUEST['toDate'] != '' ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['toDate']))) : '';
        $result = json_encode($this->model->listObj($fromDate, $toDate));
        echo $result;
    }
    
    function updateLead()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getData($id);
        echo json_encode($json);
    }

    // function list()
    // {
    //     // $phutrach = isset($_SESSION['user']['staffId']) ? $_SESSION['user']['staffId'] : (isset($_REQUEST['phu_trach']) ? $$_REQUEST['phu_trach'] : '');
    //     $keyword = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : (isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : '');
    //     $offset = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
    //     $rows = isset($_REQUEST['length']) ? $_REQUEST['length'] : 30;
    //     // $page = isset($_REQUEST['page']) ? $_REQUEST['page']: 1;
    //     // $offset = ($page - 1) * $rows;
    //     $nhanvien = isset($_REQUEST['nhanvien']) && $_REQUEST['nhanvien'] != '' && $_REQUEST['nhanvien'] != 0 ? $_REQUEST['nhanvien'] : '';
    //     $tungay = isset($_REQUEST['tu_ngay']) && $_REQUEST['tu_ngay'] != '' ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['tu_ngay']))) : '';
    //     $denngay = isset($_REQUEST['den_ngay']) && $_REQUEST['den_ngay'] != '' ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['den_ngay']))) : '';
    //     $result = $this->model->listObj($keyword, $nhanvien, $tungay, $denngay, $offset, $rows);
    //     $totalData = $result['total'];

    //     $data['data'] = $result['data'];
    //     $data['draw'] = intval(isset($_REQUEST['draw']) ? $_REQUEST['draw'] : 1);
    //     $data['recordsTotal'] = $totalData;
    //     $data['recordsFiltered'] = $totalData;
    //     echo json_encode($data);
    // }

}
