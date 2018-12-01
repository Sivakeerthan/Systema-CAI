<?php

require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class AbsentRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'absent';


    /**
     * Erstellt einen neuen benutzer mit den gegebenen Werten.
     *
     * Das Passwort wird vor dem ausführen des Queries noch mit dem SHA1
     *  Algorythmus gehashed.
     *
     * @param $firstName Wert für die Spalte firstName
     * @param $lastName Wert für die Spalte lastName
     * @param $email Wert für die Spalte email
     * @param $password Wert für die Spalte password
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
    public function createAbsent($student,$date_start,$date_end)
    {
        $query = "INSERT INTO  absent (student_id,date_start,date_end) VALUES (?, ?,?)";
        $start = date('Y-m-d',strtotime($date_start));
        $end = date('Y-m-d',strtotime($date_start));
        echo "Start:".$start;
        echo "End:".$end;
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('iss',$student,$start,$end);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        return $statement->insert_id;
    }
    public function createDisp($request,$path)
    {
        $query = "INSERT INTO  dispensation (request,documenturl) VALUES (?, ?)";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ss',$request,$path);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        return $statement->insert_id;
    }
    public function insertLesson($abs_id,$isKont,$isDisp,$disp_id)
    {
        $query = "INSERT INTO  lesson (abs_id,isKontingent,isDispensation,disp_id) VALUES (?,?,?,?)";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('iiii',$abs_id,intval($isKont),intval($isDisp),$disp_id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        return $statement->insert_id;
    }
    public function readByUid($uid)
    {
        $query = "SELECT * FROM {$this->tableName}  WHERE student_id = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i',$uid);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Datensätze aus dem Resultat holen und in das Array $rows speichern
        $rows = array();
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }

        return $rows;
    }
    public function getHT($day_start,$day_end,$student){
        $date = $day_start;
        $anzkont = 0;
        $query = "SELECT lessons_1ht, lessons_2ht 
                  FROM day AS d JOIN timetable_day AS td ON d.dayId = td.day_id
                  JOIN timetable AS t ON td.timetable_id
                  JOIN class AS c ON t.timetableId = c.timetable_id
                  JOIN user AS u ON u.class_id = c.classId 
                  WHERE d.name = ? AND u.uId = ?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $workDays = ['Monday','Tuesday','Wednesday','Thursday','Friday'];
        while (strtotime($date) <= strtotime($day_end)) {
           if(in_array(date('l',strtotime($date)),$workDays)){
               $day = "Montag";
               switch (date('l',strtotime($date))){
                   case 'Monday': $day = 'Montag'; break;
                   case 'Tuesday': $day = 'Dienstag'; break;
                   case 'Wednesday': $day = 'Mittwoch'; break;
                   case 'Thursday': $day = 'Donnerstag'; break;
                   case 'Friday': $day = 'Freitag'; break;
               }
               print_r($day);
               print_r($student);
               $statement->bind_param('si',$day,$student);
               $statement->execute();
               $result = $statement->get_result();
               if (!$result || $result->num_rows == 0) {
                   throw new Exception($statement->error);
               }
               $row = $result->fetch_object();
               $result->close();
               $anzkont += intval($row->lessons_1ht);
               $anzkont += intval($row->lessons_2ht);
           }
           $date = date("M-d-Y",strtotime("+1 day",strtotime($date)));
           echo "Anzkont:".$anzkont;
        }
        return $anzkont;
    }

}
