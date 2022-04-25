<?php

class Database
{
    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;

    private $statement;
    private $dbHandler;
    public function __construct()
    {
        $conn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
        } catch (PDOException $e) {
            write_log($e->getMessage());
            echo $e->getMessage();
        }
    }
    //Allows us to write queries
    public function query($sql)
    {
        $this->statement = $this->dbHandler->prepare($sql);
    }
    //Bind values
    public function bind($parameter, $value, $type = null)
    {

        switch (is_null($type)) {
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
        }
        $this->statement->bindValue($parameter, $value, $type);
    }
    //Execute the prepared statement
    public function execute()
    {
        return $this->statement->execute();
    }
    //Return an array
    public function resultSet()
    {

        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }
    public function single()
    {

        return $this->statement->fetchObject();
    }

    //Get's the row count
    public function rowCount()
    {

        return $this->statement->rowCount();
    }
    public function lastInsertId(){
       return $this->dbHandler->lastInsertId();
    }
}

/* $db = new Database();
$db->query("SELECT active FROM users where id=:id");
$db->bind(':id', 32);
 $db->execute();
print_r($db->single()); */