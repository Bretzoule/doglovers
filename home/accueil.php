<?php
session_start();
if ((isset($_SESSION["login_Type"])) && (intval($_SESSION["login_Type"]) > 0)) { ?> 
  <!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
  <html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Dog Lovers - Accueil</title>
    <link rel="stylesheet" type="text/css" href="./accueil.css">
    <link rel="shortcut icon" href="./../ressources/favicon.ico"/>
  </head>

  <body>
    <div id="blocTitre"></div>
    <div id="Titre">
    <img src="/ressources/dogloverslogo.png" alt="logoDogLovers"> 
      <h1>Accueil</h1>
    </div>
    <div class="menu">
      <ul>
        <li><a class="active" href="./accueil.php">Accueil</a></li>
        <li class="deconnexion"><a href="./../login/logout.php">Deconnexion</a></li>
      </ul>
    </div>
    <div id="page">
      <h2 id='titreTab'> Bonjour !</h2>
      <div id="BlocInfo">
        <span id="titreInfo">Hey hey hey hey hey</span> <br>
      </div>
    </div>
  </body>
  </html>
<?php
} else {
  header('Location: ./../errors/erreur403.php');
} 
?>