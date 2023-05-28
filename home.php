<?php
    require_once 'search_session.php';
    if(isset($_SESSION["user_id"])){
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
        <link rel="stylesheet" href="./body.css">
        <link rel="stylesheet" href="./type.css">
        <script src="./home.js" defer></script>

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
                        <li><a class="nav-link">Home</a></li>
                        <li><a class="nav-link" href = 'Catch.php'>Catch</a></li>
                        <li><a class="nav-link" href = 'Game.php'>Play</a></li>
                        <li><a class="nav-link" href = "evolution-ston.php"> Stone</a></li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control" type="text" name="search" placeholder="Search">
                        <button id="btn" type="submit">
                            <img src="./image/SVG/search.svg">
                        </button>
                    </form>
                    <?php
                    if (checkSession() == 0) {
                        echo '<div class="login info2">
                        <li><a class="nav-link" href="./SignIn.php">Sign In</a></li>
                        <li><a class="nav-link" href="./Login.php">Login</a></li>
                        </div>
                        <img src="./image/SVG/account.svg" class="svg2">';
                    } else {
                        echo '<div class="login">
                        <li><a class="nav-link" href="./Logout.php">Logout</a></li>
                        </div>
                        <a href="Profile.html"><img src= "'.$icon.'" class="svg2"></a>';
                    }
                    ?>
                </div>
            </div>
        </nav>

        <div id="cover">
            <div class="overlay">
                <div id="descrizione">
                    <span>
                        I Pokémon sono creature immaginarie che sono diventate estremamente popolari grazie a una vasta 
                        serie di videogiochi, una serie televisiva, film e una moltitudine di prodotti correlati. Creati da 
                        Satoshi Tajiri e Ken Sugimori, i Pokémon sono il fulcro di un mondo immaginario in cui gli allenatori 
                        catturano, addestrano e combattono con queste creature.</br></br>
                    </span>
                    <span>
                        Ogni Pokémon ha una specie unica e possiede abilità e caratteristiche distinte. Sono classificati in 
                        diverse generazioni, con ogni generazione che introduce nuovi Pokémon, solitamente centinaia in più 
                        rispetto alla precedente. Ogni Pokémon appartiene a uno o due "tipi" che determinano i loro punti di 
                        forza e debolezza in battaglia. Ad esempio, un Pokémon di tipo Fuoco sarà forte contro i Pokémon di tipo 
                        Erba, ma debole contro quelli di tipo Acqua.</br></br>
                    </span>
                    <span>
                        Gli allenatori di Pokémon viaggiano per il mondo, catturando Pokémon selvatici con delle sfere chiamate 
                        Pokéball e formando una squadra di Pokémon con cui combattere contro altri allenatori. Gli scontri tra 
                        Pokémon avvengono in apposite arene chiamate palestre, in cui gli allenatori si sfidano per guadagnare medaglie 
                        e progredire nel loro viaggio di addestramento.</br></br>
                    </span>
                    <span>
                        Oltre al gioco di ruolo tradizionale, i Pokémon sono diventati anche una piattaforma di intrattenimento 
                        attraverso la serie animata televisiva che segue le avventure di un giovane allenatore di nome Ash Ketchum 
                        e del suo fedele Pokémon Pikachu. Ci sono stati anche numerosi film animati che hanno approfondito la storia 
                        e le avventure dei Pokémon.</br></br>
                    </span>
                    <span>
                        I Pokémon hanno un'enorme varietà di design e personalità. Alcuni sono carini e amichevoli, mentre altri 
                        sono più feroci e imponenti. Sono spesso ispirati dalla natura, da animali reali, mitologia e altre fonti 
                        di ispirazione.
                    </span>
                </div>
            </div>
        </div>


        <section>
        </section>

        <footer id="foot">
            <nav id="nav-foot">
                <div class="footer-container">
                    <div class="footer-col">
                        <h2>Catch all Pokemon</h2>
                    </div>
                    <div class="footer-col">
                        <strong>AZIENDA</strong>
                        <p>Chi siamo</p>
                        <p>Lavora con noi</p>
                    </div>
                    <div class="footer-col">
                        <strong>CATEGORIE</strong>
                        <p><a href="https://www.pokemoncenter.com/">Articoli<a></p>
                    </div>
                    <div class="footer-col">
                        <strong>LINK UTILI</strong>
                        <p>Assistenza</p>
                        <p>App per cellulare</p>
                        <p>Informazioni legali</p>
                    </div>
                </div>
            </nav>

        </footer>
    </body>

</html>