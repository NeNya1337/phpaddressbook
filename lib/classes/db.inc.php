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
     * @param $where_clause
     * @param string $order_key
     * @param string $order_mode
     * @return array|bool
     */
    public function dbFetch($where_clause, string $order_key = "id", string $order_mode = "asc")
    {
        //check if values are not an injection
        $order_key = array_search($order_key, ["id","name","city"]) ? $order_key : "id";
        $order_mode = array_search($order_mode, ["asc","desc","ASC", "DESC"]) ? $order_mode : "ASC";

        if($where_clause){
            $stmt = "SELECT * FROM addresses WHERE id = :where_clause";
        } else {
            $stmt = "SELECT * FROM addresses ORDER BY `".$order_key."` ".$order_mode;
        }

        $sql = $this->getConnection()->prepare($stmt);
        if($where_clause){
            $sql->bindParam(":where_clause", $where_clause, PDO::PARAM_INT);
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
        $stmt = "INSERT INTO addresses (`name`, `city`) VALUES (:name, :city)";

        $sql = $this->getConnection()->prepare($stmt);
        $sql->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $sql->bindParam(':city', $data['city'], PDO::PARAM_STR);
        $sql->execute();
    }

    /**
     * @param $data
     * @return void
     */
    public function editAddress($data):void
    {
        $stmt = "UPDATE `addresses` SET `name`=:name, `city`=:city WHERE `id`=:id";
        $sql = $this->getConnection()->prepare($stmt);
        $sql->bindParam(':name', $data['name']);
        $sql->bindParam(':city', $data['city']);
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
     * @return PDO
     */
    public function getConnection(): PDO
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
