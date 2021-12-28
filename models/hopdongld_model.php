<?php
class hopdongld_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function listObj(){
        $dieukien = " WHERE status > 0 ";
        $nhanvien = $_SESSION['user']['staffId'];
        if (in_array($nhanvien,[1,7,8,11,27])==false)
            $dieukien .= " AND a.staffId = " . $nhanvien;
        $query = $this->db->query("SELECT *,
            (SELECT name FROM contracttype WHERE id = a.type) as loaihd,
            (SELECT name FROM staffs WHERE id = a.staffId) as nhanvien,
            (SELECT name FROM department WHERE id = a.department) as phongban,
            (SELECT name FROM branch WHERE id = a.branch) as chinhanh,
            (SELECT name FROM position WHERE id = a.position) as vitri
            FROM laborcontract a $dieukien ORDER BY startDate DESC ");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_data_combo(){
        $result = array();
        $query = $this->db->query("SELECT id, name AS text FROM laborcontract WHERE status > 0 ");
        $result['items'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function addObj($data)
    {
        $query = $this->insert("laborcontract",$data);
        return $query;
    }

    function getdata($id){
        $result = array();
        $dieukien = "  WHERE id = $id ";
        $nhanvien = $_SESSION['user']['staffId'];
        if (in_array($nhanvien,[1,7,8,11,27])==false)
            $dieukien .= " AND staffId = " . $nhanvien;
        $query = $this->db->query("SELECT *,
                FORMAT(basicSalary,0) AS luong_co_ban,
                FORMAT(insuranceSalary,0) AS luong_bao_hiem,
                FORMAT(allowance,0) AS phu_cap,
                DATE_FORMAT(startDate,'%d/%m/%Y') as ngay_di_lam,
                DATE_FORMAT(stopDate,'%d/%m/%Y') as ngay_ket_thuc
                FROM laborcontract $dieukien");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("laborcontract",$data,"id = $id");
        return $query;
    }

    function delObj($id,$data)
    {
        $query = $this->update("laborcontract",$data,"id = $id");
        return $query;
    }

    
}
?>