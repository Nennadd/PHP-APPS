<?php
require_once 'DB.php';

class Users {

    private $users;

    public function __construct(){
        $instance = DB::getInstance();
        $conn = $instance->connect();

        $sql = 'SELECT id, voters_email, voters_choice FROM voters ORDER BY id DESC';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $this->users = $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getUsers(){
        echo json_encode($this->users);
    }
}

$users = new Users();
$users->getUsers();