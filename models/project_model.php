<?php
class project_Model extends Model{
    function __construst(){
        parent::__construst();
    }
    function get_data($status) {
        if(empty($status)) {
            $query = $this->db->query("SELECT id, image, name, level,process,
             DATE_FORMAT(deadline,'%d-%m-%Y') as deadline,
            (SELECT avatar FROM staffs WHERE id=assignerId) AS avatar
            FROM projects WHERE status > 0 ORDER BY id DESC");
        }
        else {
            $query = $this->db->query("SELECT id, image, name, level,process,
            DATE_FORMAT(deadline,'%d-%m-%Y') as deadline,
            (SELECT avatar FROM staffs WHERE id=assignerId) AS avatar
            FROM projects WHERE status = $status ORDER BY id DESC");
        }
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    function getStaff() {
        $query = $this->db->query("SELECT id, name, avatar as hinh_anh FROM staffs");
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    function updateProject($id,$data) {
        if($id > 0) {
           $result = $this->update('projects', $data, "id = $id");
        }
        else {
            $result = $this->insert('projects', $data);
        }
        return $result;
    }
    function getProjectById($id) {
        $result = false;
        $query = $this->db->query("SELECT *,
            DATE_FORMAT(deadline,'%d-%m-%Y') as deadline 
            FROM projects WHERE id=$id");
        if ($query) {
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = $data[0];
        }
        return $result;
    }

    function delObj($id){
        $data = array('status'=>0);
        $query = $this->update("projects", $data, " id=$id ");
        return $query;
    }
    function filterLevel($filter) {
        $query = $this->db->query("SELECT id, image, name, level,process,
            DATE_FORMAT(deadline,'%d-%m-%Y') as deadline,
            (SELECT avatar FROM staffs WHERE id=assignerId) AS avatar
            FROM projects WHERE status > 0 AND level in ($filter) ");
             $data = $query->fetchAll(PDO::FETCH_ASSOC);
             return $data;
    }
}
?>
