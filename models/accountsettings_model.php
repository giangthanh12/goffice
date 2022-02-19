<?php

class accountsettings_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getData($id)
    {
        $result = array();
        $query = $this->db->query("SELECT *,
        DATE_FORMAT(birthday,'%d/%m/%Y') AS ngaysinh,
        DATE_FORMAT(idDate,'%d/%m/%Y') AS ngaycap,
        (SELECT username FROM users WHERE staffId = a.id AND status > 0 LIMIT 1) AS username
        FROM staffs a WHERE id=$id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result['staffInfo'] = $temp[0];
        $query = $this->db->query("SELECT * FROM staffinfo WHERE staffId=$id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($temp[0]))
            $result['social'] = $temp[0];
        else
            $result['social'] = [];
        return $result;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("staffs", $data, "id=$id");
        return $query;
    }

    function updateSocial($id, $data)
    {
        $query = $this->db->query("SELECT id FROM staffinfo WHERE staffId = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp) {
            $idinfo = $temp[0]['id'];
            $query = $this->update("staffinfo", $data, "id=$idinfo");
        } else {
            $data['staffId'] = $id;
            $query = $this->insert("staffinfo", $data);
        }
        return $query;
    }

    function thayanh($file, $id)
    {
        if ($file == '')
            return false;
        else {
            $data = ['avatar' => $file];
            $query = $this->db->query("SELECT * FROM staffs WHERE id = $id");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($temp) {
                $query = $this->update("staffs", $data, " id=$id ");
            } else {
                $query = $this->insert("staffs", $data);
            }
            return $query;
        }
    }

    function getPass($id)
    {
        $query = $this->db->query("SELECT password FROM users WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($temp)
            $id = $temp[0]['password'];
        return $id;
    }

    function changePass($id, $data)
    {
        $query = $this->update("users", $data, "id=$id");
        return $query;
    }
}
