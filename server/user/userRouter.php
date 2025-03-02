<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'register': {
            require './accountControllers/registerUser.php';
            break;
        }
        case 'login': {
            require './accountControllers/loginUser.php';
            break;
        }
        case "transaction": {
            require './transactionsControllers/transactionRouter.php';
            break;
        }
    }

}


?>