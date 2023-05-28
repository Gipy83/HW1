<?php
require_once 'search_session.php';

if (checkSession() != 0) {
    header("Location: home.php");
    exit;
}

if (!empty($_POST["username"]) && !empty($_POST["password"])) {
    # USERNAME
    if (preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
        $conn = Connect();
        $username = mysqli_real_escape_string($conn, $_POST['username']);

        $query = "SELECT U.*, A.icon FROM (User U JOIN Avatar A on U.image = A.id) WHERE username = '$username'";
        $res = mysqli_query($conn, $query);
        if (mysqli_num_rows($res) > 0) {
            # PASSWORD
            if (strlen($_POST["password"]) < 8) {
                $error[] = "La password deve contenere almeno 8 caratteri";
            } else {
                $entry = mysqli_fetch_assoc($res);
                if (password_verify($_POST['password'], $entry['password'])) {
                    $_SESSION["username"] = $entry['username'];
                    $_SESSION["user_id"] = $entry['id'];
                    $_SESSION["icon"] = $entry['icon'];
                    header("Location: home.php");
                    mysqli_free_result($res);
                    mysqli_close($conn);
                    exit;
                } else {
                    $error[] = "La password e' errata";
                }
            }
        } else {
            $error[] = "Username inesistente";
        }
    } else {
        $error[] = "Username non valido";
    }

}
?>


<!DOCTYPE html>
<html>

<head>
    <title>PokeTeam</title>
    <link rel="stylesheet" href="./SignIn.css">
    <script src="./Login.js" defer></script>
</head>

<body id="bd">
    <section id="st">

        <div id="overlay">
            <article id="art">
                <div>
                    <div class="title_box">
                        <div class="title">
                            <h1>L</h1>
                            <div class="poke_box">
                                <img src="./image/SVG/pokeball.svg" class="pokeball">
                            </div>
                            <h1>gin</h1>
                        </div>
                    </div>

                    <form type="submit" method='post' autocomplete="off" id="parameters">
                        <div class="box username">
                            <p>
                                <label>Username</label>
                                <input type="text" name="username" placeholder="Username">
                            </p>
                            <div class="error hidden">
                                <img src="./image/SVG/x-circle-fill.svg">
                                <span class="error-text">Parametro mancante</span>
                            </div>
                        </div>
                        <div class="box password">
                            <p>
                                <label>Password</label>
                                <input type="password" name="password" placeholder="Password">
                            </p>
                            <div class="error hidden">
                                <img src="./image/SVG/x-circle-fill.svg">
                                <span class="error-text">Parametro mancante</span>
                            </div>
                        </div>

                        <div class="error-form hidden">
                            <img src="./image/SVG/x-circle-fill.svg">
                            <span class="error-text">Inserisci tutti i parametri</span>
                        </div>
                        <?php if (isset($error)) {
                            foreach ($error as $err) {
                                echo "<div class='errorj'><img src='./image/SVG/x-circle-fill.svg'><span class='error-text'>" . $err . "</span></div>";
                            }
                        } ?>
                        <button id="btn">Confirm</button>
                        <span>Non hai ancora un account? <span><a href="./SignIn.php">Registrati</a>
                    </form>
                </div>
                <a href="./home.php" class="exit"><img src="./image/SVG/x-square.svg"></a>
            </article>
        </div>
    </section>
</body>

</html>