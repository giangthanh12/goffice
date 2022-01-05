<?php

class group_roles_model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function listObj()
    {
        $query = $this->db->query("SELECT *
        FROM grouproles WHERE status > 0");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getMenusByGroup($groupId)
    {
        $result = array();
        $query = $this->db->query("SELECT functionIds,menuIds
          FROM grouproles WHERE id=$groupId");
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
        $query = $this->db->query("SELECT *,parentId as cha
        FROM g_menus WHERE active > 0 ORDER BY sortOrder,id");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = functions::dequy($result, 0, 1);
        foreach ($result as $key => $menu) {
            $menuId = $menu['id'];
            $result[$key]['checked'] = 0;
            if (in_array($menuId, $listMenus))
                $result[$key]['checked'] = 1;
            $qr = $this->db->query("SELECT *,parentId as cha
            FROM g_functions WHERE active > 0 AND menuId = $menuId ORDER BY sortOrder,id");
            $temp = $qr->fetchAll(PDO::FETCH_ASSOC);
            foreach ($temp as $key1 => $function) {
                $temp[$key1]['checked'] = 0;
                if (in_array($function['id'], $listFunctions))
                    $temp[$key1]['checked'] = 1;
            }
            $result[$key]['functions'] = $temp;
        }
        return $result;
    }

    function getGroupRole($id)
    {
        $result = array();
        $query = $this->db->query("SELECT *
          FROM grouproles WHERE id=$id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function addGroupRole($data)
    {
        $query = $this->insert("grouproles", $data);
        return $query;
    }

    function updateGroupRole($id, $data)
    {
        $query = $this->update("grouproles", $data, " id=$id ");
        return $query;
    }

    function setFunctionRole($groupId, $funcId, $check)
    {
        $result = array();
        $query = $this->db->query("SELECT functionIds
          FROM grouproles WHERE id=$groupId");
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
            $this->update('grouproles', ['functionIds' => $listFunc], "id=$groupId");
        } else
            $this->update('grouproles', ['functionIds' => $funcId], "id=$groupId");
        return $result;
    }

    function setMenuRole($groupId, $menuId, $check)
    {
        $result = array();
        $query = $this->db->query("SELECT menuIds
          FROM grouproles WHERE id=$groupId");
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
            $this->update('grouproles', ['menuIds' => $listMenu], "id=$groupId");
        } else
            $this->update('grouproles', ['menuIds' => $menuId], "id=$groupId");
        return $result;
    }

}

?>