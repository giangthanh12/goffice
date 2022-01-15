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
        $title = $_REQUEST['leadName'];
        $desc = $_REQUEST['leadDesc'];
        $customer = $_REQUEST['leadCustomer'];
        $opportunity = $_REQUEST['opportunity'];
        $data = array(
            'name' => $title, 'customerId' => $customer, 'description' => $desc, 'opportunity' => $opportunity, 'dateTime' => date('Y-m-d H:i:s'),
            'staffInCharge' => $_SESSION['user']['staffId'], 'status' => 1, 
        );
        $temp = $this->model->insertLead($data);
        if ($temp == true) {
            $jsonObj['msg'] = "Cập nhật thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Cập nhật không thành công';
            $jsonObj['success'] = false;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }
}
