<?php
class project_Model extends Model{
    function __construst(){
        parent::__construst();
    }
    function get_data() {
            $query = $this->db->query("SELECT id, image, name, level,process,
            DATE_FORMAT(deadline,'%d-%m-%Y') as deadline,
            (SELECT avatar FROM staffs WHERE id=a.managerId) AS avatar,
            (SELECT name FROM projectlevels WHERE id=a.level) AS nameLevel,
            (SELECT color FROM projectlevels WHERE id=a.level) AS colorLevel,
            (SELECT color FROM projectstatus WHERE id=a.status) AS colorStatus
            FROM projects a WHERE status > 0 ORDER BY id DESC");
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            return $row;
    }
    function getStaff() {
        $query = $this->db->query("SELECT id, name, avatar as hinh_anh FROM staffs where status > 0");
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    function getLevelProject(){
        $result = array();
        $query = $this->db->query("SELECT id,color, concat('<span style=\"color:',color,';\">',name,'<span>') AS text FROM projectlevels WHERE status = 2");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function getStatusProject(){
        $result = array();
        $query = $this->db->query("SELECT id,color, name AS text FROM projectstatus WHERE status = 2");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
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
    function filterLevel($filter, $status) {
  
        $condition = "WHERE status > 0";
        if(!empty($status))
        {
            $condition = " WHERE status = $status ";
        } 
        if(!empty($filter)) {
            $condition.= " AND level in ($filter) ";
        }
        $query = $this->db->query("SELECT id, image, name, level,process,
            DATE_FORMAT(deadline,'%d-%m-%Y') as deadline,
            (SELECT avatar FROM staffs WHERE id=a.managerId) AS avatar,
           (SELECT name FROM projectlevels WHERE id=a.level) AS nameLevel,
           (SELECT color FROM projectlevels WHERE id=a.level) AS colorLevel,
           (SELECT color FROM projectstatus WHERE id=a.status) AS colorStatus
            FROM projects a $condition ORDER BY id DESC ");
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
    }
}
?>
