<?php
class Database {
    private $connection;
    private function dbconnect($dbname, $dbuser = "root", $dbpass = "mddnsm", $dbhost = "localhost"){
        $pdo = new PDO("mysql:host=".$dbhost.";dbname=".$dbname, $dbuser, $dbpass);
        return $pdo;
    }

    public function dbfetch($statement){
        $sql = $this->getConnection()->prepare($statement);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setConnection($connection){
        $this->connection = $connection;
    }
    public function getConnection(){
        return $this->connection;
    }

    public function __construct()
    {
        $this->setConnection($this->dbconnect("phpab"));
    }
}
