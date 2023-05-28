<?php
    require_once 'search_session.php';

    if (!isset($_SESSION["user_id"])) {
        header("Location: SignIn.php");
        exit;
    }

        
    if(isset($_SESSION["icon"])){
        if($_SESSION["icon"] == "account"){
            $icon = "./image/SVG/".$_SESSION["icon"].".svg";
        }else{
            $icon = "./image/trainer/".$_SESSION["icon"].".png";
        }
    }
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Catch all Pokemon</title>
        <link rel="stylesheet" href="./navbar.css">
        <link rel="stylesheet" href="./box_pokemon.css">
        <link rel="stylesheet" href="./type.css">
        <script src="./Box_pokemon.js" defer></script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Alkatra&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Alkatra&family=Delicious+Handrawn&display=swap" rel="stylesheet">
    </head>


    <body id="bd">

        <nav class="navbar">
            <div class="container-fluid">

                <div id="poke_box">
                    <img src="./image/rand/pokeball.png">
                </div>

                <div id="navbar-info">
                    <ul class="info">
                        <li data-id="1"><a class="nav-link" href = 'Home.php'>Home</a></li>
                        <li data-id="2"><a class="nav-link">Catch</a></li>
                        <li><a class="nav-link" href = 'Game.php'>Play</a></li>
                        <li><a class="nav-link" href = "evolution-ston.php"> Stone</a></li>
                    </ul>
                    
                    <?php
                    if (checkSession() == 0) {
                        echo '<div class="login">
                                    <li data-id="5"><a class="nav-link" href="./SignIn.php">Sign In</a></li>
                                    <li data-id="6"><a class="nav-link" href="./Login.php">Login</a></li>
                                    </div>
                                    <img src="./image/SVG/account.svg" class="svg2">';
                    } else {
                        echo '<div class="login">
                                    <li data-id="6"><a class="nav-link" href="./Logout.php">Logout</a></li>
                                    </div>
                                    <a href="Profile.html"><img src= "'.$icon.'" class="svg2"></a>';
                    }
                    ?>
                </div>
            </div>
        </nav>

        <section id = 'sc'>
        </section>

        <article class="hidden">
                <div class="overlay"> 
                    <div class="card">
                        <img class="exit" src="./image/SVG/x-square.svg">
                        <div class="card-section-left" id="right">
                            <div class="overlay2">
                                <img class="modal-img">
                            </div>
                        </div>
                        <div class="card-section-right">

                            <div>
                                <span>N. pokedex: </span>
                                <span class="pokedex"></span>
                            </div>

                            <div>
                                <div class="name-pokemon">
                                    <div>
                                        <span>Pokemon: </span>
                                        <span class="name"></span>
                                    </div>
                                    <div class="type-box">
                                    </div>
                                </div>
                            </div>

                            <div class="moves-span_box">
                                <span>Moves</span>
                            </div>

                            <div class="moves-box">
                            </div>

                            <div class="pokeball-container">
                                <img src="./image/rand/pokeball.png" class="pokeball" title="free">
                                <button class="btn add">Add to Team</button>
                            </div>
                        </div>
                    </div>
                </div>
        </article>

        
    </body>

</html>