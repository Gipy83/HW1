<?php
    require_once 'dbconfig.php';

    header('Content-Type: application/json');
    //---------------------------------------------------------------------------------------------------------------------------------
    function search_pokemon($set){
        $verifica = array();

        $url = 'https://pokeapi.co/api/v2/pokemon/';
        $query = urlencode($_GET["pokemon"]);
        $search1 = $url.$query;

        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch1, CURLOPT_URL, $search1);
        $res = json_decode(curl_exec($ch1));
        curl_close($ch1);

        for($a = 0; $a<4; ++$a){

            $flag = true;
            
            if((count($res->moves) >= 4)){
                $randNum = rand(0,count($res->moves)-1);
                for($b=0;$b<$a;++$b){
                    if(!$a == 0){
                        if($verifica[$b]==$randNum){
                            $flag=false;
                        }
                    }
                }
            }else{
                $randNum = rand(0,count($res->moves)-1);
            }

            if($flag){
                array_push($verifica, $res->moves[$randNum]->move->name);
            }else{
                --$a;
            }
        }
        $moves = [array("move" => $verifica[0]), array("move" => $verifica[1]), 
                    array("move" => $verifica[2]), array("move" => $verifica[3])];
        
        $return = ['id'=>$res->id,
                    'sprites'=>$res->sprites,
                    'name'=>$res->name,
                    'types'=>$res->types,
                    'move'=>$moves];

        if($set == 0){
            echo json_encode($return);
        }else{
            return $return;
        }
    }
    //---------------------------------------------------------------------------------------------------------------------------------

    function search_move($move){
        $url = 'https://pokeapi.co/api/v2/move/';
        $search = $url.$move;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $search);
        $moveRes = json_decode(curl_exec($ch));

        return ['name'=>$moveRes->name, 'type'=>$moveRes->type->name];
    }

    //---------------------------------------------------------------------------------------------------------------------------------
    function modal(){
        $conn = Connect();

        $img = mysqli_real_escape_string($conn, $_GET["img"]);
        $id_session = mysqli_real_escape_string($conn, $_SESSION["user_id"]);

        $query = "SELECT C.*, I.* FROM (Catch C JOIN Image I ON C.img = I.id) WHERE C.id = $id_session && I.src = '$img'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $res = mysqli_fetch_assoc($res);

        $types = [array("type" => $res["type_pokemon1"]), array("type" => $res["type_pokemon2"])];
        $moves = [array("move" => $res["move1"], "type" => $res["type1"]), array("move" => $res["move2"], "type" =>  $res["type2"]), 
                    array("move" => $res["move3"], "type" => $res["type3"]), array("move" => $res["move4"], "type" =>$res["type4"])];

        $return = ["pokedex"=> $res["pokedex"], "pokemon" => $res["pokemon"], "types"=> $types, "src"=> $res["src"],
                    "moves"=> $moves];

        echo json_encode($return);
    }

    //---------------------------------------------------------------------------------------------------------------------------------
    function print_pokemon(){
        $conn = Connect();
        $id_session = mysqli_real_escape_string($conn, $_SESSION["user_id"]);

        $query_img = "SELECT I.src FROM (Catch C JOIN Image I ON C.img = I.id) WHERE C.id = $id_session";
        $res = mysqli_query($conn, $query_img) or die(mysqli_error($conn));
        
        $a=0;
        $stampa = array();
        while($row = $res->fetch_array(MYSQLI_NUM)){
            $stampa[$a++]= $row[0];
        }

        echo json_encode($stampa);
    }

    //---------------------------------------------------------------------------------------------------------------------------------
    function search_pokemon_db($parametro){
        $conn = Connect();
        $id = mysqli_real_escape_string($conn, $_SESSION["user_id"]);
        
        if($parametro == 0){
            $pokedex = mysqli_real_escape_string($conn, $_GET["pokedex"]);
            $query = "SELECT * FROM Catch WHERE id = $id && pokedex = '$pokedex'";
        }else{
            $query = "SELECT * FROM Catch WHERE id = $id";
        }
    
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if($parametro == 0){
            echo json_encode(array('catch' => mysqli_num_rows($res) > 0 ? true : false));
        }else{
            return mysqli_num_rows($res);
        }

        mysqli_close($conn);
    }
    //---------------------------------------------------------------------------------------------------------------------------------
   
    function catch_pokemon(){
        $conn = Connect();
        $moves = array();
        //mi prendo tutti i dati
        $res = search_pokemon(1);

        $id_session = mysqli_real_escape_string($conn, $_SESSION["user_id"]);
        $pokedex = mysqli_real_escape_string($conn, $res["id"]);
        $pokemon = mysqli_real_escape_string($conn, $res["name"]);
        $img = mysqli_real_escape_string($conn, $res["sprites"]->front_default);
        $moves_res = $res["move"];
        
        for($a = 0; $a < 4; $a++){
            array_push($moves, search_move($moves_res[$a]["move"]));
        }

        $move1 = $moves[0]["name"];
        $move2 = $moves[1]["name"];
        $move3 = $moves[2]["name"];
        $move4 = $moves[3]["name"];

        $type1 = $moves[0]["type"];
        $type2 = $moves[1]["type"];
        $type3 = $moves[2]["type"];
        $type4 = $moves[3]["type"];

        $img_id = search_src($img);

        if($img_id == null){
            insert_src($img);
            $img_id = search_src($img);
        }

        
        if(count($res["types"]) == 1){
            $type_pk = mysqli_real_escape_string($conn, $res["types"][0]->type->name);
            $query = "INSERT INTO Catch (id, pokedex, pokemon, type_pokemon1, type_pokemon2, 
                    move1, move2, move3, move4, type1, type2, type3, type4, img) VALUES ($id_session, $pokedex,'$pokemon',
                    '$type_pk','', '$move1', '$move2', '$move3', '$move4', '$type1', '$type2', '$type3', '$type4', $img_id)";
        }else{
            $type_pk = mysqli_real_escape_string($conn, $res["types"][0]->type->name);
            $type_pk2 = mysqli_real_escape_string($conn, $res["types"][1]->type->name);
            $query = "INSERT INTO Catch VALUES ($id_session, '$pokedex','$pokemon','$type_pk','$type_pk2',
                    '$move1', '$move2', '$move3', '$move4', '$type1', '$type2', '$type3', '$type4', $img_id)";
        }
        
        mysqli_query($conn, $query) or die(mysqli_error($conn));

        echo json_encode("fine");
    }

    //---------------------------------------------------------------------------------------------------------------------------------
    function search_src($img){
        $conn = Connect();

        $query = "SELECT id FROM Image WHERE src = '$img'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $id = mysqli_fetch_assoc($res);

        if(mysqli_num_rows($res) != 0){
            return $id["id"];
        }else{
            return null;
        }
    }

    //---------------------------------------------------------------------------------------------------------------------------------
    function insert_src($img){
        $conn = Connect();

        $query = "INSERT INTO Image(src) VALUES ('$img')";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    }

    //---------------------------------------------------------------------------------------------------------------------------------
    function free_pokemon(){

        $conn = Connect();
        //mi prendo tutti i parametri
        $id_session = mysqli_real_escape_string($conn, $_SESSION["user_id"]);
        $pokedex = mysqli_real_escape_string($conn,$_GET["pokedex"]);
        $img = mysqli_real_escape_string($conn, $_GET["img"]);

        //verifico se il pokemon è stato effettivamente catturato e se è stato catturato lo libero altrimenti non faccio nulla
        $query = "SELECT * FROM Catch WHERE id = '$id_session' && pokedex = '$pokedex'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if(mysqli_num_rows($res) > 0){
            $query_delete = "DELETE FROM Catch WHERE id='$id_session' && pokedex = '$pokedex';";
            if(!(mysqli_query($conn, $query_delete) or die(mysqli_error($conn)))){
                echo json_encode(array('ok' => false));
                exit;
            }
        }

        //verifico se esistono altri account con lo stesso pokemon catturato e se non esistono cancello l'url 
        //del pokemon dalla tabella delle immagini
        $query_img = "SELECT * FROM (Catch JOIN Image JOIN Team) WHERE src = '$img'";
        $res2 = mysqli_query($conn, $query_img) or die(mysqli_error($conn));

        if(mysqli_num_rows($res2) == 0){
            $delete_image = "DELETE FROM Image WHERE src = '$img'";
            if(!(mysqli_query($conn, $delete_image) or die(mysqli_error($conn)))){
                echo json_encode(array('ok' => false));
                exit;
            }
        }

        mysqli_close($conn);
        echo json_encode(array('ok' => true, 'numeroRighe'=> mysqli_num_rows($res2)));
    }

    //-------------------------------------------------------------------------------------------------------------------------------
    
    function addTeam(){
        if(searchTeam(1)){
            $conn = Connect();

            $session = mysqli_real_escape_string($conn, $_SESSION["user_id"]);
            $pokedex = mysqli_real_escape_string($conn, $_GET["pokedex"]);

            if(searchTeam(1)){
                if(!searchTeam(2)){
                    $query = "insert into Team values ('$session', '$pokedex')";
                    mysqli_query($conn, $query) or die(mysqli_error($conn));
                    echo json_encode(array("insert"=> true));
                }else{
                    $query ="DELETE FROM Team WHERE session = '$session' && pokemon = '$pokedex'";
                    mysqli_query($conn, $query) or die(mysqli_error($conn));
                    echo json_encode(array("insert"=> false));
                }
            }
        }else{
            echo json_encode(array("insert"=> "Team al completo"));
        }
    }

    //--------------------------------------------------------------------------------------------------------------------------------

    function searchTeam($parametro){
        $conn = Connect();


        $session = mysqli_real_escape_string($conn, $_SESSION["user_id"]);
        
        if($parametro == 0 || $parametro == 1){
            $query = "SELECT I.src FROM (Team T JOIN Catch C JOIN Image I on T.pokemon = C.pokedex && I.id = C.img) WHERE C.id = $session";
        }else{
            $pokedex = mysqli_real_escape_string($conn, $_GET["pokedex"]);
            $query = "SELECT * FROM (Team T JOIN Catch C JOIN Image I on T.pokemon = C.pokedex && I.id = C.img) WHERE C.id = $session and C.pokedex = $pokedex";
        }

        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $a=0;
        $result = array();
        while($row = $res->fetch_array(MYSQLI_NUM)){
            $result[$a++]= $row[0];
        }

        if($parametro == 0){
            return $result;
        }else if($parametro == 1){
            if(mysqli_num_rows($res) < 6){
                return true;
            }
            return false;
        }else{
            if(mysqli_num_rows($res) > 0){
                return true;
            }
            return false;
        }
    }

    function profile($parametro){
        $conn = Connect();
        $session = mysqli_real_escape_string($conn, $_SESSION["user_id"]);
        
        $query = "SELECT U.username, U.nome, U.cognome, A.img, A.icon FROM (User U JOIN Avatar A on U.image = A.id) Where U.id = $session";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $res = mysqli_fetch_array($res);

        $team = searchTeam(0);
        $catture = search_pokemon_db(1);

        $return = ["username"=> $res["username"],"nome"=> $res["nome"], "cognome"=> $res["cognome"], 
                        "img"=> $res["img"], "icon"=> $res["icon"], "team" => $team, 'N_catture'=>$catture];

        if($parametro == 0){
            echo json_encode($return);
        }else{
            return $return;
        }
    }

    function save_profile(){
        $conn = Connect();
        $session = mysqli_real_escape_string($conn, $_SESSION["user_id"]);
        $img = mysqli_real_escape_string($conn, $_GET["src"]);
        
        
        $query = "SELECT * FROM Avatar WHERE img = '$img'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $res = mysqli_fetch_array($res);
        
        echo json_encode($res);
        $_SESSION["icon"] = $res["icon"];
        echo json_encode($_SESSION["icon"]);
        $img = $res["id"];

        $query = "UPDATE User SET image = $img WHERE id = $session";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    }
    //-------------------------------------------------------------------------------------------------------------------------------
    
?>