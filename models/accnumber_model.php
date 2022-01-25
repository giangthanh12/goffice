<?php
class accnumber_model extends Model{
    function __construst(){
        parent::__construst();
    }

    function listObj(){
        $query = $this->db->query("SELECT * FROM accnumber
         WHERE status > 0 ORDER BY id DESC");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // function get_data_combo(){
    //     $result = array();
    //     $query = $this->db->query("SELECT id, name AS text FROM khachhang");
    //     $result['items'] = $query->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }

    // function addObj($data)
    // {
        
    //     $data['asset'] = str_replace( ',', '', $data['asset']);
    //     $query = $this->insert("ledger",$data);

        
    //     return $query;
    // }

    function getdata($id){
        $result = array();
        $query = $this->db->query("SELECT * FROM accnumber WHERE id = $id");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = $temp[0];
        return $result;
    }

    function updateObj($id, $data)
    {
        if($id > 0) {
            $result = $this->update('accnumber', $data, "id = $id");
        }
        else {
            $result = $this->insert('accnumber', $data);
        }
        return $result;
    }

    function delObj($id,$data)
    {
        $query = $this->update("accnumber",$data,"id = $id");
        
        return $query;
    }
}
?>