<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'getCards': {
            require './analyticsControllers/getCards.php';
            break;
        }


    }

}


?>