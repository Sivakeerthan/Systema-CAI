<?php

require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class UserRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'user';


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
    public function create($username, $password, $fname,$lname,$isAdmin)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO $this->tableName (firstname,lastname,username, password, isPrincipal,isSecretary,isStudent,isTeacher,isAdmin) VALUES (?,?,?,?,0,0,1,0,?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ssssi',$fname,$lname,$username, $password,$isAdmin);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    public function readByName($uname)
    {
        // Query erstellen
        $query = "SELECT uId, username, password FROM {$this->tableName} WHERE username =?";

        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $uname);

        // Das Statement absetzen
        $statement->execute();

        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Ersten Datensatz aus dem Reultat holen
        $row = $result->fetch_object();

        // Datenbankressourcen wieder freigeben
        $result->close();

        // Den gefundenen Datensatz zurückgeben
        return $row;
    }
    public function getPos($uname){
        // Query erstellen
        $query = "SELECT isPrincipal,isSecretary,isStudent,isTeacher FROM {$this->tableName} WHERE username =?";

        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $uname);

        // Das Statement absetzen
        $statement->execute();

        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Ersten Datensatz aus dem Reultat holen
        $row = $result->fetch_object();

        // Datenbankressourcen wieder freigeben
        $result->close();

        if($row->isPrincipal){
            return "principal";
        }
        if($row->isSecretary){
            return "secretary";
        }
        if($row->isStudent){
            return "student";
        }
        if($row->isTeacher){
            return "teacher";
        }
        else{
            return null;
        }

    }
    public function existingUsername($username){
        $query = "SELECT uId FROM $this->tableName WHERE username = ?";
        $statement = ConnectionHandler::getConnection()->prepare($query);

        $statement->bind_param('s', $username);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        $result = $statement->get_result();
        if($result->num_rows >= 1){
            return true;
        }
        return false;

    }
}
