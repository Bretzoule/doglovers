<?php
session_start();
if ((isset($_SESSION["login_Type"])) && (intval($_SESSION["login_Type"]) > 0)) { ?>
    <!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
    <html>

    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <title>Dog Lovers - Recherche</title>
        <link rel="stylesheet" type="text/css" href="./modificationPw.css">
        <link rel="shortcut icon" href="./../ressources/favicon.ico" />
    </head>
    <body>
    <div id="bloc_Image_reset">
    <a href="./MonProfil.php"><img id="bloc_ImageTitre" src="/ressources/logoBis.png" alt="logo"></img></a>
            <div id="oubliage">
                    
            </div>
        </div>
    </body>
    </html>
<?php
} else {
    header('Location: ./../errors/erreur403.php');
}
?>