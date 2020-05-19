<?php
    session_start();
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

$file = fopen('./../users/users.txt', 'r'); // ouverture du fichier
if ($file) {
    while (($line = fgets($file)) !== false) {
        $student = explode(";", $line);
        if ((password_verify(trim($_POST["password"]),trim($student[sizeof($student)-1]))) && htmlspecialchars((trim($_POST["pseudo"])) == trim($student[sizeof($student)-2]))) {
            
            exit();
        }
    }
    fclose($file);
} else {
    phpAlert("Une erreur est survenue lors de l'accès au site...Veuillez réessayer!");
}
    $_SESSION["error"] = "error";
    header('Location: ./index.php');
