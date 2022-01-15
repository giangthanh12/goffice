<?php

class congtac_model extends Model
{
    function __construst()
    {
        parent::__construst();
    }
    //Hiển thị toàn bộ nhân viên
    function getAllData()
    {
        $result = array();
        $where = " WHERE status > 0 ";
        $query = $this->db->query("SELECT id, name,
            (SELECT id FROM laborcontract WHERE staffId = a.id AND status = 1) AS contractId,
            (SELECT startDate FROM laborcontract WHERE staffId = a.id AND status = 1) AS startDate,
            (SELECT stopDate FROM laborcontract WHERE staffId = a.id AND status = 1) AS stopDate,
            (SELECT basicSalary FROM laborcontract WHERE staffId = a.id AND status = 1) AS salary,
            (SELECT allowance FROM laborcontract WHERE staffId = a.id AND status = 1) AS allowance,
            (SELECT 
                (SELECT id FROM position WHERE id = b.position)
            FROM laborcontract b WHERE staffId = a.id AND status = 1) AS positionId,
            (SELECT 
                (SELECT name FROM position WHERE id = b.position)
            FROM laborcontract b WHERE staffId = a.id AND status = 1) AS positionName,
             (SELECT 
                (SELECT id FROM branch WHERE id = b.branchId)
            FROM laborcontract b WHERE staffId = a.id AND status = 1) AS branchId,
            (SELECT 
                (SELECT name FROM branch WHERE id = b.branchId)
            FROM laborcontract b WHERE staffId = a.id AND status = 1) AS branchName,
            (SELECT 
                (SELECT id FROM department WHERE id = b.departmentId)
            FROM laborcontract b WHERE staffId = a.id AND status = 1) AS departmentId,
            (SELECT 
                (SELECT name FROM department WHERE id = b.departmentId)
            FROM laborcontract b WHERE staffId = a.id AND status = 1) AS departmentName
        FROM staffs a $where ORDER BY id DESC");
        if ($query)
            $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // function getAllStaff()
    // {
    //     $result = array();
    //     $where = " WHERE status > 0 ORDER BY id DESC ";
    //     $query = $this->db->query("SELECT id, name
    //     FROM staffs $where");
    //     if ($query)
    //         $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }


    // Lấy dữ liệu hợp đồng của nhân viên(Nếu có)
    function getContractByStaffId($id)
    {
        $result['data'] = array();
        $where = " WHERE status = 1 AND staffid = $id ";
        $query = $this->db->query("SELECT id, name, shift, description, type, salaryPercentage,
        DATE_FORMAT(startDate, '%d-%m-%Y') AS startDate,
        DATE_FORMAT(stopDate, '%d-%m-%Y') AS stopDate,
        FORMAT(insuranceSalary, 0) as insuranceSalary, 
        FORMAT(basicSalary, 0) as basicSalary, 
        FORMAT(allowance, 0) as allowance,
        (SELECT id FROM staffs WHERE id = a.staffId) AS staffId,
        (SELECT name FROM staffs WHERE id = a.staffId) AS staffName,
        (SELECT id FROM position WHERE id = a.position) AS positionId,
        (SELECT name FROM position WHERE id = a.position) AS positionName,
        (SELECT id FROM branch WHERE id = a.branchId) AS branchId,
        (SELECT name FROM branch WHERE id = a.branchId) AS branchName,
        (SELECT id FROM department WHERE id = a.departmentId) AS departmentId,
        (SELECT name FROM department WHERE id = a.departmentId) AS departmentName
        FROM laborcontract a $where LIMIT 1");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($result[0]))
            $result = $result[0];
        return $result;
    }

    function getBranch() {
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM branch WHERE status > 0");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getDepartment() {
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM department WHERE status > 0");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getPosition() {
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM position WHERE status > 0");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getStaff() {
        $result = array();
        $query = $this->db->query("SELECT id, name AS `text` FROM staffs WHERE status > 0");
        if ($query)
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    // function checkUsername($username)
    // {
    //     $query = $this->db->query("SELECT count(id) AS total
    //       FROM users WHERE username='$username' AND username!='admin'");
    //     $temp = $query->fetchAll(PDO::FETCH_ASSOC);
    //     return $temp[0]['total'];
    // }

    function updateObj($data, $id)
    {
        $query = $this->update("laborcontract", $data , " id=$id ");
        return $query;
    }

    function addObj($data)
    {
        $query = $this->insert("laborcontract", $data);
        return $query;
    }

    function delObj($id)
    {
        $query = $this->update("laborcontract", ['status' => 2], " id=$id ");
        return $query;
    }

    // function getMenusByUser($userId)
    // {
    //     $query = $this->db->query("SELECT menuIds,functionIds
    //       FROM userroles WHERE userId=$userId");
    //     $temp = $query->fetchAll(PDO::FETCH_ASSOC);
    //     if (isset($temp[0])) {
    //         if ($temp[0]['menuIds'] != '')
    //             $listMenus = explode(",", $temp[0]['menuIds']);
    //         else
    //             $listMenus = [];
    //         if ($temp[0]['functionIds'] != '')
    //             $listFunctions = explode(",", $temp[0]['functionIds']);
    //         else
    //             $listFunctions = [];
    //     } else {
    //         $listMenus = [];
    //         $listFunctions = [];
    //     }
    //     $query = $this->db->query("SELECT menuIds,functionIds
    //       FROM grouproles WHERE id=(SELECT groupId FROM users WHERE id=$userId) AND status>0");
    //     $temp = $query->fetchAll(PDO::FETCH_ASSOC);
    //     if (isset($temp[0])) {
    //         if ($temp[0]['menuIds'] != '')
    //             $listGroupMenus = explode(",", $temp[0]['menuIds']);
    //         else
    //             $listGroupMenus = [];
    //         if ($temp[0]['functionIds'] != '')
    //             $listGroupFunctions = explode(",", $temp[0]['functionIds']);
    //         else
    //             $listGroupFunctions = [];
    //     } else {
    //         $listGroupMenus = [];
    //         $listGroupFunctions = [];
    //     }
    //     $query = $this->db->query("SELECT *,parentId as cha
    //     FROM g_menus WHERE active > 0 ORDER BY sortOrder,id");
    //     $result = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $result = functions::dequy($result, 0, 1);
    //     foreach ($result as $key => $menu) {
    //         $menuId = $menu['id'];
    //         $result[$key]['checked'] = 0;
    //         $result[$key]['disable'] = 0;
    //         if (in_array($menuId, $listGroupMenus)) {
    //             $result[$key]['disable'] = 1;
    //             $result[$key]['checked'] = 1;
    //         } else if (in_array($menuId, $listMenus))
    //             $result[$key]['checked'] = 1;
    //         $qr = $this->db->query("SELECT *,parentId as cha
    //         FROM g_functions WHERE active > 0 AND menuId = $menuId ORDER BY sortOrder,id");
    //         $temp = $qr->fetchAll(PDO::FETCH_ASSOC);
    //         foreach ($temp as $key1 => $function) {
    //             $temp[$key1]['checked'] = 0;
    //             $temp[$key1]['disable'] = 0;
    //             if (in_array($function['id'], $listGroupFunctions)){
    //                 $temp[$key1]['disable'] = 1;
    //                 $temp[$key1]['checked'] = 1;
    //             }
    //             elseif (in_array($function['id'], $listFunctions))
    //                 $temp[$key1]['checked'] = 1;
    //         }
    //         $result[$key]['functions'] = $temp;
    //     }
    //     return $result;
    // }

    // function getUserRole($id)
    // {
    //     $result = array();
    //     $query = $this->db->query("SELECT *
    //       FROM userroles WHERE id=$id");
    //     $temp = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $result = $temp[0];
    //     return $result;
    // }

    // function addUserRoles($data)
    // {
    //     $query = $this->insert("userroles", $data);
    //     return $query;
    // }

    // function updateUserRole($id, $data)
    // {
    //     $query = $this->update("userroles", $data, " userId=$id ");
    //     return $query;
    // }

    // function setFunctionRole($userId, $funcId, $check)
    // {
    //     $result = array();
    //     $query = $this->db->query("SELECT functionIds
    //       FROM userroles WHERE userId=$userId AND status=1");
    //     $temp = $query->fetchAll(PDO::FETCH_ASSOC);
    //     if (isset($temp[0])) {
    //         if ($temp[0]['functionIds'] != '') {
    //             $listFunc = explode(",", $temp[0]['functionIds']);
    //             if ($check == 'false') {
    //                 $listFunc = array_diff($listFunc, [$funcId]);
    //             } else {
    //                 array_push($listFunc, $funcId);
    //             }
    //         } else
    //             if ($check == 'true') {
    //                 $listFunc[] = $funcId;
    //             } else
    //                 $listFunc = '';
    //         $listFunc = implode(",", $listFunc);
    //         $this->update('userroles', ['functionIds' => $listFunc], "userId=$userId");
    //     } else
    //         $this->insert('userroles', ['functionIds' => $funcId,'status'=>1,'userId'=>$userId]);
    //     return $result;
    // }

    // function setMenuRole($userId, $menuId, $check)
    // {
    //     $result = array();
    //     $query = $this->db->query("SELECT menuIds
    //       FROM userroles WHERE userId=$userId");
    //     $temp = $query->fetchAll(PDO::FETCH_ASSOC);
    //     if (isset($temp[0])) {
    //         if ($temp[0]['menuIds'] != '') {
    //             $listMenu = explode(",", $temp[0]['menuIds']);
    //             if ($check == 'false') {
    //                 $listMenu = array_diff($listMenu, [$menuId]);
    //             } else {
    //                 array_push($listMenu, $menuId);
    //             }
    //         } else
    //             if ($check == 'true') {
    //                 $listMenu[] = $menuId;
    //             } else
    //                 $listMenu = '';
    //         $listMenu = implode(",", $listMenu);
    //         $this->update('userroles', ['menuIds' => $listMenu], "userId=$userId");
    //     } else
    //         $this->insert('userroles', ['menuIds' => $menuId,'status'=>1,'userId'=>$userId]);
    //     return $result;
    // }

}

?>
