<?php

include_once(__DIR__ . "/../../connection/connect_db.php");
header('Content-Type: application/json');
$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);//written by chatgpt i didn't know how to make the data a json
    $session_id = $data['session_id'] ?? "";

    $sql = "SELECT is_verified
            FROM my_sessions
            JOIN users ON my_sessions.user_id = users.id 
            WHERE my_sessions.id = '$session_id'";

    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        if ($row) {
            $is_verified = $row['is_verified'];
            $response['is_verified'] = $is_verified;

        } else {
            $response['error'] = 'Session not found';
        }
    } else {
        $response['error'] = 'Query failed';
    }

    echo json_encode($response);
}
?>