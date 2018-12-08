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
require_once '../repository/UserRepository.php';

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

        if (!isset($_SESSION['pos'])) {
            $view = new View('overview_index');
            $view->title = 'Access Denied!';
            $view->heading = 'Access Denied!';
        } elseif ($_SESSION['pos'] == 'pr') {
            header('Location: /overview/principal');
        } elseif ($_SESSION['pos'] == 'se') {
            header('Location: /overview/secretary');
        } elseif ($_SESSION['pos'] == 'st') {
            header('Location: /overview/student');
        } elseif ($_SESSION['pos'] == 'te') {
            header('Location: /overview/teacher');
        } else {
            $view = new View('overview_index');
            $view->title = 'Access Denied!';
            $view->heading = 'Access Denied!';
        }
        $view->display();
    }

    public function principal()
    {
        $view = new View('overview_principal');
        $view->title = 'Übersicht';
        $view->heading = 'Übersicht';
        $view->uname = $_SESSION['user'];
        $view->today = date("M d, Y");
        $eventrepository = new EventRepository();
        $view->events = $eventrepository->readAll();
        $absentrepository = new AbsentRepository();
        $view->pending_absents = $absentrepository->readAllDisps();
        $view->absents = $absentrepository->readAll();
        $view->students = $this->getStudents();
        $view->display();
    }

    public function student()
    {
        $view = new View('overview_student');
        $view->title = 'Übersicht';
        $view->heading = 'Übersicht';
        $view->uname = $_SESSION['user'];
        $userrepository = new UserRepository();
        $view->kontingent = $userrepository->readByName($_SESSION['user'])->kontingent;
        $view->today = date("M d, Y");
        $eventrepository = new EventRepository();
        $view->events = $eventrepository->readAll();
        $absentrepository = new AbsentRepository();
        $view->absents = $absentrepository->readByUid($_SESSION['uid']);
        if(isset($_COOKIE['kkanz'])){
            $view->kkanzahl = intval(htmlspecialchars($_COOKIE['kkanz']));
            unset($_COOKIE['kkanz']);
            setcookie("kkanz",null,time()-360);
        }
        if(isset($_COOKIE['kkstart'])){
            $view->kkstart = htmlspecialchars($_COOKIE['kkstart']);
            unset($_COOKIE['kkstart']);
            setcookie("kkstart",null,time()-360);
        }
        if(isset($_COOKIE['kkend'])){
            $view->kkend = htmlspecialchars($_COOKIE['kkend']);
            unset($_COOKIE['kkend']);
            setcookie("kkend",null,time()-360);
        }
        $view->display();
        if (isset($_POST['submit'])) {
            $this->addAbsence();
        }
    }

    public function teacher()
    {
        $view = new View('overview_teacher');
        $view->title = 'Übersicht';
        $view->heading = 'Übersicht';
        $view->uname = $_SESSION['user'];
        $view->today = date("M d, Y");
        $eventrepository = new EventRepository();
        $view->events = $eventrepository->readAll();
        $absentrepository = new AbsentRepository();
        $view->pending_absents = $absentrepository->readForTeacher($_SESSION['uid']);
        $view->absents = $absentrepository->readAll();
        $view->students = $this->getStudents();

        $view->display();
    }

    public function secretary()
    {
        $view = new View('overview_secretary');
        $view->title = 'Übersicht';
        $view->heading = 'Übersicht';
        $view->display();
    }

    public function addAbsence()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $absentrepository = new AbsentRepository();
        $absencetype = htmlspecialchars($_POST['absence-type']);
        $date_start = htmlspecialchars($_POST['date_start']);
        $date_end = htmlspecialchars($_POST['date_end']);
        $anzKontInput = intval(htmlspecialchars($_POST['anz-HT']));
        $anzKont = intval($absentrepository->getHT($date_start, $date_end, $_SESSION['uid']));

        $isKK = boolval($absentrepository->isKKEvent($date_start, $date_end));
        $dispid = null;

        if ($absencetype == 'disp') {
            echo "<script>console.log('is dispensation')</script>";
            $disp_request = htmlspecialchars($_POST['disp_request']);
            $path = $this->uploadRequest();
            $isKont = false;
            $isDisp = true;
            $dispid = $absentrepository->createDisp($disp_request, $path);
            if ($dispid != null) {
                $this->doError("Dispensation eingetragen!");
            }

        }
        if ($anzKont != null) {
            $anzahl = $anzKont;
            if ($anzKontInput >= 2) {
                if ($anzKont <= $anzKontInput) {
                    $anzahl = $anzKont;
                }
                if ($anzKont > $anzKontInput) {
                    $anzahl = $anzKontInput;
                }
            }
            if ($isKK = false) {
                $absid = $absentrepository->createAbsent($_SESSION['uid'], $date_start, $date_end);
                for ($i = 1; $i <= $anzahl; $i++) {
                    $absentrepository->insertLesson($absid, $isKont, $isDisp, $dispid);
                }
                $this->doError("Absenz eingetragen ;)");

            }
            if ($isKK = true) {
                if(isset($_COOKIE['kkanz'])&&isset($_COOKIE['kkstart'])&&isset($_COOKIE['kkend'])){
                    setcookie("kkanz",null,time()-360);
                    setcookie("kkstart",null,time()-360);
                    setcookie("kkend",null,time()-360);
                }
                setcookie("kkanz",$anzahl,time()+360);
                setcookie("kkstart",date('Y-m-d',strtotime($date_start)),time()+360);
                setcookie("kkend",date('Y-m-d',strtotime($date_end)),time()+360);

                header('Location: /overview/student');
            }

            //header('Location: /overview/student');
        }


    }

    public function addUnexcused()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $absentrepository = new AbsentRepository();
        $userrepository = new UserRepository();
        $date = htmlspecialchars($_POST['date']);
        $anzLessons = intval(htmlspecialchars($_POST['anz_lessons']));
        $studentinput = htmlspecialchars($_POST['abs_student']);
        $studentarr = explode(" ", $studentinput);
        $student = $userrepository->readByFullName($studentarr[0], $studentarr[1]);
        if ($anzLessons != null) {
            $absid = $absentrepository->createAbsent($student, $date, $date);
            for ($i = 1; $i <= $anzLessons; $i++) {
                $absentrepository->insertUnexcusedLesson($absid);
            }
            $this->doError("Absenz eingetragen ;)");
            header('Location: /overview/teacher');
        } else {
            $this->doError("Geben Sie bitte die gefehlten Lektionen an!");
            header('Location: /overview/teacher');
        }
    }

    public function addEvent()
    {
        $name = htmlspecialchars($_POST['ev_name']);
        $date = htmlspecialchars($_POST['date']);
        $isKK = boolval(htmlspecialchars($_POST['isKK']));
        $eventrepository = new EventRepository();
        $eventrepository->create($name, $date, $isKK);
        $this->doError("Event erstellt ;)");
        header("Location: /overview/principal");
    }

    private function uploadRequest()
    {
        if (isset($_POST['submit'])) {
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
                    if (!is_dir('./uploads/files/disp/' . $_SESSION['uid'] . "/")) {
                        mkdir('./uploads/files/disp/' . $_SESSION['uid'] . "/");
                    }
                    $filename = trim(addslashes($_FILES['doc_file']['name']));
                    $filename = str_replace(' ', '_', $filename);
                    $targetfolder = './uploads/files/disp/' . $_SESSION['uid'] . '/' . $filename;
                    if (move_uploaded_file($_FILES['doc_file']['tmp_name'], $targetfolder)) {
                        $this->doError("Ihre Datei wurde erfolgreich hochgeladen");
                        return preg_replace("/^\./", "", $targetfolder);
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

    private function getStudents()
    {
        $userrepository = new UserRepository();
        $temp = $userrepository->readAllStudents();
        $students = array();
        foreach ($temp AS $s) {
            $students[$s->firstname . " " . $s->lastname] = null;

        }
        if (count($students) > 0) {
            return $students;
        }
        return null;
    }

    public function doAccept()
    {
        $absentrepository = new AbsentRepository();
        $absid = intval(htmlspecialchars($_GET['id']));
        try {
            $absentrepository->acceptLessons($absid);
            $this->doError("Absenz wurde Akzeptiert");
            header("Location: /overview/teacher");
        } catch (Exception $e) {
            $this->doError("Ein Fehler ist aufgetreten, Details finden Sie im Console-Log");
            header("Location: /overview/teacher");
            echo "<script>console.log('doAccept-Error: " . $e->getMessage() . "')</script>";
        }
    }

    public function doDecline()
    {
        $absentrepository = new AbsentRepository();
        $absid = intval(htmlspecialchars($_GET['id']));
        try {
            $absentrepository->declineLessons($absid);
            $this->doError("Absenz wurde Abgelehnt");
            header("Location: /overview/teacher");
        } catch (Exception $e) {
            $this->doError("Ein Fehler ist aufgetreten, Details finden Sie im Console-Log");
            header("Location: /overview/teacher");
            echo "<script>console.log('doAccept-Error: " . $e->getMessage() . "')</script>";
        }
    }

    public function doAcceptDisp()
    {
        $absentrepository = new AbsentRepository();
        $absid = intval(htmlspecialchars($_GET['id1']));
        $dispid = intval(htmlspecialchars($_GET['id2']));
        try {
            $absentrepository->acceptLessons($absid);
            $this->doError("Absenz wurde Akzeptiert");
            header("Location: /overview/teacher");
        } catch (Exception $e) {
            $this->doError("Ein Fehler ist aufgetreten, Details finden Sie im Console-Log");
            header("Location: /overview/teacher");
            echo "<script>console.log('doAccept-Error: " . $e->getMessage() . "')</script>";
        }
    }

    public function doDeclineDisp()
    {
        $absentrepository = new AbsentRepository();
        $absid = intval(htmlspecialchars($_GET['id1']));
        $dispid = intval(htmlspecialchars($_GET['id2']));
        try {
            $absentrepository->declineLessons($absid);
            $this->doError("Absenz wurde Abgelehnt");
            header("Location: /overview/teacher");
        } catch (Exception $e) {
            $this->doError("Ein Fehler ist aufgetreten, Details finden Sie im Console-Log");
            header("Location: /overview/teacher");
            echo "<script>console.log('doAccept-Error: " . $e->getMessage() . "')</script>";
        }
    }

    public function doError($error)
    {
        $this->err = array_fill(0, 1, $error);
        $_SESSION['err'] = $this->err;
    }

    public function open()
    {
        if (isset($_SESSION['uid']) && $_SESSION['pos'] == "pr" && isset($_GET['path'])) {
            header('Content-Type: application/pdf');
            readfile('./uploads/files/disp/' . $_GET["path"] . '.pdf');
        } else {
            header("Location: /");
            exit();
        }
    }

    public function unexcusedAllowed()
    {
        $absentrepository = new AbsentRepository();
        $anzahl = intval(htmlspecialchars($_GET['a1']));
        $start = htmlspecialchars($_GET['a2']);
        $end = htmlspecialchars($_GET['a3']);
        $absid = $absentrepository->createAbsent($_SESSION['uid'], $start, $end);
        for ($i = 1; $i <= $anzahl; $i++) {
            $absentrepository->insertUnexcusedLesson($absid);
        }
        $this->doError("Unentschuldigte Absenz eingetragen ;)");
        header("Location: /overview/student");
    }
}
