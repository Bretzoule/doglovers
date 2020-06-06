<?php 
session_start();

function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

if (isset($_SESSION["passworded"]) && ($_SESSION["passworded"] == "true")) {
    $path = "./../register/data/userList.txt";
    $file = fopen($path, 'r');
    if ($file) {
        $lastvalue = true;
        while ((($line = fgets($file)) !== false) && $lastvalue) {
            $userData = explode("§", $line);
            echo "|" . trim($_SESSION["adresseM"]) . "| == |" . trim($userData[sizeof($userData)-2]) . "| <br>";
            if ((trim($_SESSION["adresseM"]) == trim($userData[1]))) {
                $contents = file_get_contents($path);
                $userData[sizeof($userData)-1] = password_hash($_SESSION['Newpassword'],PASSWORD_DEFAULT);
                $userData = implode("§",$userData);
                $contents = str_replace($line,$userData,$contents);
                file_put_contents($path, $contents);
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
    header("Location: ./resetPassword.php");
} else {
    header("Location: /errors/erreur403.php");
}
?>