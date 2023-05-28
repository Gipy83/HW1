<?php
    require_once 'search_session.php';

    if (checkSession() != 0) {
        header("Location: home.php");
        exit;
    }
    
    
    if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["name"]) && 
        !empty($_POST["surname"]) && !empty($_POST["confirm_password"]))
    {
        $error = array();
        $conn = Connect();

        
        # USERNAME
        if(preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                
                $query = "SELECT username FROM User WHERE username = '$username'";
                $res = mysqli_query($conn, $query);
                if (mysqli_num_rows($res) > 0) {
                    $error[] = "Username già preso";
                }
            } else {
                $error[] = "Username non valido";
        }

        # PASSWORD
        if (strlen($_POST["password"]) < 8) {
            $error[] = "La password deve contenere almeno 8 caratteri";
        } 

        # CONFERMA PASSWORD
        if (strcmp($_POST["password"], $_POST["confirm_password"]) != 0) {
            $error[] = "Le password sono diverse";
        }

        # EMAIL
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT email FROM User WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Esiste già un account con questa email";
            }
        }


        # REGISTRAZIONE NEL DATABASE
        if (count($error) == 0) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $surname = mysqli_real_escape_string($conn, $_POST['surname']);

            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO User(username, password, nome, cognome, email, image) VALUES('$username', '$password', '$name', '$surname', '$email', 5)";
            
            if (mysqli_query($conn, $query)) {
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["icon"] = "account"; 
                $_SESSION["user_id"] = mysqli_insert_id($conn);
                mysqli_close($conn);
                header("Location: home.php");
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }

        mysqli_close($conn);
    }
?>





<!DOCTYPE html>
<html>
    <head>
        <title>PokeTeam</title>
        <link rel="icon" type="image/png" href="./image/rand/Cover_copy.jpg">
        <link rel="stylesheet" href="./SignIn.css">
        <script src="./SignIn.js" defer></script>
    </head>

    <body id="bd">
        <section id="st">

            <div id="overlay">
                <article id="art">
                    <div>
                    <div class="title_box">
                        <h1>Sign In</h1>
                    </div>

                    <form type="submit" method='post' autocomplete="off" id="parameters">
                        <div class="box username">
                            <p>
                                <label>Username</label>
                                <input name="username" type="text" placeholder="Username"
                                    <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
                            </p>
                            <div class="error hidden">
                                <img src="./image/SVG/check-circle-fill.svg" class="hidden">
                                <img src="./image/SVG/x-circle-fill.svg">
                                <span class="error-text"></span>  
                            </div>
                        </div>

                        <div class="box name"> 
                            <p>
                                <label>Name</label>
                                <input name="name" type="text" placeholder="Nome" 
                                    <?php if(isset($_POST["name"])){echo "value=".$_POST["name"];}?>>
                            </p>
                            <div class="error hidden">
                                <img src="./image/SVG/x-circle-fill.svg">
                                <span  class="error-text"></span>  
                            </div>
                        </div>

                        <div class="box surname">
                            <p>
                                <label>Surname</label>
                                <input name="surname" type="text" placeholder="Cognome"
                                    <?php if(isset($_POST["surname"])){echo "value=".$_POST["surname"];} ?>>
                            </p>
                            <div class="error hidden">
                                <img src="./image/SVG/x-circle-fill.svg">
                                <span class="error-text"></span>  
                            </div>
                        </div>

                        <div class="box email">
                            <p>
                                <label>@</label>
                                <input name="email" type="email" placeholder="E-mail"
                                <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>>
                            </p>
                            <div class="error hidden">
                                <img src="./image/SVG/check-circle-fill.svg" class="hidden true">
                                <img src="./image/SVG/x-circle-fill.svg">
                                <span class="error-text"></span>  
                            </div>
                        </div>

                        <div class="box password">
                            <p>
                                <label>Password</label>
                                <input name="password" type="password" placeholder="Password"
                                    <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                            </p>
                            <div class="error hidden">
                                <img src="./image/SVG/x-circle-fill.svg">
                                <span class="error-text"></span>  
                            </div>
                        </div>

                        <div class="box confirm_password">
                            <p>
                                <label title="Confirm Password" class="animated"><span> Confirm Password </span></label>
                                <input name="confirm_password" type="password" placeholder="Conferma"
                                    <?php if(isset($_POST["confirm_password"])){echo "value=".$_POST["confirm_password"];} ?>>
                            </p>
                            <div class="error hidden">
                                <img src="./image/SVG/x-circle-fill.svg">
                                <span class="error-text"></span>  
                            </div>
                        </div>
                        <?php if(isset($error)) {
                            foreach($error as $err) {
                                echo "<div class='errorj'><img src='./image/SVG'/x-circle-fill.svg><span>".$err."</span></div>";
                            }
                        } ?>

                        <div class="error-form hidden">
                            <img src="./image/SVG/x-circle-fill.svg">
                            <span class="error-text">Inserisci tutti i parametri</span>  
                        </div>

                        <button id="btn">Confirm</button>

                        <span>Hai gia' un account? <span><a href="./Login.php">Accedi</a>
                    </form>
                    </div>
                    <a href="./home.php" class="exit"><img src="./image/SVG/x-square.svg"></a>
                </article>

            </div>


        </section>



    </body>


</html>