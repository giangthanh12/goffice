<?php
class Ticket_Model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj()
    {
        $result = array();
        $query = $this->db->query("SELECT *
            FROM ticket WHERE tinh_trang > 0 ORDER BY id DESC ");
        if ($query)
            $result['row'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function addObj($data)
    {
        $query = $this->insert("ticket",$data);
        return $query;
    }

    function updateObj($id, $data)
    {
        $query = $this->update("ticket",$data,"id = $id");
        return $query;
    }

    function delObj($id,$data)
    {
        $query = $this->update("ticket",$data,"id = $id");
        return $query;
    }
}
?>
