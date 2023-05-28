<?php   
    require_once 'search_session.php';
    require_once 'function.php';

    if (!isset($_SESSION["user_id"])) {
        header("Location: SignIn.php");
        exit;
    }

    header('Content-Type: application/json');

    search_pokemon(0);
?>