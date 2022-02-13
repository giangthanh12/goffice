<?php
class Data_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function addCustomer($data)
    {
        $this->insert("customers", $data);
        return $this->db->lastInsertId();
    }

    function addLead($data)
    {
        $ok = false;
        $ok = $this->insert("lead", $data);
        return $ok;
    }

    function listObj($keyword, $nhanvien, $tungay, $denngay, $offset, $rows)
    {
        $result = array();
        $result['data'] = [];
        $result['total'] = 0;

        $dieukien = " WHERE status > 0 AND status != 6 ";
        if ($keyword != '') {
            $dieukien .= " AND (name LIKE '%$keyword%' OR phoneNumber LIKE '%$keyword%') ";
        }
        if ($nhanvien > 0 && $nhanvien != 1 && $nhanvien != 2) {
            $dieukien .= " AND staffId = $nhanvien ";
        }
        if ($tungay != '') {
            $dieukien .= " AND inputDate >= '$tungay' ";
        }
        if ($denngay != '') {
            $dieukien .= " AND inputDate <= '$denngay' ";
        }
        $query = $this->db->query("SELECT id FROM data $dieukien ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($temp) {
            $result['total'] = count($temp);
        }

        $query = $this->db->query("SELECT *,
            DATE_FORMAT(inputDate,'%d/%m/%Y') as inputDate,
            IF(assignmentDate!='',DATE_FORMAT(assignmentDate,'%d/%m/%Y'),'') as assignmentDate,
            IF(birthDay!='',DATE_FORMAT(birthDay,'%d/%m/%Y'),'') as birthDay,
            (SELECT name FROM staffs WHERE id = inputId) as input,
            (SELECT name FROM datasource WHERE id= sourceId) as source,
            IFNULL((SELECT name FROM staffs WHERE id = staffId),'') as staff
            FROM data $dieukien ORDER BY id DESC LIMIT $offset,$rows ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp) {
            $result['data'] = $temp;
        }
        return $result;
    }

    function addObj($data)
    {
        $query = $this->insert("data", $data);
        return $query;
    }

    function getData($id)
    {
        $result = [];
        $result['data'] = array();
        $result['histories'] = array();
        $query = $this->db->query("SELECT *,
        IFNULL((SELECT MAX(dateTime) FROM datareports WHERE dataId = $id AND status > 0),'') AS lastTimeCare
        FROM data WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result['data'] = $temp[0];
        $query = $this->db->query("SELECT *,
            (SELECT IF(avatar='',CONCAT('" . HOME . "','/layouts/useravatar.png'),CONCAT('" . URLFILE . "/uploads/nhanvien/',avatar)) FROM staffs WHERE id=a.staffId) AS hinhanh,
            (SELECT name FROM staffs WHERE id = a.staffId) AS username,
            IF(dateTime!='',DATE_FORMAT(dateTime,'%d/%m/%Y %H:%i:%s'),'') as dateTime
            FROM datareports a WHERE status = 1 AND dataId = $id ORDER BY dateTime DESC");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp)
            $result['datareports'] = $temp;
        return $result;
    }

    // function getHistory($id)
    // {
    //     $result = array();
    //     $query = $this->db->query("SELECT *,
    //         (SELECT email FROM users WHERE id = a.staffId) AS username,
    //         (SELECT hinh_anh FROM staffs WHERE id = a.staffId) AS avatar
    //         FROM lichsu_data a WHERE status = 1 AND id_data = $id ORDER BY ngay_gio ASC");
    //     $temp = $query->fetchAll(PDO::FETCH_ASSOC);
    //     if ($temp)
    //         $result = $temp;
    //     return $result;
    // }

    function updateObj($id, $data)
    {
        $query = $this->update("data", $data, "id = $id");
        return $query;
    }

    function chiadata($nhanvien, $data)
    {
        $ok = false;
        $staffInCharge = $_SESSION['user']['staffId'];
        $rows = explode(',', $data);
        foreach ($rows as $row) {
            $id = $row;
            $query = $this->db->query("SELECT status FROM data WHERE id = $id");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            $tinhtrang = $temp[0]['status'];
            if ($tinhtrang == 1 || $tinhtrang == '') {
                $update = ['status' => 2, 'staffInCharge' => $staffInCharge, 'staffId' => $nhanvien, 'assignmentDate' => date('Y-m-d')];
            } else {
                $update = ['staffInCharge' => $staffInCharge, 'staffId' => $nhanvien, 'assignmentDate' => date('Y-m-d')];
            }
            $ok = $this->update("data", $update, " id=$id ");
        }
        return $ok;
    }

    // function movetolead($data)
    // {
    //     $ok = false;
    //     $rows = explode(',', $data);
    //     foreach ($rows as $row) {
    //         $id = $row;
    //         $update = ['status' => 6];
    //         $ok = $this->update("data", $update, "id=$id");
    //     }
    //     return $ok;
    // }

    function checkPhoneNumber($phoneNumber, $id)
    {
        if ($phoneNumber != '') {
            $dieukien = " WHERE status > 0 AND phoneNumber='$phoneNumber'";
            if ($id > 0) {
                $dieukien .= " AND id != $id ";
            }
            $query = $this->db->query("SELECT COUNT(id) AS total FROM data $dieukien ");
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($row[0]['total'] > 0)
                return false;
            else {
                $query = $this->db->query("SELECT COUNT(id) AS total FROM customers WHERE status > 0 AND phoneNumber = '$phoneNumber' ");
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                if ($row[0]['total'] > 0)
                    return false;
                else
                    return true;
            }
        } else
            return true;
    }

    function addDataReport($data)
    {
        $query = $this->insert('datareports', $data);
        return $query;
    }
}
