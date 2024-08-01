<?php

include_once 'C:\xampp\htdocs\git repo\models\Customer.php';


class UserController {
    private $db;
    private $customer;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->customer = new Customer($this->db);
    }

    public function register($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        return $this->customer->create($name, $email, $hashedPassword);
    }

    public function login($email, $password) {
        $user = $this->customer->findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return true;
        }
        return false;
    }
}
?>
