<?php
class insight_Model extends Model{
    function __construst(){
        parent::__construst();
    }
    function getLedger() {
        $where = " WHERE status > 0 ORDER BY id DESC ";
        $query = $this->db->query("SELECT id, dateTime, asset, classsify, type, content, note,
        IFNULL((SELECT name FROM staffs WHERE id = a.staffId), 'Tên nhân viên') AS staffName,
        IFNULL((SELECT name FROM customer WHERE id = a.customerId), 'Tên khách hàng')  AS customerName,
        IFNULL((SELECT name FROM contracts WHERE id = a.contractId), 'Tên hợp đồng')AS contractName,
        FROM ledger a $where");
        $result['data'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    
}
?>
