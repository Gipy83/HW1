<?php
    require_once 'dbconfig.php';
    require_once 'function.php';

    header('Content-Type: application/json');
    session_start();

    print_pokemon();
?>