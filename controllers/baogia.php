<?php
class baogia extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("baogia/index");
        require "layouts/footer.php";
    }

    function add(){
        require "layouts/header.php";
        $this->view->product=$this->model->getProduct();
        $this->view->render("baogia/add");
        require "layouts/footer.php";
    }

    function edit(){
        require "layouts/header.php";
        $id = $_REQUEST['id'];
        $this->view->quote = $this->model->getQuote($id);
        $this->view->product=$this->model->getProduct();
        $this->view->render("baogia/edit");
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
        $data = ['fullName'=>$customer, 'name'=>$customer, 'address'=>$address, 'phoneNumber'=>$phone, 'email'=>$email, 'date'=>date('Y-m-d'), 'type'=>1, 'provinceId'=>$city, 'status'=>1];
        $ok = $this->model->newCustomer($data,$contact,$phone,$email);
        if ($ok) {
            $jsonObj['msg'] = "Đã thêm khách hàng";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
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
        $date = date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['date'])));
        $validDate = date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['validdate'])));
        $note = $_REQUEST['note'];
        $items = $_REQUEST['items'];
        $total = str_replace(',','',$_REQUEST['total']);
        $tax = str_replace(',','',$_REQUEST['tax']);
        $data = ['customerId'=>$customer, 'amount'=>$total, 'vat'=>$tax, 'note'=>$note, 'status'=>1, 'date'=>$date, 'validDate'=>$validDate, 'staffId'=>$_SESSION['user']['staffId']];
        $quoteid = $this->model->saveQuote($id,$data,$items);
        if ($quoteid>0) {
            $jsonObj['msg'] = "Đã ghi báo giá";
            $jsonObj['success'] = true;
            $jsonObj['id'] = $quoteid;
        } else {
            $jsonObj['msg'] = "Cập nhật không thành công";
            $jsonObj['success'] = false;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function getEmails(){
        $id = $_REQUEST['id'];
        $email = $this->model->getEmails($id);
        $result = json_encode($email);
        echo $result;
    }

    function send(){ // gui bao gia qua email
        $id = $_REQUEST['id'];
        $emailList = $_REQUEST['emailList'];
        $sendmail = $this->model->send($id,$emailList);
        $result = json_decode($sendmail,true);
        if (isset($result['Messages'][0]['Status']) && ($result['Messages'][0]['Status']=='success')) {
            $jsonObj['msg'] = "Đã ghi báo giá và email cho khách hàng";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi gửi email";
            $jsonObj['success'] = false;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function printout()
    {
        $this->view->id = $_REQUEST['quoteNum'];
        $this->view->date = $_REQUEST['date'];
        $this->view->validDate = $_REQUEST['validDate'];
        $this->view->customer = $_REQUEST['cusPrint'];
        $this->view->note = $_REQUEST['notePrint'];
        $this->view->items = json_decode($_REQUEST['itemsPrint']);
        $this->view->render("baogia/print");
    }

    function dataTable(){
        $jsonObj = $this->model->listObj();
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function printQuote(){
        $id = $_REQUEST['id'];
        $this->view->quote = $this->model->printQuote($id);
        $this->view->render("baogia/print");
    }

    function del(){
        $id = $_REQUEST['id'];
        if ($this->model->delObj($id)) {
            $jsonObj['msg'] = "Đã xóa bản ghi";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function getSubQuotation(){
        $id = $_REQUEST['id'];
        // $data = [[
        //   "price"=> "450,000",
        //   "discount"=> "100",
        //   "qty"=> "1",
        //   "chietkhau"=> "10",
        //   "thanhtien"=> "450,000",
        //   "vat"=> "20",
        //   "noteProduct"=> "zzz",
        //   "product"=> "2",
        //   "productName"=> "Đăng ký tên miền .VN",
        //   "unit"=> "lần"
        // ]];
        $data =  $this->model->getSubQuotation($id);
        $jsonObj = json_encode($data);
        echo $jsonObj;
    }
}
?>
