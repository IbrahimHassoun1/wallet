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
        $sql = "CREATE TABLE IF NOT EXISTS wallets (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            total_balance INT(11) default 0,
            currency VARCHAR(50) NOT NULL,
            created_at TIMESTAMP default CURRENT_TIMESTAMP
            )
        ";
        if (!$conn->query($sql)) {
            $continue = false;
            echo "failed to create wallets table||";
            die();
        } else
            echo "wallets table created||\n";

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
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (address_id) REFERENCES addresses(id),
            FOREIGN KEY (wallet_id)  REFERENCES wallets(id)
        )
    ";
        if (!$conn->query($sql)) {
            $continue = false;
            echo "failed to create users table||";
            die();
        } else
            echo "users table created||\n";

        //creating cards table
        $sql = "CREATE TABLE IF NOT EXISTS cards (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                balance INT(11) default 0,
                card_type VARCHAR(20) not null,
                brand VARCHAR(20) not null,
                created_at TIMESTAMP default CURRENT_TIMESTAMP,
                wallet_id INT(11),
                FOREIGN KEY (wallet_id)  REFERENCES wallets(id)
                )
            ";
        if (!$conn->query($sql)) {
            $continue = false;
            echo "failed to create cards table||";
            die();
        } else
            echo "cards table created||\n";

        //creating transactions table
        $sql = "CREATE TABLE IF NOT EXISTS transactions (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            amount INT(11) not null,
            created_at TIMESTAMP default CURRENT_TIMESTAMP,
            sender_id INT(11),
            receiver_id INT(11),
            FOREIGN KEY (sender_id)  REFERENCES cards(id),
            FOREIGN KEY (receiver_id)  REFERENCES cards(id)

            )
        ";
        if (!$conn->query($sql)) {
            $continue = false;
            echo "failed to create transactions table||";
            die();
        } else
            echo "transactions table created||\n";

        //creating cards table
        $sql = "CREATE TABLE IF NOT EXISTS my_sessions (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            created_at TIMESTAMP default CURRENT_TIMESTAMP,
            user_id INT(11),
            FOREIGN KEY (user_id)  REFERENCES users(id)
            )
        ";
        if (!$conn->query($sql)) {
            $continue = false;
            echo "failed to create cards table||";
            die();
        } else
            echo "cards table created||\n";

    } catch (Exception $e) {
        echo $e;
    }
}





?>