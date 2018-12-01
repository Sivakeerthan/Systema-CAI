<?php

/**
 * Der Controller ist der Ort an dem es für jede Seite, welche der Benutzer
 * anfordern kann eine Methode gibt, welche die dazugehörende Businesslogik
 * beherbergt.
 *
 * Welche Controller und Funktionen muss ich erstellen?
 *   Es macht sinn, zusammengehörende Funktionen (z.B: User anzeigen, erstellen,
 *   bearbeiten & löschen) gemeinsam in einem passend benannten Controller (z.B:
 *   UserController) zu implementieren. Nicht zusammengehörende Features sollten
 *   jeweils auf unterschiedliche Controller aufgeteilt werden.
 *
 * Was passiert in einer Controllerfunktion?
 *   Die Anforderungen an die einzelnen Funktionen sind sehr unterschiedlich.
 *   Folgend die gängigsten:
 *     - Dafür sorgen, dass dem Benutzer eine View (HTML, CSS & JavaScript)
 *         gesendet wird.
 *     - Daten von einem Model (Verbindungsstück zur Datenbank) anfordern und
 *         der View übergeben, damit diese Daten dann für den Benutzer in HTML
 *         Code umgewandelt werden können.
 *     - Daten welche z.B. von einem Formular kommen validieren und dem Model
 *         übergeben, damit sie in der Datenbank persistiert werden können.
 */
require_once '../repository/EventRepository.php';
require_once '../repository/AbsentRepository.php';
class   OverviewController
{
    /**
     * Die index Funktion des DefaultControllers sollte in jedem Projekt
     * existieren, da diese ausgeführt wird, falls die URI des Requests leer
     * ist. (z.B. http://my-project.local/). Weshalb das so ist, ist und wann
     * welcher Controller und welche Methode aufgerufen wird, ist im Dispatcher
     * beschrieben.
     */
    public $err = array();
    public function index()
    {
        // In diesem Fall möchten wir dem Benutzer die View mit dem Namen
        //   "default_index" rendern. Wie das genau funktioniert, ist in der
        //   View Klasse beschrieben.

        if(!isset($_SESSION['pos'])){
        $view = new View('overview_index');
        $view->title = 'Access Denied!';
        $view->heading = 'Access Denied!';
        }
        elseif($_SESSION['pos'] == 'pr'){
            header('Location: /overview/principal');
        }
        elseif($_SESSION['pos'] == 'se'){
            header('Location: /overview/secretary');
        }
        elseif($_SESSION['pos'] == 'st'){
            header('Location: /overview/student');
        }
        elseif($_SESSION['pos'] == 'te'){
            header('Location: /overview/teacher');
        }
        else{
            $view = new View('overview_index');
            $view->title = 'Access Denied!';
            $view->heading = 'Access Denied!';
        }
        $view->display();
    }
    public function principal(){
        $view = new View('overview_principal');
        $view->title = 'Übersicht';
        $view->heading = 'Übersicht';
        $view->display();
    }
    public function student(){
        $view = new View('overview_student');
        $view->title = 'Übersicht';
        $view->heading = 'Übersicht';
        $view->uname = $_SESSION['user'];
        $view->today = date("M d, Y");
        $eventrepository = new EventRepository();
        $view->events = $eventrepository->readAll();
        $absentrepository = new AbsentRepository();
        $view->absents = $absentrepository->readByUid($_SESSION['uid']);

        $view->display();
        if (isset($_POST['submit'])){
            $this->addAbsence();
        }
    }
    public function teacher(){
        $view = new View('overview_teacher');
        $view->title = 'Übersicht';
        $view->heading = 'Übersicht';
        $view->display();
    }
    public function secretary(){
        $view = new View('overview_secretary');
        $view->title = 'Übersicht';
        $view->heading = 'Übersicht';
        $view->display();
    }
    public function addAbsence(){
        if(!isset($_SESSION)){
            session_start();
        }
        $absentrepository = new AbsentRepository();
        $absencetype = htmlspecialchars($_POST['absence-type']);
        $date_start = htmlspecialchars($_POST['date_start']);
        $date_end = htmlspecialchars($_POST['date_end']);
        $anzKontInput = intval(htmlspecialchars($_POST['anz-HT']));
        $anzKont = intval($absentrepository->getHT($date_start,$date_end,$_SESSION['uid']));
        $absid = $absentrepository->createAbsent($_SESSION['uid'],$date_start,$date_end);
        $dispid = null;
        $isKont = true;
        $isDisp = false;
        if($absencetype == 'disp') {
            echo "<script>console.log('is dispensation')</script>";
            $disp_request = htmlspecialchars($_POST['disp_request']);
            $path = $this->uploadRequest();
            $isKont = false;
            $isDisp = true;
            if($path != null) {
                $dispid = $absentrepository->createDisp($disp_request,$path);
                $this->doError("Dispensation eingetragen!");
            }
        }
        if($anzKont!=null) {
            $anzahl = $anzKont;
            if($anzKontInput >=4) {
                if ($anzKont <= $anzKontInput) {
                    $anzahl =$anzKont;
                }
                if ($anzKont > $anzKontInput) {
                    $anzahl = $anzKontInput;
                }
            }
            for ($i = 1; $i <= $anzahl; $i++) {
                $absentrepository->insertLesson($absid, $isKont, $isDisp, $dispid);
            }
            $this->doError("Absenz eingetragen ;)");
            echo "<br> abstype:".$absencetype;
            echo "<br> error:".print_r($_SESSION['err']);
            header('Location: /overview/student');
        }

    }
    private function uploadRequest()
    {
        if(isset($_POST['submit'])){
        $check = filesize($_FILES['doc_file']['tmp_name']);
        if ($check !== false) {
            echo "<script>console.log('file exists')</script>";
            $extension = pathinfo($_FILES['doc_file']['name'], PATHINFO_EXTENSION);
            echo "<br>Extension:" . print_r($extension);
            if ($extension != 'pdf') {
                $this->doError("Ungültige Dateiendung");
                return null;
            }
            $detected_type = $_FILES['doc_file']['type'];
            if ($detected_type != "application/pdf") {
                $this->doError("Nur der Upload von PDF-Dateien ist gestattet");
                return null;
            }
            if ($detected_type == "application/pdf") {
                $targetfolder = './uploads/files/disp/' . $_FILES['doc_file']['name'];
                if (move_uploaded_file($_FILES['doc_file']['tmp_name'], $targetfolder)) {
                    $this->doError("Ihre Datei wurde erfolgreich hochgeladen");
                    return $targetfolder;
                } else {
                    $this->doError("Ein Fehler ist aufgetreten :(");
                    return null;
                }

            }
        } else {
            $this->doError("Keine Datei hochgeladen!");
            return null;
        }
        }
    }
    public function doError($error){
        $this->err = array_fill(0,1,$error);
        $_SESSION['err'] = $this->err;
    }

}
