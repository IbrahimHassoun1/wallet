<?php
include_once(__DIR__ . "/../../connection/connect_db.php");
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);//written by chatgpt i didn't know how to make the data a json
    $id = $data['id'] ?? "";

    $first_name = $data['first_name'] ?? "";
    $last_name = $data['last_name'] ?? "";
    $phone_number = $data['phone_number'] ?? "";
    $email = $data['email'] ?? "";
    $pass = $data['pass'] ?? "";
    $is_verified = $data['is_verified'] ?? "";

    if (empty($id)) {
        $response['message'] = "user id was not sent!";
        echo json_encode($response);
        http_response_code(400);
        exit;
    }

    $sql = "UPDATE users SET ";
    $types = '';
    $params = [];

    //formatted by chatgpt here because types kept mismatching
    if (!empty($first_name)) {
        $sql .= "first_name=?, ";
        $types .= "s";
        $params[] = $first_name;
    }
    if (!empty($last_name)) {
        $sql .= "last_name=?, ";
        $types .= "s";
        $params[] = $last_name;
    }
    if (!empty($phone_number)) {
        $sql .= "phone_number=?, ";
        $types .= "s";
        $params[] = $phone_number;
    }
    if (!empty($email)) {
        $sql .= "email=?, ";
        $types .= "s";
        $params[] = $email;
    }
    if (!empty($pass)) {
        $sql .= "pass=?, ";
        $types .= "s";
        $params[] = $pass;
    }
    if (!empty($is_verified)) {
        $sql .= "is_verified=?, ";
        $types .= "i";
        $params[] = $is_verified;
    }

    $sql = rtrim($sql, ", ");

    $sql .= " WHERE id=?";


    $types .= "i";
    $params[] = $id;

    if ($stmt = $conn->prepare($sql)) {

        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $stmt->close();
        $response["message"] = "updated successfully";
        echo json_encode($response);
        http_response_code(200);
    }


    // ATTENTION don't forget to handle address changes bob
}

?>