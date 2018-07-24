<?php

/* Model greift auf diese Datei zu
 * PDO Datenbank Klasse
 * Verbindung zur Datenbank
 * Prepared Statements
 * Werte zuweisen
 * Ergebnisse und Reihen zurückgeben
 */

class Database {

    // Konstanten wurden in 'config.php' konfiguriert
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbHandler;
    private $statement;
    private $error;


    public function __construct() {
        // Set DSN 
        $dsn = 'mysql:host=' .$this->host . ';dbname=' . $this->dbname . ';charset=utf8';

        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // fordert die Daten als Objekt anstatt als Array an
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            // setzt die Schrifttabelle auf uft-8
            // PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        );

        // Verbindung zur Datenbank aufbauen ++++++++++++++++++++++++++++++++++++++++++++
        // PDO Instanz erstellen ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        try {
            $this->dbHandler = new PDO($dsn, $this->user, $this->pass, $options);
            // $dbh = $this->dbHandler;
            // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
            echo "error+++++++++++++++++++++++++++++++++++++++<br>";
            $this->error = $e->getMessage();
            echo $this->error;
            echo "<br>error+++++++++++++++++++++++++++++++++++<br>";
        } // ende try/catch -----------------------------------------------------------
    } // ende __construct -------------------------------------------------------------
    

    // Prepared statement mit query
    public function query($sql) {
        $this->statement = $this->dbHandler->prepare($sql);
    }


    // Bind values ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function bind($param, $value, $type = null) {
        if(is_null($type)) {
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            } // ende switch
        } // ende if(is_null($type)) ----------------------------------------------

        $this->statement->bindValue($param, $value, $type);
    } // ende function bind() -----------------------------------------------------


    // Hier wird das vorbereitete Statement ausgeführt
    public function execute() {
        return $this->statement->execute();
    }    


    // Eine Sammlung an Ergebnissen anfordern
    public function resultSet() {
        $this->execute();
        // Antwort soll in Form eines Objekts zurückkommen (PDO::FETCH_OBJ)
        return $this->statement->fetchAll();
    }


    // Ein einzelnes Ergebnis anfordern
    public function single() {
        $this->execute();
        return $this->statement->fetch();
    }


    // Row count gibt die Anzahl an Reihen(Datensätzen) zurück
    // die bei der letzten Anfrage bearbeitet wurden.
    public function rowCount() {
        return $this->statement->rowCount();
    }

} // ende class Database --------------------------------------------------------------
