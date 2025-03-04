<?php
include_once(__DIR__ . "/../../connection/connect_db.php");
header('Content-Type: application/json');
$response = array();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);//written by chatgpt i didn't know how to make the data a json
    $session_id = $data['session_id'] ?? "";
    if (empty($session_id)) {
        $response['message'] = "session id was not sent!";
        echo json_encode($response);
        exit;
    }
    $sql = "SELECT * 
    FROM users 
    WHERE id = (SELECT user_id 
                FROM my_sessions 
                WHERE id like ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $session_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $response["message"] = "user found";
            $response["data"] = $row;
            //user info found,now let's get his address
            $address_id = $row['address_id'];
            $sql = "SELECT * FROM addresses where id like $address_id";
            if ($result = $conn->query($sql)) {
                $address = $result->fetch_assoc();
                $response["address"] = $address;
            }
        } else {
            $response["message"] = "no user found for this session ID";
        }
        $stmt->close();

    } else {
        $response["message"] = 'statement not prepared';
    }


    ;


}



echo json_encode($response);
?>