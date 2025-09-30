<?php
class Database {
    private $host = "172.31.22.43";   // my server hostname 172.31.22.43
    private $db_name = "Idris200627987";  // my database name
    private $username = "Idris200627987"; 
    private $password = "LR07Wuh7XG"; 
    public $conn;

public function getConnection() {
    // we need to Initialize the connection variable as null
    $this->conn = null;

    try {
        // Create a new PDO instance with host, db name, username, and password
        $this->conn = new PDO(
            "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
            $this->username,
            $this->password
        );

        // Set PDO error mode to exception for better debugging
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // this is the end of the try catch below
    } catch(PDOException $exception) {
        // If connection fails, display the error message
        echo "Connection failed: " . $exception->getMessage();
    }

    // this below Return the database connection (or null if it failed)
    return $this->conn;
}
}

