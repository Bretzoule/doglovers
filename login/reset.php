<?php 
session_start();
if (isset($_SESSION["passworded"]) && ($_SESSION["passworded"] == "true")) {

    $file = fopen('./../register/data/userList.txt', 'r');
    if ($file) {
        $lastvalue = true;
        while ((($line = fgets($file)) !== false) && $lastvalue) {
            $userData = explode("§", $line);
            //echo "|" . trim($_SESSION["adresse"]) . "| == |" . trim($userData[1]) . "|";
            if ((trim($_SESSION["adresseM"]) == trim($userData[1]))) {
                $contents = file_get_contents($file);
                $userData[sizeof($userData)-1] = password_hash($_SESSION['Newpassword'],PASSWORD_DEFAULT);
                $userData = implode("§",$userData);
                $contents = str_replace($line,$userData,$contents);
                file_put_contents($file, $contents);
                $lastvalue = false;
            }
        }
        fclose($file);
    } else {
        phpAlert("Une erreur est survenue lors de l'accès au site...Veuillez réessayer!");
    }
    session_unset();
    session_destroy();
    session_start();
    if ($lastvalue) {
        $_SESSION["erreur"] = "badMail";
    } else {
        $_SESSION["erreur"] = "resetConfirmed";
    }
    header("Location: /login/resetPassword.php");
} else {
    header("Location: /errors/erreur403.php");
}
?>