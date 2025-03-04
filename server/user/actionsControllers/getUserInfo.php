<?php
include_once(__DIR__ . "/../../connection/connect_db.php");
header('Content-Type: application/json');
$response = array();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $session_id = $_POST['session_id'] ?? "";
    if ($session_id == "") {
        $response['message'] = "session id was not sent!";
        echo json_encode($response);
        exit;
    }
    $sql = "SELECT * 
    FROM users 
    WHERE id = (SELECT user_id 
                FROM my_sessions 
                WHERE id = $session_id)";

    if ($result = $conn->query($sql)) {
        $row = $result->fetch_assoc();
        $response["message"] = "user found";
        echo json_encode($response);
    }
    ;


}



echo json_encode($response);
?>