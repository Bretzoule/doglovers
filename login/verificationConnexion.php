<?php
    session_start();
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

function getMemberShipType($memberShipString) {
    $infoMS = explode(":",$memberShipString);
    if ($infoMS[0] = "free") {
        return "free";
    } else {
        if (date("Y-m-d") > $infoMS[1]) {
            return "free";
        } else {
            return "member";
        }
    }
}

$file = fopen('./../register/userList.txt', 'r'); // ouverture du fichier
if ($file) {
    while (($line = fgets($file)) !== false) {
        $userData = explode(";", $line);
        if ((password_verify(trim($_POST["password"]),trim($userData[sizeof($userData)-1])) && (trim($_POST["pseudo"]) == trim($userData[sizeof($userData)-2])))) {
            $_SESSION["udata"] = array();
            $_SESSION["udata"] = array_slice($userData,0,sizeof($userData)-2);
            $_SESSION["login_Type"] = getMemberShipType($_SESSION["udata"][sizeof($userData)-5]);
            header('Location: ./../home/accueil.php');
            fclose($file);
            exit();
        }
    }
    fclose($file);
} else {
    phpAlert("Une erreur est survenue lors de l'accès au site...Veuillez réessayer!");
}
$file = fopen('./../register/adminList.txt', 'r'); // ouverture du fichier
if ($file) {
    while (($line = fgets($file)) !== false) {
        $userData = explode(";", $line);
        if ((password_verify(trim($_POST["password"]),trim($userData[sizeof($userData)-1])) && (trim($_POST["pseudo"]) == trim($userData[sizeof($userData)-2])))) {
            $_SESSION["udata"] = array();
            $_SESSION["udata"] = array_slice($userData,0,sizeof($userData)-2);
            $_SESSION["login_Type"] = "admin";
            header('Location: ./../home/accueil.php');
            fclose($file);
            exit();
        }
    }
    fclose($file);
} else {
    phpAlert("Une erreur est survenue lors de l'accès au site...Veuillez réessayer!");
}
    $_SESSION["error"] = "error";
    header('Location: ./index.php');
