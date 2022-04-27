<?php

/**
 * This is the database class.
 *
 * It establishes the database connection and provides the CRUD functions.
 *
 * @author Mark Lösche
 */
class Database {
    /**
     * @var
     */
    private $connection;

    /**
     * @var array|false
     */
    private $config;

    /**
     * @param string $dbname
     * @param string $dbUser
     * @param string $dbPass
     * @param string $dbHost
     * @return PDO
     */
    private function dbConnect(string $dbname, string $dbUser, string $dbPass, string $dbHost): PDO
    {
        return new PDO("mysql:host=".$dbHost.";dbname=".$dbname, $dbUser, $dbPass);
    }

    /**
     * @param string $where_clause
     * @param string $order_key
     * @param string $order_mode
     * @return mixed
     */
    public function dbFetch(string $where_clause, string $order_key = "id", string $order_mode = "asc"): mixed
    {
        if($where_clause){
            $stmt = "SELECT * FROM addresses WHERE :where_clause";
        } else {
            $stmt = "SELECT * FROM addresses ORDER BY :order_key :$order_mode";
        }

        $sql = $this->getConnection()->prepare($stmt);
        if($where_clause){
            $sql->bindParam(":where_clause", $where_clause, PDO::PARAM_STR);
        } else {
            $sql->bindParam(":order_key", $order_key, PDO::PARAM_STR);
            $sql->bindParam(":order_mode", $order_mode, PDO::PARAM_STR);
        }
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $data
     * @return void
     */
    public function insertAddress($data):void
    {
        $stmt = "INSERT INTO addresses (`name`, `city`) VALUES (':name', ':city')";

        $sql = $this->getConnection()->prepare($stmt);
        $sql->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $sql->bindParam(':city', $data['city'], PDO::PARAM_STR);
        $sql->execute();
    }

    /**
     * @param $id
     * @param $data
     * @return void
     */
    public function editAddress($data):void
    {
        $stmt = "UPDATE `addresses` SET `name`=':name', `city`=':city' WHERE `id`=:id";
        $sql = $this->getConnection()->prepare($stmt);
        $sql->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $sql->bindParam(':city', $data['city'], PDO::PARAM_STR);
        $sql->bindParam(':id', $data['id'], PDO::PARAM_INT);
        $sql->execute();
    }

    /**
     * @param $id
     * @return void
     */
    public function deleteAddress($id):void
    {
        $stmt = "DELETE FROM `addresses` WHERE `id`=:id";
        $sql = $this->getConnection()->prepare($stmt);
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
    }

    /**
     * @param $connection
     * @return void
     */
    public function setConnection($connection):void{
        $this->connection = $connection;
    }

    /**
     * @return mixed
     */
    public function getConnection(): mixed
    {
        return $this->connection;
    }

    /**
     * constructs the class after reading the ini file.
     */
    public function __construct()
    {
        $this->config = parse_ini_file("db.ini");
        $this->setConnection($this->dbConnect($this->config["dbname"], $this->config["user"], $this->config["pass"], $this->config["host"]));
    }
}
