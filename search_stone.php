<?php
$url = 'https://pokeapi.co/api/v2/item?offset=20&limit=2100';
$search = $url;
$return = array();


$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $search);
$res = json_decode(curl_exec($ch));
curl_close($ch);

$cont = 0;
for($a = 0; $a < count($res->results); $a++){
    if(str_ends_with($res->results[$a]->name, "-stone") && $cont < 22){
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $res->results[$a]->url);
        $res2 = json_decode(curl_exec($ch));
        array_push($return, $res2);
        $cont++;
    }
}
echo json_encode($return);
?>