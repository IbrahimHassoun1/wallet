<?php
include_once(__DIR__ . "/../../connection/connect_db.php");
header('Content-Type: application/json');
$response = array();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $sender_id = $data['sender_id'];
    $receiver_id = $data['receiver_id'];
    $amount = $data['amount'];

    $conn->begin_transaction();
    try {
        $sql = "INSERT INTO transactions (sender_id, receiver_id, amount) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iii', $sender_id, $receiver_id, $amount);

        if (!$stmt->execute()) {
            $response['message'] = 'Couldnt add new transaction';
            throw new Exception("Couldn't add new transaction");
        }
        $stmt->close();

        //get sender card previous balance
        $sql = "SELECT balance FROM cards WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $sender_id);
        $stmt->execute();
        $stmt->bind_result($prev_balance);
        $stmt->fetch();
        $stmt->close();

        if ($prev_balance < $amount) {
            $response['message'] = 'Insufficient funds';
            throw new Exception("Insufficient funds");
        }
        $new_balance = $prev_balance - $amount;

        //update sender balance
        $sql = "UPDATE cards SET balance=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $new_balance, $sender_id);
        if (!$stmt->execute()) {
            $response['message'] = 'Couldnt update sender balance';
            throw new Exception("Couldn't update sender balance");
        }
        $stmt->close();

        //get receiver card previous balance
        $sql = "SELECT balance FROM cards WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $receiver_id);
        $stmt->execute();
        $stmt->bind_result($prev_balance);
        $stmt->fetch();
        $stmt->close();

        $new_balance = $prev_balance + $amount;

        //update receiver balance
        $sql = "UPDATE cards SET balance=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $new_balance, $receiver_id);
        if (!$stmt->execute()) {
            $response['message'] = 'Couldnt update receiver balance';
            throw new Exception("Couldn't update receiver balance");
        }
        $stmt->close();
        $response['message'] = 'transaction added successfully';
        $conn->commit();
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
        $conn->rollback();
    }
}

echo json_encode($response);
?>