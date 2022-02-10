<?php
class calendar_model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function listCalendars($month, $year, $nhanvien)
    {
        $yearMonth = $year . '-' . $month;
        // $today = date('Y-m-d');
        $dieukien = " WHERE status=1 AND (startDate LIKE '$yearMonth%' OR endDate LIKE '$yearMonth%') ";

        $query = $this->db->query("SELECT *
        -- DATE_FORMAT(dateTime,'%d-%m-%Y') as date,
        -- (SELECT fullyeare FROM applicants  WHERE id = a.applicantId) AS fullyeare,
        -- DATE_FORMAT(dateTime,'%H:%i') as time 
        FROM calendars a $dieukien ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($temp as $key => $value) {
            if ($value['endDate'] > $value['startDate']) {
                $temp[$key]['allDay'] = 1;
            } else {
                $temp[$key]['allDay'] = 0;
            }
        }
        return $temp;
    }
}
