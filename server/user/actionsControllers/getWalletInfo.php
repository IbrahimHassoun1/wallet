<?php
//this file was reformatted by AI because I was running out of time and it had so many bugs
include_once(__DIR__ . "/../../connection/connect_db.php");
header('Content-Type: application/json');

$response = array();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data["user_id"])) {
        echo json_encode(["error" => "User ID is required"]);
        exit;
    }

    $user_id = intval($data["user_id"]); // Ensure it's an integer
    $response["message"] = "User ID is " . $user_id;

    // Get wallet ID
    $sql = "SELECT wallet_id FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $wallet_id = $row["wallet_id"];
            $stmt->close(); // Close statement before new query

            // Get wallet details
            $sql = "SELECT currency, total_balance FROM wallets WHERE id=?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("i", $wallet_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($row = $result->fetch_assoc()) {
                    $response["currency"] = $row["currency"];
                    $response["total_balance"] = $row["total_balance"];
                }
                $stmt->close();
            }

            // Count total cards (fixing incorrect WHERE clause)
            $sql = "SELECT COUNT(*) AS total_cards FROM cards WHERE wallet_id=?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("i", $wallet_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($row = $result->fetch_assoc()) {
                    $response['total_cards'] = $row["total_cards"];
                }
                $stmt->close();
            }
        }
    }
}

echo json_encode($response);
?>