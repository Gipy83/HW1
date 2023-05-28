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
        <title>MHW1</title> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="evolution-ston.css"/>
        <link rel="stylesheet" href="navbar.css"/>
        <script src="./evolution-ston.js" defer></script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Alkatra&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Alkatra&family=Delicious+Handrawn&display=swap" rel="stylesheet">
    </head>

    <body id="bod">
        <nav class="navbar">
            <div class="container-fluid">

                <div id="poke_box">
                    <img src="./image/rand/pokeball.png">
                </div>

                <div id="navbar-info">
                    <ul class="info">
                        <li><a class="nav-link" href = 'Home.php'>Home</a></li>
                        <li><a class="nav-link"  href = 'Catch.php'>Catch</a></li>
                        <li><a class="nav-link" href = 'Game.php'>Play</a></li>
                        <li><a class="nav-link" > Stone</a></li>
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

        <article id="art">
            <div id="intro">
                <span>
                    L'evoluzione dei Pokémon è un concetto centrale all'interno del franchise dei Pokémon. Si tratta di un processo in cui 
                    un Pokémon cambia forma e diventa una specie diversa, spesso più potente e con abilità e caratteristiche uniche. 
                    L'evoluzione dei Pokémon può avvenire in diverse fasi e richiedere determinate condizioni per essere attivata.</br></br>
                </span>
                <span>
                    Innanzitutto, molti Pokémon nascono in una forma pre-evolutiva chiamata "base" o "stadio iniziale". Questi Pokémon 
                    possono poi evolversi in una o più forme successive attraverso vari mezzi. Uno dei metodi più comuni è l'aumento di 
                    livello, in cui un Pokémon raggiunge un certo livello di esperienza e si evolve automaticamente. Altri metodi di 
                    evoluzione includono l'uso di pietre speciali, come le Pietre Evolutive, che possono essere utilizzate per forzare 
                    l'evoluzione di un Pokémon, o l'amicizia, dove un legame stretto con il suo Allenatore può innescare l'evoluzione.</br></br>
                </span>
                <span>
                    Durante il processo di evoluzione, i Pokémon attraversano un cambiamento fisico e spesso acquisiscono nuove mosse e 
                    statistiche migliorate. Possono anche cambiare il loro aspetto estetico, dimensione e personalità. Alcune evoluzioni 
                    sono semplici e lineari, mentre altre possono avere diversi rami evolutivi, permettendo ai giocatori di scegliere quale 
                    direzione prendere.</br></br>
                </span>
                <span>
                    Le evoluzioni dei Pokémon sono una parte fondamentale del gameplay dei videogiochi Pokémon. Gli allenatori cercano 
                    di catturare e allenare Pokémon di livello base, con l'obiettivo di farli evolvere in forme più forti. Questo sistema 
                    offre un senso di progressione e soddisfazione nel vedere i propri Pokémon crescere e migliorare nel corso dell'avventura.</br></br>
                </span>
                <span>
                    L'evoluzione dei Pokémon è diventata anche un elemento iconico del franchise dei Pokémon. Molti Pokémon hanno diverse 
                    forme e stadi evolutivi, e i giocatori spesso si dedicano a completare il Pokédex, cercando di catturare tutte le 
                    diverse forme di ogni specie di Pokémon.</br></br>
                </span>
            </div>
        </article>


        <section id="st">
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