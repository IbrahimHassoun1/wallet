<?php
include "../migrations/migrations.php";
if ($continue) {
    $conn->begin_transaction();
    try {
        //creating address seed
        $sql = "INSERT IGNORE INTO addresses (country, city, street) 
                            VALUES ('Lebanon', 'Beirut', 'Bshara el khoury')";
        $conn->query($sql);
        echo "address seed added successfully||\n";
        $conn->commit();
        //creating user seed
        $sql = "INSERT IGNORE INTO users (first_name, last_name, username, email, pass) 
                            VALUES ('ibrahim', 'hassoun', 'bob123', 'ihassoun73@gmail.com', 'passExample')";
        $conn->query($sql);
        echo "user seed added successfully||\n";
        $conn->commit();
    } catch (Exception $e) {
        echo "failed to add";
        echo $e;
    }
}

?>