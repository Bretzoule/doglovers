<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
<html>

<head>

  <meta http-equiv="content-type" content="text/html;charset=UTF-8">
  <title>Dog Lovers - Le site de rencontre pour les amoureux des chiens.</title>
  <link rel="stylesheet" type="text/css" href="./login.css">
  <link rel="shortcut icon" href="./../ressources/favicon.ico"/>
</head>

<body>
  <div id="bloc_colonne">
    <div class="Colonne">
    <div id="bloc_Image">
      <img src="/ressources/dogloverslogo.png" alt="logo"></img>
    </div>
  </div>
  <div id="bloc_placement">
    <div id="bloc_Register">
    <span> Pas de compte sur Dog Lovers ?</span> <br>
    <a id="creerCompte" title="Créer un compte" href="./../register/register.php">Créer un compte ici !</a>
    </div>
<div id="bloc_Connexion">
<input type="button" class="boutonSpoiler" value="Se connecter" onclick="changeVisibility('bloc_Login')"></input>
<script type="text/javascript">
function changeVisibility(docID) {
    fields = document.getElementById(docID)
    if (fields.style.display == "block") {
        fields.style.display = "none";
} else {
        fields.style.display = "block";
    }
}
</script>
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
</div>
<div id="bloc_Noms">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>

<script type="text/javascript">
   $(function(){
      setInterval(function(){
         $(".slideshow ul").animate({marginLeft:-200},800,function(){
            $(this).css({marginLeft:0}).find("li:last").after($(this).find("li:first"));
         })
      }, 3500);
   });
</script>
  <div class="slideshow">

  <ul>

    <li><div class="Colonne">Nom 1<img src="/ressources/dogloverslogo.png" alt="Nom 1" width="200" height="200" /></div></li>
    <li><div class="Colonne">Nom 2<img src="/ressources/dogloverslogo.png" alt="" width="200" height="200" /></div></li>
		<li><div class="Colonne">Nom 3<img src="/ressources/dogloverslogo.png" alt="" width="200" height="200" /></div></li>
		<li><div class="Colonne">Nom 4<img src="/ressources/dogloverslogo.png" alt="" width="200" height="200" /></div></li>

  </ul>

</div>

<!--
  <div class="Colonne"><img src="/ressources/dogloverslogo.png" alt="">Nom 1</img></div>
<div class="Colonne"><img src="/ressources/dogloverslogo.png" alt="">Nom 2</img></div>
<div class="Colonne"><img src="/ressources/dogloverslogo.png" alt="">Nom 3</img></div>
<div class="Colonne"><img src="/ressources/dogloverslogo.png" alt="">Nom 4</img></div>
-->
</div>


</div>
</body>
</html>
