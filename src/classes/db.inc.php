<?php
class Database {

    private function dbconnect($dbname, $dbuser = "root", $dbpass = "mddnsm", $dbhost = "localhost"){
        $pdo = new PDO("mysql:host=".$dbhost.";dbname=".$dbname, $dbuser, $dbpass);
        return $pdo;
    }

    function dbfetch($statement, $connection){
        $sql = $connection->prepare($statement);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function __construct()
    {
        $connection = $this->dbconnect("phpab");
    }
}
