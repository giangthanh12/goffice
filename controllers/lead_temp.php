<?php
class lead_temp extends Controller
{
    static private $funAdd = 0, $funEdit = 0, $funDel = 0, $funtakecare = 0;
    function __construct()
    {
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('lead_temp');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        $funcs = $model->getFunctions('lead_temp');
      
        foreach ($funcs as $item) {
            if ($item['function'] == 'add')
                self::$funAdd = 1;
            if ($item['function'] == 'edit')
                self::$funEdit = 1;
            if ($item['function'] == 'takecare')
            self::$funtakecare = 1;
            if ($item['function'] == 'del')
                self::$funDel = 1;
        }
    }
    
    function index()
    {
        require "layouts/header.php";
        $this->view->funAdd = self::$funAdd;
        $this->view->funEdit = self::$funEdit;
        $this->view->funtakecare = self::$funtakecare;
        $this->view->funDel = self::$funDel;
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
        if (self::$funtakecare == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
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

    function checkPhone()
    {
        $customerPhone = $_REQUEST['customerPhone'];
        if ($this->model->checkPhone($customerPhone)) {
            $jsonObj['msg'] = "Số điện thoại hợp lệ";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Số điện thoại đã tồn tại";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function insertLead()
    {
        if (self::$funAdd == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        if (isset($_REQUEST['leadName']) && $_REQUEST['leadCustomer']) {
            $customer = $_REQUEST['leadCustomer'];
            if($customer==-1) {
                $customerName = $_REQUEST['customerName'];
                $customerPhone = $_REQUEST['customerPhone'];
                $customerEmail = $_REQUEST['customerEmail'];
                $customerData = [
                    'fullName' => $customerName,
                    'phoneNumber' => $customerPhone,
                    'email' => $customerEmail,
                    'status' => 1
                ];
                $customer = $this->model->addCustomer($customerData);
            }
            $title = $_REQUEST['leadName'];
            $desc = $_REQUEST['leadDesc'];
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

    function leadSearch()
    {
        $fromDate = isset($_REQUEST['fromDate']) && $_REQUEST['fromDate'] != '' ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['fromDate']))) : '';
        $toDate = isset($_REQUEST['toDate']) && $_REQUEST['toDate'] != '' ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['toDate']))) : '';
        $result = json_encode($this->model->listObj($fromDate, $toDate));
        echo $result;
    }

    function loadData()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getData($id);
        echo json_encode($json);
    }

    function deleteLead()
    {
        if (self::$funDel == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $id = $_REQUEST['id'];
        if ($this->model->deleteObj($id)) {
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function updateLead($id)
    {
        if (self::$funEdit == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $id = $_REQUEST['leadIdUpdate'];
        $name = $_REQUEST['leadNameUpdate'];
        $comment = $_REQUEST['leadDescUpdate'];
        $customer = $_REQUEST['leadCustomerUpdate'];
        $opportunity = $_REQUEST['opportunityUpdate'];
        $status = $_REQUEST['statusUpdate'];
        
        $data = ['name' => $name, 'description' => $comment, 'customerId' => $customer, 'opportunity' => $opportunity, 'status' => $status];
        if ($this->model->updateObj($data, $id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

 

}
