<?php
include_once "../../connection/connect_db.php";

if ($continue) {
    $conn->begin_transaction();
    try {
        //creating address table
        $sql = "CREATE TABLE IF NOT EXISTS addresses (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        country VARCHAR(50) NOT NULL,
        city VARCHAR(50) NOT NULL,
        street VARCHAR(50) NOT null
        )
    ";
        if (!$conn->query($sql)) {
            $continue = false;
            echo "failed to create addresses table||";
            die();
        } else
            echo "addresses table created||\n";

        //creating wallet table

        //creating users table
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(50) NOT NULL,
            last_name VARCHAR(50) NOT NULL,
            username VARCHAR(50) NOT NULL,
            phone_number VARCHAR(50) UNIQUE,
            email VARCHAR(50) UNIQUE,
            pass VARCHAR(255) NOT NULL,
            user_type VARCHAR(50) DEFAULT 'client',
            is_verified TINYINT(1) DEFAULT 0,
            verification_date TIMESTAMP NULL DEFAULT NULL,
            address_id INT(11),
            wallet_id INT(11),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            -- don't forget to add foreign keys in the end
        )
    ";
        if (!$conn->query($sql)) {
            $continue = false;
            echo "failed to create users table||";
            die();
        } else
            echo "users table created||\n";



    } catch (Exception $e) {
        echo $e;
    }
}





?>