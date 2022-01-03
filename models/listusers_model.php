<?php

class listusers_model extends Model
{
    function __construst()
    {
        parent::__construst();
    }

    function getAllData()
    {
        $nhanvien = array();
        $query = $this->db->query("SELECT *,
            (SELECT name FROM staffs WHERE id=staffId) as staffName,
            (SELECT name FROM grouproles WHERE id=groupId) as groupName,
            (SELECT avatar FROM staffs WHERE id=staffId) as avatar
            FROM users WHERE status > 0 ORDER BY id DESC ");
        if ($query)
            $nhanvien['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $nhanvien;
    }

    function getDataById($id)
    {
        $result = array();
        $query = $this->db->query("SELECT *
          FROM users WHERE id=$id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($temp[0]))
            $result = $temp[0];

        return $result;
    }

    function checkUsername($username)
    {
        $query = $this->db->query("SELECT count(id) AS total
          FROM users WHERE username='$username'");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        return $temp[0]['total'];
    }

    function updateObj($data, $id)
    {
        $query = $this->update("users", $data, " id=$id ");
        return $query;
    }

    function addObj($data)
    {
        $query = $this->insert("users", $data);
        return $query;
    }

    function delObj($id)
    {
        $query = $this->update("users", ['status' => 0], " id=$id ");
        return $query;
    }

    function getMenusByUser($userId)
    {
        $query = $this->db->query("SELECT menuIds,functionIds
          FROM userroles WHERE userId=$userId");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($temp[0])) {
            if ($temp[0]['menuIds'] != '')
                $listMenus = explode(",", $temp[0]['menuIds']);
            else
                $listMenus = [];
            if ($temp[0]['functionIds'] != '')
                $listFunctions = explode(",", $temp[0]['functionIds']);
            else
                $listFunctions = [];
        } else {
            $listMenus = [];
            $listFunctions = [];
        }
        $query = $this->db->query("SELECT menuIds,functionIds
          FROM grouproles WHERE id=(SELECT groupId FROM users WHERE id=$userId) AND status>0");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($temp[0])) {
            if ($temp[0]['menuIds'] != '')
                $listGroupMenus = explode(",", $temp[0]['menuIds']);
            else
                $listGroupMenus = [];
            if ($temp[0]['functionIds'] != '')
                $listGroupFunctions = explode(",", $temp[0]['functionIds']);
            else
                $listGroupFunctions = [];
        } else {
            $listGroupMenus = [];
            $listGroupFunctions = [];
        }
        $query = $this->db->query("SELECT *,parentId as cha
        FROM g_menus WHERE active > 0 ORDER BY sortOrder,id");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = functions::dequy($result, 0, 1);
        foreach ($result as $key => $menu) {
            $menuId = $menu['id'];
            $result[$key]['checked'] = 0;
            $result[$key]['disable'] = 0;
            if (in_array($menuId, $listGroupMenus)) {
                $result[$key]['disable'] = 1;
                $result[$key]['checked'] = 1;
            } else if (in_array($menuId, $listMenus))
                $result[$key]['checked'] = 1;
            $qr = $this->db->query("SELECT *,parentId as cha
            FROM g_functions WHERE active > 0 AND menuId = $menuId ORDER BY sortOrder,id");
            $temp = $qr->fetchAll(PDO::FETCH_ASSOC);
            foreach ($temp as $key1 => $function) {
                $temp[$key1]['checked'] = 0;
                $temp[$key1]['disable'] = 0;
                if (in_array($function['id'], $listGroupFunctions)){
                    $temp[$key1]['disable'] = 1;
                    $temp[$key1]['checked'] = 1;
                }
                elseif (in_array($function['id'], $listFunctions))
                    $temp[$key1]['checked'] = 1;
            }
            $result[$key]['functions'] = $temp;
        }
        return $result;
    }

    function getUserRole($id)
    {
        $result = array();
        $query = $this->db->query("SELECT *
          FROM userroles WHERE id=$id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function addUserRoles($data)
    {
        $query = $this->insert("userroles", $data);
        return $query;
    }

    function updateUserRole($id, $data)
    {
        $query = $this->update("userroles", $data, " userId=$id ");
        return $query;
    }

    function setFunctionRole($userId, $funcId, $check)
    {
        $result = array();
        $query = $this->db->query("SELECT functionIds
          FROM userroles WHERE userId=$userId AND status=1");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($temp[0])) {
            if ($temp[0]['functionIds'] != '') {
                $listFunc = explode(",", $temp[0]['functionIds']);
                if ($check == 'false') {
                    $listFunc = array_diff($listFunc, [$funcId]);
                } else {
                    array_push($listFunc, $funcId);
                }
            } else
                if ($check == 'true') {
                    $listFunc[] = $funcId;
                } else
                    $listFunc = '';
            $listFunc = implode(",", $listFunc);
            $this->update('userroles', ['functionIds' => $listFunc], "userId=$userId");
        } else
            $this->insert('userroles', ['functionIds' => $funcId,'status'=>1,'userId'=>$userId]);
        return $result;
    }

    function setMenuRole($userId, $menuId, $check)
    {
        $result = array();
        $query = $this->db->query("SELECT menuIds
          FROM userroles WHERE userId=$userId");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($temp[0])) {
            if ($temp[0]['menuIds'] != '') {
                $listMenu = explode(",", $temp[0]['menuIds']);
                if ($check == 'false') {
                    $listMenu = array_diff($listMenu, [$menuId]);
                } else {
                    array_push($listMenu, $menuId);
                }
            } else
                if ($check == 'true') {
                    $listMenu[] = $menuId;
                } else
                    $listMenu = '';
            $listMenu = implode(",", $listMenu);
            $this->update('userroles', ['menuIds' => $listMenu], "userId=$userId");
        } else
            $this->insert('userroles', ['menuIds' => $menuId,'status'=>1,'userId'=>$userId]);
        return $result;
    }

}

?>
