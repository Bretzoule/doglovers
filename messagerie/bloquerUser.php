<?php
//on démarre une session
session_start();
//on vérifie que l'utilisateur est abonné sinon il ne peut pas regarder ses messages
if ((isset($_SESSION["login_Type"])) && (intval($_SESSION["login_Type"]) >= 2)) { ?>
  <!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
  <html>

  <head>

    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Dog Lovers - Le site de rencontre pour les amoureux des chiens.</title>
    <link rel="stylesheet" type="text/css" href="./messagerieGenerale.css">
    <link rel="shortcut icon" href="./../ressources/favicon.ico" />
    <script type="text/javascript" src="messagerie.js"></script>
  </head>
  <body>
    <!--Début bloc de présentation-->
    <div id="blocTitre"></div>
    <div id="Titre">
      <img src="/ressources/dogloverslogo.png" alt="logoDogLovers">
      <h1>Messagerie de <?php echo ($_SESSION["pseudo"]); ?></h1>
    </div>
    <div class="menu">
      <ul>
        <li><a href="../home/accueil.php">Accueil</a></li>
        <li><a class="active" href="">Conversations</a></li>
        <li class="deconnexion"><a href="./../login/logout.php">Deconnexion</a></li>
      </ul>
    </div>
    <!--Fin bloc de présentation-->

    <?php
    //on récupère le nom de l'utilisateur que l'on veut bloquer par la méthode GET
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["user"])) {
      //on stock la valeur dans une variable nomée user
      //trim permet de supprimer les espaces s'il y en a
      $user = trim($_GET["user"]);
      //on récupère le contenu du fichier destinataires_NomDeLaPersonneConnectée.txt
      //ce fichier contient les noms de toutes les personnes à qui la personne connectée a parlé
      $destinataire = file_get_contents('destinataires_'.$_SESSION['pseudo'].'.txt');
      /*on sépare selon les |, cad on stock dans un tableau les noms des différentes personnes
      ainsi par exemple $destinataireBis[0] sera égale au pseudo de la première personne à qui la personne connectée à parlé.*/
      $destinataireBis = explode('|',$destinataire);
      //on initialise les variables
      //i est la variable qu'on incrémente
      $i = 0;
      /*cette variable permet d'arreter la boucle une fois que l'on a trouvé
      le nom de l'utilisateur que l'on veut bloquer*/
      $destinataireTrouve = false;
      //on parcourt les noms des destinataires jusqu'à la fin du fichier ou jusqu'a ce que le nom voulu soit trouvé
      while(($i < sizeOf($destinataireBis)-1) && !$destinataireTrouve){
        /*on sépare chaque case du tableau selon les _ car les utilisateurs bloqués sont écrit sous la forme:
        pseudo_bloque */
        $destinataireAutre = explode("_",$destinataireBis[$i]);
        //on récupère donc juste le pseudo sans le bloque si il est présent
        //on regarde si le nom correspond a celui du destinataire que l'on veut bloquer
        if($destinataireAutre[0]==$user){
          //si c'est le cas on passe $destinataireTrouve à vrai pour arreter la recherche
          $destinataireTrouve = true;
          //on regarde si on a cliqué sur bloquer ou sur debloquer
          if ($_SESSION['BloquerOuDebloquer'.$i]=="bloquer") {
            //si on a cliqué sur bloquer on rajoute bloqué au nom de l'utilisateur
            $destinataireAutre[1] = "bloqué";
            //on rassemble les cases afin d'obtenir pseudo_bloqué
            $destinataireBis[$i] = implode("_",$destinataireAutre);
            //si on a cliqué sur debloquer
          }else{
            //on enlève "bloqué" et on le remplace par rien
            $destinataireAutre[1] = "";
            //on rassemble on aure donc juste le pseudo sans _ et sans "bloqué"
            $destinataireBis[$i] = implode("",$destinataireAutre);
          }//fin du else
        }//fin du if qui compare le nom dans le fichier a celui voulut
        $i++;
      }//fin du while
      /*on rassemble les cases de $destinataireBis en les séparant par des | on aura donc par exemple
      pseudo_bloqué|pseudo2|pseudo3|pseudo4_bloqué*/
      $donnee = implode("|",$destinataireBis);
      //on met le tout dans le fichier qui contient les noms des destinataires de la personne connectée
      file_put_contents('destinataires_'.$_SESSION['pseudo'].'.txt',$donnee);
      //enfin on renvoi à la page de messagerie (l'utilisateur ne voit donc pas le passage par cette page)
      header("Location: /messagerie/messagerieGenerale.php");
    }
    ?>

  </body>
  </html>
  <?php
  //on libère la variable
  unset($_SESSION['BloquerOuDebloquer']);
  //si l'utilisateur n'est pas abonné on renvoi une erreur
} else {
  header("Location: /home/erreur403.php");
}
?>
