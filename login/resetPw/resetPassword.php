<?php
session_start();
if (!(isset($_SESSION["login_Type"]))) { ?>
    <!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
    <html>

    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>Dog Lovers - Le site de rencontre pour les amoureux des chiens.</title>
        <link rel="stylesheet" type="text/css" href="./reset.css">
        <link rel="shortcut icon" href="./../ressources/favicon.ico" />
    </head>
    <?php
    
    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $_SESSION["adresseM"] = $_SESSION["passworded"] = $_SESSION["Newpassword"] = $erreurAdresseM = $erreurNewPassword = "";

    $adresseOk = $NewpasswordOk = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["adresseM"])) {
        $erreurAdresseM = "Le champ adresse est requis";
    } else {
        $adresseOk = true;
        $_SESSION["adresseM"] = test_input($_POST["adresseM"]);
        if (!preg_match("/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/", $_SESSION["adresseM"])) {
            $erreurAdresseM = "L'adresse mail est invalide.";
            $adresseOk = false;
        }
    }
    if (empty($_POST["Newpassword"])) {
        $erreurNewPassword = "Le champ nouveau mot de passe est requis";
    } else {
        $NewpasswordOk = "true";
        $_SESSION["Newpassword"] = test_input($_POST["Newpassword"]);
        if (!preg_match("/[^§\s]+/", $_SESSION["Newpassword"])) {
            $erreurNewPassword = "Le mot de passe est invalide.";
            $NewpasswordOk = false;
        }
    }
    if ($adresseOk && $NewpasswordOk) {
        $_SESSION["passworded"] = "true";
        header("Location: /login/resetPw/reset.php");
    }
}
    ?>

    <body>
        <div id="bloc_Image_reset">
            <img src="/ressources/dogloverslogo.png" alt="logo"></img>
            <div id="oubliage">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="password">Adresse Mail</label><br>
                    <input name="adresseM" type="text" pattern="[^\s§]+" value="" placeholder="Adresse Mail" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser \"espace\" et ; ")' oninput="setCustomValidity('')" required /> <br>
                    <span> <?php echo $erreurAdresseM ?></span> <br>
                    <label for="password">Mot de Passe</label><br>
                    <input name="Newpassword" type="password" pattern="[^\s§]+" value="" placeholder="Nouveau mot de passe" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser \"espace\" et § ")' oninput="setCustomValidity('')" required /> <br>
                    <span> <?php echo $erreurNewPassword ?></span> <br>

                    <input type="submit" value="Réinitialiser"></input>
                </form>
                <span><?php
                        if (isset($_SESSION["erreur"]) &&  $_SESSION["erreur"] == "badMail") {
                            echo "Adresse Mail inconnue.";
                            unset($_SESSION["erreur"]);
                        } else if (isset($_SESSION["erreur"]) &&  $_SESSION["erreur"] == "resetConfirmed") {
                            echo "Mot de passe réinitialisé!.";
                            unset($_SESSION["erreur"]);
                        }
                        ?></span>
            </div>
        </div>
    </body>

    </html>
<?php
} else
    header("Location: /errors/erreur403.php")
?>