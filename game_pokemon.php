<?php
    require_once "function.php";
    session_start();
    header('Content-Type: application/json');

    $rand = rand(0,897);
    $url = 'https://pokeapi.co/api/v2/pokemon/'.$rand;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $res = json_decode(curl_exec($ch));
    curl_close($ch);

    $pokemon = ['sprites'=>$res->sprites->front_default, 'name'=>$res->name];
    echo json_encode($pokemon);
?>