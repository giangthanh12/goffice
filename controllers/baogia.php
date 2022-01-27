<?php
class baogia extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        // $deadline = isset($_REQUEST['deadline'])?$_REQUEST['deadline']:false;
        // $status = isset($_REQUEST['status'])?$_REQUEST['status']:'';
        // $project = isset($_REQUEST['project'])?$_REQUEST['project']:0;
        // $nhanvien = isset($_REQUEST['assignee'])?$_REQUEST['assignee']:$_SESSION['user']['staffId'];
        // $this->view->list=$this->model->getList($nhanvien, $project, $status,$deadline);
        // $this->view->project=$this->model->getProject();
        // $this->view->tag=$this->model->getLabel();
        // $this->view->employee=$this->model->getEmployee();
        $this->view->render("baogia/index");
        require "layouts/footer.php";
    }

    function add(){
        require "layouts/header.php";
        $this->view->product=$this->model->getProduct();
        $this->view->render("baogia/add");
        require "layouts/footer.php";
    }

    function getProductDetail(){
        $id = $_REQUEST['id'];
        $product = $this->model->getProductDetail($id);
        if (count($product)>0) {
            $jsonObj['row'] = $product;
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi query database";
            $jsonObj['success'] = false;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function newCustomer(){ // them khach hang moi
        $customer = $_REQUEST['cusName'];
        $address = $_REQUEST['cusAdd'];
        $city = $_REQUEST['city'];
        $contact = $_REQUEST['cusContact'];
        $phone = $_REQUEST['cusPhone'];
        $email = $_REQUEST['cusEmail'];
        $data = ['fullName'=>$customer, 'shortName'=>$customer, 'address'=>$address, 'date'=>date('Y-m-d'), 'provinceId'=>$city, 'status'=>1];
        $ok = $this->model->newCustomer($data,$contact,$phone,$email);
        if ($ok) {
            $jsonObj['msg'] = "Đã thêm khách hàng";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi cập nhật database";
            $jsonObj['success'] = false;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function khachhang(){
        $keyword = isset($_REQUEST['search'])?$_REQUEST['search']:'';
        $json = $this->model->getCustomer($keyword);
        echo json_encode($json);
    }

    function save(){ // ghi nhap
        $id = $_REQUEST['id'];
        $customer = $_REQUEST['customer'];
        $date = $_REQUEST['date'];
        $validDate = $_REQUEST['validdate'];
        $note = $_REQUEST['note'];
        $items = $_REQUEST['items'];
        $total = str_replace(',','',$_REQUEST['total']);
        $tax = str_replace(',','',$_REQUEST['tax']);
        $data = ['customerId'=>$customer, 'amount'=>$total, 'vat'=>$tax, 'note'=>$note, 'status'=>1, 'date'=>$date, 'validDate'=>$validDate];
        $quoteid = $this->model->saveQuote($id,$data,$items);
        if ($quoteid>0) {
            $jsonObj['msg'] = "Đã ghi báo giá";
            $jsonObj['success'] = true;
            $jsonObj['id'] = $quoteid;
        } else {
            $jsonObj['msg'] = "Cập nhật không thành công".json_encode($items);
            $jsonObj['success'] = false;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function send(){ // gui bao gia qua email
        // $id = $_REQUEST['id'];
        // $customer = $_REQUEST['customer'];
        // $date = $_REQUEST['date'];
        // $validDate = $_REQUEST['validdate'];
        // $note = $_REQUEST['note'];
        // $items = $_REQUEST['items'];
        // $total = str_replace(',','',$_REQUEST['total']);
        // $tax = str_replace(',','',$_REQUEST['tax']);
        // $data = ['customerId'=>$customer, 'amount'=>$total, 'vat'=>$tax, 'note'=>$note, 'status'=>1, 'date'=>$date, 'validDate'=>$validDate];
        // $quoteid = $this->model->send($id,$data,$items);
        // if ($quoteid>0) {
        //     $jsonObj['msg'] = "Đã gửi báo giá và ghi lại";
        //     $jsonObj['success'] = true;
        //     $jsonObj['id'] = $quoteid;
        // } else {
        //     $jsonObj['msg'] = "Cập nhật không thành công".json_encode($items);
        //     $jsonObj['success'] = false;
        // }
        // $jsonObj = json_encode($jsonObj);
        // echo $jsonObj;
        $result = $this->model->send();
        echo $result;
    }

    // function del(){
    //     $id = $_REQUEST['id'];
    //     if ($this->model->delObj($id)) {
    //         $jsonObj['msg'] = "Đã xóa item";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Xóa không thành công";
    //         $jsonObj['success'] = false;
    //     }
    //     $jsonObj = json_encode($jsonObj);
    //     echo $jsonObj;
    // }
    //
    // function addcomment(){
    //     $id = $_REQUEST['id'];
    //     $comment = $_REQUEST['comment'];
    //     $return = $this->model->addcomment($id,$comment);
    //     if ($return['query']) {
    //         $jsonObj['msg'] = "Cập nhật thành công";
    //         $jsonObj['success'] = true;
    //         $jsonObj['receiver'] = $return['receiver'];
    //     } else {
    //         $jsonObj['msg'] = "Lỗi khi cập nhật database";
    //         $jsonObj['success'] = false;
    //     }
    //     $jsonObj = json_encode($jsonObj);
    //     echo $jsonObj;
    // }
    //
    // function completed(){
    //     $id = $_REQUEST['id'];
    //     if ($this->model->completed($id)) {
    //         $jsonObj['msg'] = "Chúc mừng bạn đã hoàn thành task này";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Lỗi khi cập nhật database";
    //         $jsonObj['success'] = false;
    //     }
    //     $jsonObj = json_encode($jsonObj);
    //     echo $jsonObj;
    // }
    //
    function printout()
    {
        $this->view->render("baogia/print");
    }

}
?>
