<?php
class Auth_Model extends Model{
    function __construst(){
        parent::__construst();
    }

    function checkIn($username, $password){
        $query = $this->db->query("SELECT id, username, staffId, department,token, extNum, sipPass,
          (SELECT name FROM staffs WHERE id=staffId) AS staffName,
       (SELECT email FROM staffs WHERE id=staffId) AS email,
          (SELECT IF(avatar='',CONCAT('".URLFILE."','/uploads/useravatar.png'),CONCAT('".URLFILE."/',avatar)) FROM staffs WHERE id=staffId) AS avatar,
        (SELECT ip FROM branch WHERE branch.id=(SELECT branch FROM laborcontract
        WHERE laborcontract.staffId=users.staffId LIMIT 1)) AS ipBranch
          FROM users WHERE status=1 AND usernameMd5 = '$username' AND password = '$password'");
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($row[0]))
            return $row[0];
        else
            return [];
    }

    function updateDeadline(){
        $today = date('Y-m-d',strtotime('+ 2 day'));
        $query = $this->update("task", ['status'=>3,'label'=>'Deadline'], " status IN (1,2) AND deadline<'$today' ");
        return $query;
    }
}
?>
