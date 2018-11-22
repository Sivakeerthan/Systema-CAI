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
        $view = new View('overview_index');
        $view->title = 'Access Denied!';
        $view->heading = 'Access Denied!';
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

        $view->display();
        if ($_POST['submit']){
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
        $absentrepository = new AbsentRepository();
        $absencetype = htmlspecialchars($_POST['absencetype']);
        $date_start = htmlspecialchars($_POST['date_start']);
        $date_end = htmlspecialchars($_POST['date_end']);
        $anzKontInput = intval(htmlspecialchars($_POST['anz-HT']));
        $anzKont = intval($absentrepository->getHT($date_start,$date_end,$_SESSION['uid']));
        $absid = $absentrepository->createAbsent($_SESSION['uid'],$date_start,$date_end);
        $dispid = null;
        $isKont = true;
        $isDisp = false;
        if($absencetype = 'disp') {
            $disp_request = htmlspecialchars($_POST['disp_request']);
            $path = $this->uploadRequest();
            $isKont = false;
            $isDisp = true;
            if($path != null) {
                $dispid = $absentrepository->createDisp($disp_request,$path);
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
            for ($i = 0; $i <= $anzahl; $i++) {
                $absentrepository->insertLesson($absid, $isKont, $isDisp, $dispid);
            }
        }

    }
    private function uploadRequest(){
        if(isset($_FILES['doc_file']['tmp_name'])) {
            $extension = strtolower(pathinfo($_FILES['datei']['name'], PATHINFO_EXTENSION));
            if (!in_array($extension, 'pdf')) {
                $this->doError("Ungültige Dateiendung");
                return null;
            }
            $detected_type = $_FILES['doc_file']['type'];
            if ($detected_type != "application/pdf") {
                $this->doError("Nur der Upload von PDF-Dateien ist gestattet");
                return null;
            }
            if ($detected_type == "application/pdf") {
                $targetfolder = './files/disp/' . $_FILES['doc_file']['name'];
                if (move_uploaded_file($_FILES['doc_file']['tmp_name'],$targetfolder)) {
                    $this->doError("Ihre Datei wurde erfolgreich hochgeladen");
                    return $targetfolder;
                } else {
                    $this->doError("Ein Fehler ist aufgetreten :(");
                    return null;
                }

            }
        }
        else{
            return null;
        }
    }
    public function doError($error){
        $this->err = array_fill(0,1,$error);
        $_SESSION['err'] = $this->err;
    }
}
