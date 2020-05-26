<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
<html>

<head>
  
  <meta http-equiv="content-type" content="text/html;charset=UTF-8">
  <title>Dog Lovers - Le site de rencontre pour les amoureux des chiens.</title>
  <link rel="stylesheet" type="text/css" href="./login.css">
  <link rel="shortcut icon" href="./../ressources/favicon.ico"/>
</head>

<body>
<div id="bloc_Register">
  <span> Pas de compte sur Dog Lovers ?</span> <br>
  <a id="creerCompte" title="Créer un compte" href="./../register/register.php">Créer un compte ici !</a>
</div>

<div id="bloc_Login">
    <form accept-charset="UTF-8" action="./verificationConnexion.php" method="post">
        <input name="pseudo" type="text" pattern="[^\s§]+" value="" placeholder="Pseudo" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser \"espace\" et ; ")' oninput="setCustomValidity('')" required /><br>
        <input name="password" type="password" pattern="[^\s§]+" value="" placeholder="Mot de passe" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser \"espace\" et ; ")' oninput="setCustomValidity('')" required /><br>
        <a id="goublie" title="Mot de passe oublié" href="./resetpassword.php">J'ai oublié mon mot de passe.</a> <br>
        <input type="submit" value="Se connecter"></input>
    </form>
    
    <?php
    session_start();
    if((isset($_SESSION['error'])) && ($_SESSION['error']=='error')){
      echo '<span id="loginError"> Identifiant ou mot de passe incorrect.</span>';
      session_unset();
      session_destroy();
    } else if ((isset($_SESSION['logout'])) && ($_SESSION['logout']=='success')) {
      echo '<span id="logoutSuccess">Déconnecté avec succès !</span>';
      session_unset();
      session_destroy();
    }
    session_unset();
    session_destroy();
    ?>
  </div>
  
  </div>
</body>
</html>