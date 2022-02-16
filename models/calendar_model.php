<?php
class calendar_model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function listCalendars($month, $year, $staffId)
    {
        $yearMonth = $year . '-' . $month;
        $dieukien = " WHERE status=1 AND (startDate LIKE '$yearMonth%' OR endDate LIKE '$yearMonth%') AND staffId=$staffId ";

        $query = $this->db->query("SELECT *
        FROM calendars a $dieukien ");
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($temp as $key => $value) {
            $startDate = date("Y-m-d", strtotime(str_replace('/', '-', $value['startDate'])));
            $endDate = date("Y-m-d", strtotime(str_replace('/', '-', $value['endDate'])));
            if ($endDate > $startDate) {
                $temp[$key]['allDay'] = 1;
            } else {
                $temp[$key]['allDay'] = 0;
            }
        }
        return $temp;
    }

    function updateCalendar($calendarId,$objectTable,$objectId,$calendarData)
    {
        $result = false;
        if($objectId>0 && $objectTable!='') {
            if($objectTable=='interview') {
                $data = [
                    'note' => $calendarData['description'],
                ];
            }
            if($this->update($objectTable,$data,"id=$objectId")) {
                $this->update("calendars",$calendarData,"id=$calendarId");
                $result = true;
            }
        } else {
            $this->update("calendars",$calendarData,"id=$calendarId");
            $result = true;
        }
        return $result;
    }

    function updateObj($calendarId,$data) 
    {
        $result = $this->update("calendars",$data,"id=$calendarId");
        return $result;
    }

    function addObj($data)
    {
        $result = $this->insert("calendars",$data);
        return $result;
    }
}
