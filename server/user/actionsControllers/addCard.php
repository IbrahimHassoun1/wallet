<?php
include_once(__DIR__ . "/../../connection/connect_db.php");
header('Content-Type: application/json');

$response = array();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    $wallet_id = $data["wallet_id"] ?? "";
    $brand = $data['brand'] ?? "";
    $type = $data['type'] ?? "";

    if (empty($wallet_id)) {
        $response['message'] = 'no wallet id detected';
        echo json_encode($response);
        return;
    }
    if (empty($brand)) {
        $response['message'] = 'no brand detected';
        echo json_encode($response);
        return;
    }
    if (empty($type)) {
        $response['message'] = 'no type detected';
        echo json_encode($response);
        return;
    }

    $sql = "INSERT INTO cards (wallet_id,card_type,brand) values (?,?,?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("iss", $wallet_id, $type, $brand);

        if ($stmt->execute()) {
            $response["message"] = "Card added successfully";
            $response["inserted_id"] = $stmt->insert_id;
        } else {
            $response["error"] = "Error inserting card: " . $stmt->error;
        }

        $stmt->close();
    }

}


?>