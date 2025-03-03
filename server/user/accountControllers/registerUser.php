<?php

include_once(__DIR__ . "/../../connection/connect_db.php");
$response = array();


header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get all the queries
    $first_name = $_POST["first_name"] ?? "";
    $last_name = $_POST["last_name"] ?? "";
    $username = $_POST["username"] ?? "";
    $email = $_POST["email"] ?? "";
    $phone_number = $_POST["phone_number"] ?? "";
    $pass = $_POST["pass"] ?? "";
    $address_id = $_POST["address_id"] ?? "";
    $wallet_id = $_POST["wallet_id"] ?? "";
    $currency = $_POST["currency"] ?? "";

    try {
        // Begin transaction
        $conn->begin_transaction();
        //make sure there is at least phone or email
        if (empty($email) && empty($phone_number)) {
            $response['status'] = 'error';
            $response['message'] = "Enter email or phone number";
            http_response_code(400); // Bad Request
            throw new Exception("Enter email or phone number");
        }
        // Make sure there is no account with this email or phone number
        $email_sql = "SELECT * FROM users WHERE email like '$email'";
        if ($conn->query($email_sql)->num_rows > 0) {
            $response['status'] = 'error';
            $response['message'] = "Email already in use";
            http_response_code(400); // Bad Request
            throw new Exception("Email already in use");
        }

        $phone_sql = "SELECT * FROM users WHERE phone_number like '$phone_number'";
        if ($conn->query($phone_sql)->num_rows > 0) {
            $response['status'] = 'error';
            $response['message'] = "Phone number already in use";
            http_response_code(400); // Bad Request
            throw new Exception("Phone number already in use");
        }
        $username_sql = "SELECT * FROM users WHERE username like '$username'";
        if ($conn->query($phone_sql)->num_rows > 0) {
            $response['status'] = 'error';
            $response['message'] = "username already in use";
            http_response_code(400); // Bad Request
            throw new Exception("username already in use");
        }

        // Make a wallet
        $wallet_sql = "INSERT IGNORE INTO wallets (currency) VALUES ('$currency')";

        if ($conn->query($wallet_sql)) {
            $wallet_id = $conn->insert_id;
        } else {
            $conn->rollback();
            $response['status'] = 'error';
            $response['message'] = "Failed to create a wallet";
            http_response_code(500); // Internal Server Error
            throw new Exception("Failed to create a wallet");
        }

        // Add user
        $sql = "INSERT IGNORE INTO users (first_name, last_name, username, email, phone_number, pass, wallet_id) 
                VALUES ('$first_name', '$last_name', '$username', '$email', '$phone_number', '$pass', $wallet_id)";

        if ($conn->query($sql)) {
            $conn->commit();
            $response['status'] = 'success';
            $response['message'] = "New Account created successfully";
            http_response_code(200); // OK
        } else {
            $conn->rollback();
            $response['status'] = 'error';
            $response['message'] = "Failed to add user";
            http_response_code(500); // Internal Server Error
            throw new Exception("Failed to add user");
        }
    } catch (Exception $e) {
        // Handle any exceptions
        if (!isset($response['status'])) {
            $response['status'] = 'error';
            $response['message'] = "An error occurred: " . $e->getMessage();
            http_response_code(500); // Internal Server Error
        }
    }
}

// Send the response as JSON
echo json_encode($response);
?>