<?php
include_once(__DIR__ . "/../../connection/connect_db.php");
header('Content-Type: application/json');
$response = array();


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $user_id = $data['user_id'] ?? "";
    if (empty($user_id)) {
        $response['message'] = "didn't find user id";
        echo json_encode($response);
        exit;
    }
    $response['message'] = " user id found";
    $sql = "SELECT * 
            FROM cards
        Where wallet_id =(SELECT wallet_id FROM users WHERE id=?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $response["data"][] = $row;
        }
    }


}





echo json_encode($response);
?>