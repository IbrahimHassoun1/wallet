<?php

include_once(__DIR__ . "/../../connection/connect_db.php");
$response = array();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = $_POST["email"] ?? "";
    $phone_number = $_POST['phone_number'] ?? "";
    $pass = $_POST["pass"];
    $found = false;
    $row;
    $id;
    try {
        $conn->begin_transaction();

        //handle email logs
        if (!empty($email)) {
            $sql = "SELECT id, pass FROM users WHERE email = '$email'";
            if ($result = $conn->query($sql)) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $found = true;
                        $response["message"] = 'id found';
                        $response['id'] = $row["id"];
                        $id = $row["id"];
                        $storedPass = $row["pass"];
                    }
                } else {
                    http_response_code(404);
                    $response["status"] = "error";
                    $response["message"] = 'Email not found';
                    $conn->rollback();
                    echo json_encode($response);
                    exit();
                }
            } else {
                http_response_code(500);
                $response["status"] = "error";
                $response["message"] = 'Email query failed';
                $conn->rollback();
                echo json_encode($response);
                exit();
            }
        }
        //handle phone logs
        else if (!empty($phone_number)) {
            $sql = "SELECT id, pass FROM users WHERE phone_number = '$phone_number'";
            if ($result = $conn->query($sql)) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $found = true;
                        $response["message"] = 'id found';
                        $response['id'] = $row["id"];
                        $id = $row["id"];
                        $storedPass = $row["pass"];
                    }
                } else {
                    http_response_code(404);
                    $response["status"] = "error";
                    $response["message"] = 'Phone number not found';
                    $conn->rollback();
                    echo json_encode($response);
                    exit();
                }
            } else {
                http_response_code(500);
                $response["status"] = "error";
                $response["message"] = 'Phone number query failed';
                $conn->rollback();
                echo json_encode($response);
                exit();
            }
        }

        //if no id was found
        if (!$found) {
            http_response_code(400);
            $response["status"] = "error";
            $response["message"] = 'Invalid credentials';
            $conn->rollback();
            echo json_encode($response);
            exit();
        }

        //check password now if id is found
        if ($storedPass != $pass) {
            http_response_code(401);
            $response["status"] = "error";
            $response["message"] = "Incorrect password";
            $conn->rollback();
            echo json_encode($response);
            exit();
        }




        //now that credentials are correct and we have user_id
        //we create a new session
        $sql = "INSERT IGNORE INTO my_sessions (user_id) 
                                            VALUES ($id)";

        if ($conn->query($sql)) {
            $last_id = $conn->insert_id;
            // Retrieve the last inserted row based on the last inserted ID
            $sql = "SELECT * FROM my_sessions WHERE id = $last_id";
            $result = $conn->query($sql);

            if ($result) {

                $row = $result->fetch_assoc();
                $response["status"] = "success";
                $response["message"] = "session created";
                setcookie("session_id", $row["id"]);
                $response["session_data"] = $row;
                $conn->commit();
                echo json_encode($response);
            } else {
                $response["status"] = "error";
                $response["message"] = "Failed to retrieve the inserted row";
                $conn->rollback();
            }
        }



    } catch (Exception $e) {
        http_response_code(500);
        $response["status"] = "error";
        $response["message"] = "An error occurred: " . $e->getMessage();
        echo json_encode($response);
    }
}

?>