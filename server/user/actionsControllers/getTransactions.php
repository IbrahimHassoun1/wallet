<?php
include_once(__DIR__ . "/../../connection/connect_db.php");
header('Content-Type: application/json');
$response = array();


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $user_id = $data['user_id'] ?? "";
    $card_id = $data['user_id'] ?? "";

}

?>