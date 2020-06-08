<?php
session_start();
if (!(isset($_SESSION["login_Type"])) || $_SESSION["logout"] == "success") { ?>
<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
<html>

  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Dog Lovers - Le site de rencontre pour les amoureux des chiens.</title>
    <link rel="stylesheet" type="text/css" href="./login.css">
    <link rel="shortcut icon" href="./../ressources/favicon.ico"/> <!--??-->
  </head>

  <body>

    <div id="part_logo"> <!--Partie logo-->
      <img src="./../ressources/logoBis.png" alt="logoBis" class="rounded-corners"></img>
    </div> <!--Fin partie logo-->



    <div id="part_centre"> <!--Partie centrale-->

      <div class="header_part_centre">
        Voici la liste de nos derniers inscrits :
      </div>

      <div id="bloc_Noms"> <!--Bloc slide image-->

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

        <div class="slideshow"> <!--liste des images-->
          <ul>
            <li><div class="Colonne">Nom 1<img src="/ressources/dogloverslogo.png" alt="Nom 1" width="200" height="200" /></div></li>
            <li><div class="Colonne">Nom 2<img src="/ressources/dogloverslogo.png" alt="Nom 2" width="200" height="200" /></div></li>
  		      <li><div class="Colonne">Nom 3<img src="/ressources/dogloverslogo.png" alt="Nom 3" width="200" height="200" /></div></li>
            <li><div class="Colonne">Nom 4<img src="/ressources/dogloverslogo.png" alt="Nom 4" width="200" height="200" /></div></li>
          </ul>
        </div><!--fin liste images-->

      </div> <!--Fin bloc slide image-->



      <div id="bloc_sign"> <!--Bloc connexion/inscription-->

        <input type="radio" name="r" id="r1" checked> <!--Reliés à la navigation-->
        <input type="radio" name="r" id="r2">

        <div class="slideshow2"> <!--Partie slide connexion/inscription-->

          <div class="slides"> <!--bloc contenant toutes les slides-->

            <div class="slide s1"> <!--slide connexion-->

              <div class="slide1_ecrit"> <!--partie écrit-->
                <div class="slide1_ecrit_msg">
                  Vous avez déjà un compte ?<br><br>
                  Connectez-vous !
                </div>

                <div class="mess_err_deco"><!--message d'erreur ou déconnexion-->
                  <?php
                  if((isset($_SESSION['error'])) && ($_SESSION['error']=='error')){
                    echo '<div id="loginError"> Identifiant ou mot de passe incorrect.</div>';
                    session_unset();
                    session_destroy();
                  } else if ((isset($_SESSION['logout'])) && ($_SESSION['logout']=='success')) {
                    echo '<div id="logoutSuccess">Déconnecté avec succès !</div>';
                    session_unset();
                    session_destroy();
                  }
                  ?>
                </div><!--fin message d'erreur ou déconnexion-->

              </div><!--fin partie écrit-->

              <div class="slide1_signin"><!--partie connexion-->
                <form accept-charset="UTF-8" action="./verificationConnexion.php" method="post">
                  <input name="pseudo" type="text" pattern="[^\s§]+" value="" placeholder="Pseudo" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser \"espace\" et ; ")' oninput="setCustomValidity('')" required /><br>
                  <input name="password" type="password" pattern="[^\s§]+" value="" placeholder="Mot de passe" oninvalid='setCustomValidity("Champ obligatoire - Merci de ne pas utiliser \"espace\" et ; ")' oninput="setCustomValidity('')" required /><br>
                  <a id="goublie" title="Mot de passe oublié" href="./resetPw/resetpassword.php">J'ai oublié mon mot de passe.</a> <br>
                  <input type="submit" id="buttonSignin" value="Se connecter"></input>
                </form>


              </div> <!--fin partie connexion-->

            </div> <!--fin slide connexion-->



            <div class="slide"> <!--slide inscription-->

              <div class="slide2_ecrit"> <!--partie écrit-->
                Vous n'avez pas encore<br>
                de compte ?
              </div> <!--fin partie écrit-->

              <div class="slide2_inscription"> <!--partie inscription-->
                Créez votre compte
                <form action="./../register/register.php">
                  <input type="submit" id="buttonSignup" value="ICI"></input>
                </form>

              </div> <!--fin partie inscription-->

            </div> <!--fin slide inscription-->

          </div> <!--fin du bloc contenant toutes les slides-->

        </div> <!--Fin partie slide connexion/inscription-->

        <div class="navigation"> <!--Navigation-->
          <label for="r1" class="bar b1"></label>
          <label for="r2" class="bar b2"></label>
        </div> <!--Fin navigation-->

      </div><!--Fin bloc connexion/inscription-->

    </div> <!--Fin partie centrale-->

  </body>

</html>
<?php
} else {
  header('Location: ./../home/accueil.php');
} ?>