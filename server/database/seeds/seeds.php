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
        //creating wallets seed
        $sql = "INSERT IGNORE INTO wallets (total_balance,currency) 
                            VALUES (200,'dollar')";
        $conn->query($sql);
        echo "wallet seed added successfully||\n";
        $conn->commit();
        //creating user seed
        $sql = "INSERT IGNORE INTO users (first_name, last_name, username, email, pass,address_id,wallet_id) 
                                    VALUES ('ibrahim', 'hassoun', 'bob123', 'ihassoun73@gmail.com', 'passExample',1,1)";
        $conn->query($sql);
        echo "user seed added successfully||\n";
        $conn->commit();
        //creating cards seed
        $sql = "INSERT IGNORE INTO cards (balance, card_type, brand,wallet_id) 
                            VALUES (200,'debit','master',1)";
        $conn->query($sql);
        echo "card seed added successfully||\n";
        $conn->commit();
        //creating transactions seed
        $sql = "INSERT IGNORE INTO transactions (amount, sender_id, receiver_id) 
                            VALUES (200,1,2)";
        $conn->query($sql);
        echo "card seed added successfully||\n";
        $conn->commit();
    } catch (Exception $e) {
        echo "failed to add";
        echo $e;
    }
}

?>