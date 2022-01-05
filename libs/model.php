<?php

class Model
{
    function __construct()
    {
        $this->db = new Database();
    }

    // them moi du lieu
    function insert($table, $array)
    {
        $cols = array();
        $bind = array();
        foreach ($array as $key => $value) {
            $cols[] = $key;
            $bind[] = "'" . $value . "'";
        }
        $query = $this->db->query("INSERT INTO " . $table . " (" . implode(",", $cols) . ") VALUES (" . implode(",", $bind) . ")");
        return $query;
    }

    // cap nhat du lieu
    function update($table, $array, $where)
    {
        $set = array();
        foreach ($array as $key => $value) {
            $set[] = $key . " = '" . $value . "'";
        }
        $query = $this->db->query("UPDATE " . $table . " SET " . implode(",", $set) . " WHERE " . $where);
        return $query;
    }

    // xoa du lieu
    function delete($table, $where = '')
    {
        if ($where == '') {
            $query = $this->db->query("DELETE FROM " . $table);
        } else {
            $query = $this->db->query("DELETE FROM " . $table . " WHERE " . $where);
        }
        return $query;
    }

    ////////////////////////////////// cac ham phu khac /////////////////////////////////////////////
    function check_token($token)
    {
        $query = $this->db->query("SELECT COUNT(id) AS total FROM users WHERE token = '$token'");
        $row = $query->fetchAll();
        return $row[0]['total'];
    }

    /////////////////////////////////// end cac ham phu khac /////////////////////////////////////////
    function getMenus($parentId,$type)
    {
        $classUser = $_SESSION['user']['classify'];
        $userId = $_SESSION['user']['id'];
        $groupId = $_SESSION['user']['groupId'];
        $menus = [];
        if ($classUser == 1) {
            $dieukien = " WHERE active = 1 AND parentId=$parentId AND type=$type ";
            $query = $this->db->query("SELECT id,link,icon,name FROM g_menus $dieukien ORDER BY sortOrder");
            $menus = $query->fetchAll();
        } else {
            $listMenu = '';
            $query = $this->db->query("SELECT menuIds FROM grouproles WHERE id=$groupId AND status=1");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if (isset($temp[0]['menuIds']) && $temp[0]['menuIds'] != '')
                $listMenu = $temp[0]['menuIds'];
            $query = $this->db->query("SELECT menuIds FROM userroles WHERE userId=$userId AND status=1");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if (isset($temp[0]['menuIds']) && $temp[0]['menuIds'] != '') {
                if ($listMenu != '')
                    $listMenu .= ',' . $temp[0]['menuIds'];
                else
                    $listMenu = $temp[0]['menuIds'];
            }

            $dieukien = " WHERE active = 1 AND parentId=$parentId AND type=$type ";
            if ($listMenu != '') {
                $dieukien .= " AND id IN ($listMenu) ";
                $query = $this->db->query("SELECT id,link,icon,name FROM g_menus $dieukien ORDER BY sortOrder");
                $menus = $query->fetchAll();
            }
        }
        return $menus;
    }

    function getFunctions($menuLink)
    {
        $classUser = $_SESSION['user']['classify'];
        $userId = $_SESSION['user']['id'];
        $groupId = $_SESSION['user']['groupId'];
        $functions = [];
        if ($classUser == 1) {
            $dieukien = " WHERE active = 1 AND menuId=(SELECT id FROM g_menus WHERE link='$menuLink') ";
            $query = $this->db->query("SELECT id,function,icon,name,type,color FROM g_functions $dieukien ORDER BY sortOrder");
            $functions = $query->fetchAll();
        } else {
            $listFuns = '';
            $query = $this->db->query("SELECT functionIds FROM grouproles WHERE id=$groupId AND status=1");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if (isset($temp[0]['functionIds']) && $temp[0]['functionIds'] != '')
                $listFuns = $temp[0]['functionIds'];
            $query = $this->db->query("SELECT functionIds FROM userroles WHERE userId=$userId AND status=1");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if (isset($temp[0]['functionIds']) && $temp[0]['functionIds'] != '') {
                if ($listFuns != '')
                    $listFuns .= ',' . $temp[0]['functionIds'];
                else
                    $listFuns = $temp[0]['functionIds'];
            }

            $dieukien = " WHERE active = 1 AND menuId=(SELECT id FROM g_menus WHERE link='$menuLink') ";
            if ($listFuns != '') {
                $dieukien .= " AND id IN ($listFuns) ";
                $query = $this->db->query("SELECT id,function,icon,name,type,color FROM g_functions $dieukien ORDER BY sortOrder");
                $functions = $query->fetchAll();
            }

        }
        return $functions;
    }

    function checkMenuRole($link)
    {
        if ($_SESSION['user']['classify'] == 1)
            return true;
        $dieukien = " WHERE active = 1 AND link='$link' ";
        $userId = $_SESSION['user']['id'];
        $groupId = $_SESSION['user']['groupId'];
        $query = $this->db->query("SELECT id FROM g_menus $dieukien ORDER BY sortOrder");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($temp[0]['id'])) {
            $menuId = $temp[0]['id'];
            $listMenu = '';
            $query = $this->db->query("SELECT menuIds FROM grouproles WHERE id=$groupId AND status=1");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if (isset($temp[0]['menuIds']) && $temp[0]['menuIds'] != '')
                $listMenu = $temp[0]['menuIds']; // lấy danh sách menuid của user
            $query = $this->db->query("SELECT menuIds FROM userroles WHERE userId=$userId AND status=1");
            $temp = $query->fetchAll(PDO::FETCH_ASSOC);
            if (isset($temp[0]['menuIds']) && $temp[0]['menuIds'] != '') {
                if ($listMenu != '')
                    $listMenu .= ',' . $temp[0]['menuIds'];
                else
                    $listMenu = $temp[0]['menuIds'];
            }
            if ($listMenu != '') {
                $listMenu = explode(",", $listMenu);
                if (in_array($menuId, $listMenu))
                    return true;
            } else
                return false;
        } else
            return false;
    }
}

?>