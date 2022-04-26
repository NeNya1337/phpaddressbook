<?php
class Database {
    private $connection;

    private $config;

    private function dbconnect($dbname, $dbuser, $dbpass, $dbhost = "localhost"){
        $pdo = new PDO("mysql:host=".$dbhost.";dbname=".$dbname, $dbuser, $dbpass);
        return $pdo;
    }

    public function dbFetch($statement){
        $sql = $this->getConnection()->prepare($statement);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertAddress($data):void
    {
        $stmt = "INSERT INTO addresses (`name`, `city`) VALUES ('".$data['name']."', '".$data['city']."')";

        $sql = $this->getConnection()->prepare($stmt);
        $sql->execute();
    }

    public function editAddress($id, $data):void
    {
        $stmt = "UPDATE `addresses` SET `name`='".$data['name']."', `city`='".$data['city']."' WHERE `id`=".$id;
        $sql = $this->getConnection()->prepare($stmt);
        $sql->execute();
    }

    public function deleteAddress($id):void
    {
        $stmt = "DELETE FROM `addresses` WHERE `id`=".$id;
        $sql = $this->getConnection()->prepare($stmt);
        $sql->execute();
    }

    public function setConnection($connection):void{
        $this->connection = $connection;
    }
    public function getConnection(){
        return $this->connection;
    }

    public function __construct()
    {
        $this->config = parse_ini_file("db.ini");
        $this->setConnection($this->dbconnect("phpab", $this->config["user"], $this->config["pass"]));
    }
}
