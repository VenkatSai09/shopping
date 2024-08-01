<?php

require 'C:\xampp\htdocs\git repo\db_connect.php';

class Customer {
    private $conn;
    private $table = 'customers';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($name, $email, $password) {
        // Insert into the customers table
        $query1 = "INSERT INTO customers (name, email) VALUES (?, ?)";
        $stmt1 = $this->conn->prepare($query1);
        $stmt1->bind_param('ss', $name, $email);
        if ($stmt1->execute()) {
            // Get the last inserted ID (customerid)
            $customerid = $stmt1->insert_id;
    
            // Insert into the login table
            $query2 = "INSERT INTO login (customerid, password) VALUES (?, ?)";
            $stmt2 = $this->conn->prepare($query2);
            $stmt2->bind_param('is', $customerid, $password);
            return $stmt2->execute();
        } else {
            return false;
        }
    }
    

    public function findByEmail($email) {
        // Query the customers table to find the customerid by email
        $query1 = "SELECT id, name FROM customers WHERE email = ?";
        $stmt1 = $this->conn->prepare($query1);
        $stmt1->bind_param('s', $email);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
    
        // Check if the customer exists
        if ($result1->num_rows > 0) {
            $user = $result1->fetch_assoc();
            $customerid = $user['id'];
    
            // Query the login table to find the password using customerid
            $query2 = "SELECT password FROM login WHERE customerid = ?";
            $stmt2 = $this->conn->prepare($query2);
            $stmt2->bind_param('i', $customerid);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
    
            // Check if the password exists
            if ($result2->num_rows > 0) {
                $loginData = $result2->fetch_assoc();
                // Add the password to the user data
                $user['password'] = $loginData['password'];
                return $user; // Return user data including the password
            }
        }
        return null; // No user or password found
    }
    
    
}
?>
