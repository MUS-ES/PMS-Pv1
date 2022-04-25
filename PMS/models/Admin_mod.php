<?php
class Admin_mod
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function login($username, $password)
    {

        $this->db->query('SELECT username,password FROM admin WHERE username= :username');
        //Bind value
        $this->db->bind(':username', $username);
        $this->db->execute();
        if ($this->db->rowCount() == 0) {
            return false;
        }
        $row = $this->db->single();

        if ($password == $row->password) {
            return $row;
        }
        return false;
    }
}
