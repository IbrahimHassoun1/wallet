<?php
include_once(__DIR__ . "/../../connection/connect_db.php");
header("Content-Type:application/json");
$response = array();



if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $sql = "SELECT card_type,count(*) as total
            FROM    cards
            GROUP BY card_type
            LIMIT 5";
    $response['message'] = 'after sql';
    if ($result = $conn->query($sql)) {
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        $response["data"] = $rows;
        $response["message"] = "got the result";
        http_response_code(200);

    } else {
        $response["message"] = "couldn't execute query";
        http_response_code(500);
    }



}


echo json_encode($response);
?>