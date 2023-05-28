<?php
    require_once 'search_session.php';
    
    if (!isset($_SESSION["user_id"])) {
        header("Location: SignIn.php");
        exit;
    }

    if($_SESSION["icon"] == "account"){
        $icon = "./image/SVG/".$_SESSION["icon"].".svg";
    }else{
        $icon = "./image/trainer/".$_SESSION["icon"].".png";
    }

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Catch all Pokemon</title>
        <link rel="stylesheet" href="./navbar.css">
        <link rel="stylesheet" href="./game.css">
        <script src="./game.js" defer></script>

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
                        <li data-id="1"><a class="nav-link" href="Home.php">Home</a></li>
                        <li data-id="2"><a class="nav-link" href = 'Catch.php'>Catch</a></li>
                        <li data-id="2"><a class="nav-link">Play</a></li>
                        <li><a class="nav-link" href = "evolution-ston.php"> Stone</a></li>
                    </ul>

                    <?php
                    if (checkSession() == 0) {
                        echo '<div class="login info2">
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

        <section id="sc">
            <div id="stamp">
                <div id="card">
                    <h1>Who's that pokemon?</h1>
                    <img class="hide">
                    <form type="submit"><input type="text" class="form-control"></form>
                </div>
                <div id="risposte">
                    <div>

                    </div>
                    <button class="btn">Change</button>
                </div>
            </div>
        </section>

        </body> 
</html>