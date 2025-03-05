<?php
include "../migrations/migrations.php";
if ($continue) {
    $conn->begin_transaction();
    try {
        //creating address seed
        $sql = "INSERT IGNORE INTO addresses (country, city, street) 
                            VALUES ('Lebanon', 'Beirut', 'Bshara el khoury')";
        $conn->query($sql);
        $sql = "INSERT IGNORE INTO addresses (country, city, street) 
                            VALUES ('Lebanon', 'Tripoli', 'Mina')";
        $conn->query($sql);
        $sql = "INSERT IGNORE INTO addresses (country, city, street) 
                            VALUES ('Canada', 'Vancouver', 'Example')";
        $conn->query($sql);
        $sql = "INSERT IGNORE INTO addresses (country, city, street) 
                            VALUES ('KSA', 'Riyadh', 'King Fahad')";
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
                                    VALUES ('ibrahim', 'hassoun', 'bob123', 'ihassoun73@gmail.com', '$2y$10\$O4FUIxx9U6tOiDiVB38tjuU.LNBMHnVctI.ig.lDwteyxtBChtLZ6',1,1)";
        $conn->query($sql);
        $sql = "INSERT IGNORE INTO users (first_name, last_name, username, email, pass,address_id,wallet_id,user_type) 
                                    VALUES ('admin', 'admin', 'admin', 'admin@gmail.com', '$2y$10\$fY4XK5Xb36SC9ft1PqqJ2eCzFeuxShDQ5vtQG5uu92HfyOnNLnxwC',1,1,'admin')";
        $conn->query($sql);
        echo "user seed added successfully||\n";
        $conn->commit();
        //creating cards seed
        $sql = "INSERT IGNORE INTO cards (balance, card_type, brand,wallet_id) 
                            VALUES (200,'debit','master',1)";
        $conn->query($sql);
        $sql = "INSERT IGNORE INTO cards (balance, card_type, brand,wallet_id) 
                            VALUES (300,'credit','master',1)";
        $conn->query($sql);
        echo "card seed added successfully||\n";
        $conn->commit();
        //creating transactions seed
        $sql = "INSERT IGNORE INTO transactions (amount, sender_id, receiver_id) 
                            VALUES (200,1,2)";
        $conn->query($sql);
        echo "card seed added successfully||\n";
        $conn->commit();
        //creating sessions seed
        $sql = "INSERT IGNORE INTO my_sessions (user_id) 
                                    VALUES (1)";
        $conn->query($sql);
        if ($conn->query($sql))
            echo "session seed added successfully||\n";
        else
            echo "session seed not added||\n" . $conn->error;

        $conn->commit();
    } catch (Exception $e) {
        echo "failed to add";
        echo $e;
    }
}

?>