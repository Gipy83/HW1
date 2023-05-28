<?php
    require_once "dbconfig.php";
    require_once 'function.php';

    header('Content-Type: application/json');
    session_start();

    search_pokemon_db(0);
?>