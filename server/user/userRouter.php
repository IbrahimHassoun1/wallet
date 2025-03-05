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
        case "checkVerified": {
            require './actionsControllers/checkVerified.php';
            break;
        }
        case "getUserInfo": {
            require './actionsControllers/getUserInfo.php';
            break;
        }
        case "updateUserInfo": {
            require './actionsControllers/updateUserInfo.php';
            break;
        }
        case "getCards": {
            require './actionsControllers/getCards.php';
            break;
        }
        case "getTransactions": {
            require './actionsControllers/getTransactions.php';
            break;
        }

        case "transaction": {
            require './transactionsControllers/transactionRouter.php';
            break;
        }
        case "transfer": {
            require './transactionsControllers/transfer.php';
            break;
        }

    }

}


?>