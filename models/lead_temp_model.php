<?php
class lead_temp_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getLead()
    {
        $result = array();
        $where = " WHERE status IN (1,2,3) ";
        $query = $this->db->query("SELECT id, customerId, name, description, status, dateTime,
        (SELECT fullName FROM customers WHERE customer.id = lead.customerId) AS fullName
        FROM lead $where ORDER BY id DESC");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getCustomerById($id)
    {
        $result = array();
        $where = " WHERE status > 0 AND id = $id ";
        $query = $this->db->query("SELECT fullName, taxCode, address, type, status, representative, phoneNumber, email,
        (SELECT name FROM staffs WHERE staffs.id = customers.staffInCharge) AS staffName
        FROM customers $where ");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($result[0]))
            return $result[0];
        else return [];
    }

    function getTakeCareHistory($id)
    {
        $result = array();
        $where = " WHERE status > 0 AND leadId = $id ";
        $query = $this->db->query("SELECT *,
            (SELECT name FROM staffs WHERE staffs.id = takecare.staffId) AS staffName
            FROM takecare $where ORDER BY dateTime DESC");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function insertTakeCareHistory($data)
    {
        $query = $this->insert("takecare", $data);
        if ($query) {
            $leadId = $data['leadId'];
            $query = $this->db->query("SELECT *,
                (SELECT name FROM staffs WHERE staffs.id = takecare.staffId) AS staffName
                FROM takecare WHERE status > 0 AND leadId = $leadId  ORDER BY dateTime DESC");
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return [];
        }
    }

    function getCustomer()
    {
        $result = array();
        $where = " WHERE status = 1 ";
        $query = $this->db->query("SELECT id, fullName
            FROM customers $where ");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($result))
            return $result;
        else return [];
    }

    function insertLead($data)
    {
        $query = $this->insert("lead", $data);
        return $query;
    }

    function listObj($fromDate, $toDate)
    {
        $result = array();

        $where = " WHERE status IN (1,2,3) ";
        if ($fromDate != '') {
            $where .= " AND dateTime >= '$fromDate' ";
        }
        if ($toDate != '') {
            $where .= " AND dateTime <= '$toDate' ";
        }
        $query = $this->db->query("SELECT id, customerId, name, description, status,
            DATE_FORMAT(dateTime,'%d/%m/%Y') as dateTime,
            (SELECT fullName FROM customers WHERE customers.id = lead.customerId) AS fullName
            FROM lead $where ORDER BY id DESC ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp) {
            $result = $temp;
        }
        return $result;
    }

    function getData($id)
    {
        $result['data'] = array();
        $where = " WHERE status > 0 AND id = $id ";
        $query = $this->db->query("SELECT id, name, description, opportunity, status,
        (SELECT fullName FROM customers WHERE id = lead.customerId) AS customerName,
        (SELECT id FROM customers WHERE id = lead.customerId) AS customerId
        FROM lead $where");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($result[0]))
            $result = $result[0];
        return $result;
    }

    function updateObj($data, $id)
    {
        $query = $this->update("lead", $data, "id = $id");
        return $query;
    }

    function deleteObj($id)
    {
        $query = $this->update("lead", ['status' => 0], "id = $id");
        return $query;
    }

    //     function getdata($id){
    //         $result = array();
    //         $query = $this->db->query("SELECT *,
    //           IF(avatar='',CONCAT('".URLFILE."','/uploads/useravatar.png'),CONCAT('".URLFILE."/',avatar)) AS hinh_anh
    //           FROM staffs WHERE id=$id");
    //         $temp = $query->fetchAll(PDO::FETCH_ASSOC);
    //         $result['nhanvien'] = $temp[0];

    //         $query2 = $this->db->query("SELECT * FROM users WHERE staffId = $id AND 1 ");
    //         $temp = $query2->fetchAll(PDO::FETCH_ASSOC);
    //         if(isset($temp[0]))
    //             $result['account'] = $temp[0];
    //         else
    //             $result['account'] = 0;

    //         $query3 = $this->db->query("SELECT * FROM staffinfo WHERE staffId = $id");
    //         $temp = $query3->fetchAll(PDO::FETCH_ASSOC);
    //         if(isset($temp[0]))
    //             $result['nhanvien_info'] = $temp[0];
    //         else
    //             $result['nhanvien_info'] = 0;

    //         return $result;
    //     }

    //     function updateinfo($data,$id){
    //         $query = $this->update("staffs", $data, " id=$id ");
    //         return $query;
    //     }

    //     function thayanh($file,$id){
    //         if ($file=='')
    //             return false;
    //         else {
    //             $data = ['avatar'=>$file];
    //             $query = $this->update("staffs", $data, " id=$id ");
    //             return $query;
    //         }
    //     }

    //     function them($data){
    //         $query = $this->insert("staffs", $data);
    //         return $query;
    //     }

    //     function xoa($id){
    //         $query = $this->update("staffs", ['status'=>0], " id=$id ");
    //         return $query;
    //     }

    //     function thoiviec($id){
    //         $query = $this->update("staffs", ['status'=>6], " id=$id ");
    //         return $query;
    //     }

    //     function province(){
    //         $result = array();
    //         $query = $this->db->query("SELECT id, name AS `text` FROM province WHERE status=1");
    //         if ($query)
    //             $result = $query->fetchAll(PDO::FETCH_ASSOC);
    //         return $result;
    //     }

    // /*== Get account by ID nhan_vien ===== */
    //     function getAccountbyId($id){
    //         $result = array();
    //         $query = $this->db->query("SELECT * FROM users WHERE staffId = $id");
    //         if ($query)
    //             $result = $query->fetchAll(PDO::FETCH_ASSOC);
    //         return $result;
    //     }

    //     function checkUsername($username,$id){
    //         $query = $this->db->query("SELECT COUNT(id) as total FROM users WHERE username = '$username' AND id!=$id");
    //         $temp = $query->fetchAll(PDO::FETCH_ASSOC);
    //         return $temp[0]['total'];
    //     }

    //     function them_users($data){
    //         $query = $this->insert("users", $data);
    //         return $query;
    //     }
    //     function update_users($data,$id){
    //         $query = $this->update("users", $data, " id=$id ");
    //         return $query;
    //     }

    //  /** Social  nhanvien_info*/       
    //     function getNhanvienInfoId($id){
    //         $result = array();
    //         $query = $this->db->query("SELECT * FROM staffinfo WHERE staffId = $id");
    //         if ($query)
    //             $result = $query->fetchAll(PDO::FETCH_ASSOC);
    //         return $result;
    //     }
    //     function them_nhanvien_info($data){
    //         $query = $this->insert("staffinfo", $data);
    //         return $query;
    //     }
    //     function update_nhanvien_info($data,$id){
    //         $query = $this->update("staffinfo", $data, " staffId=$id ");
    //         return $query;
    //     }

}
