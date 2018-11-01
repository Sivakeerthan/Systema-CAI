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
class   OverviewController
{
    /**
     * Die index Funktion des DefaultControllers sollte in jedem Projekt
     * existieren, da diese ausgeführt wird, falls die URI des Requests leer
     * ist. (z.B. http://my-project.local/). Weshalb das so ist, ist und wann
     * welcher Controller und welche Methode aufgerufen wird, ist im Dispatcher
     * beschrieben.
     */
    public function index()
    {
        // In diesem Fall möchten wir dem Benutzer die View mit dem Namen
        //   "default_index" rendern. Wie das genau funktioniert, ist in der
        //   View Klasse beschrieben.
        $view = new View('overview_index');
        $view->title = 'Acces Denied!';
        $view->heading = 'Acces Denied!';
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
}
