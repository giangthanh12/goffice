<?php
class recruitment_result_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $query = $this->db->query("SELECT id,title,quantity, 
        (SELECT name FROM department WHERE STATUS = 1 AND id = recruitmentcamp.department) AS department, 
        (SELECT name FROM position WHERE STATUS = 1 AND id = recruitmentcamp.position) AS position, 
        (SELECT COUNT(1) FROM sortlist WHERE STATUS = 1 AND campId = recruitmentcamp.id) AS countInterview, 
        (SELECT COUNT(1) FROM interview WHERE STATUS = 1 AND campId = recruitmentcamp.id AND result = 2) AS countqualified, 
        (SELECT COUNT(1) FROM interview WHERE STATUS = 1 AND campId = recruitmentcamp.id AND result = 5) AS countReceived 
        FROM recruitmentcamp WHERE STATUS = 1 ORDER BY id DESC");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

  
}
?>