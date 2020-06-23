<?php
//on démarre une session
session_start();
//on vérifie que l'utilisateur est bien connectée
if ((isset($_SESSION["login_Type"])) && (intval($_SESSION["login_Type"]) > 0)) { ?>
  <!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
  <html>

  <head>

    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Dog Lovers - Le site de rencontre pour les amoureux des chiens.</title>
    <link rel="stylesheet" type="text/css" href="./messagerieGenerale.css">
    <link rel="shortcut icon" href="./../ressources/favicon.ico" />
  </head>

  <body>
    <!--Début bloc de présentation avec les différents boutons permettant de naviguer entre les pages-->
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

    <form accept-charset="UTF-8" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">

      <div id="textConv">Conversations</div>
      <div id="listeConv">
        <div class="titreConv">
          Retrouvez ici les derniers messages de chaque conversation.
        </div>
        <?php
        //on regarde si l'utilisateur est abonné
        if ($_SESSION["login_Type"] >= 2) {
          //on regarde s'il existe un fichier destinataires pour la personne connectée, cad s'il a déjà écrit à quelqu'un
          if (file_exists('destinataires_' . $_SESSION['pseudo'] . '.txt')) {
            //on récupère le contenu du fichier destinataires_NomDeLaPersonneConnectée.txt
            //ce fichier contient les noms de toutes les personnes à qui la personne connectée a parlé
            $conversation = file_get_contents('destinataires_' . $_SESSION['pseudo'] . '.txt');
            /*on sépare selon les |, cad on stock dans un tableau les noms des différentes personnes
            ainsi par exemple $destinataire[0] sera égale au pseudo de la première personne à qui la personne connectée à parlé.*/
            $destinataire = explode("|", $conversation);
            //on initialise les variables
            //i est la variable qu'on incrémente
            $i = 0;
            //on parcourt tous les noms des destinataires
            while ($i < sizeof($destinataire) - 1) {
              /*on sépare chaque case du tableau selon les _ car les utilisateurs bloqués sont écrit sous la forme:
              pseudo_bloque ainsi on peut récupérer juste le pseudo de la personne sans _bloqué*/
              $destinataireBis = explode("_",$destinataire[$i]);
              //on fait un tableau contenant le pseudo de la personne connectée et celui du destinataire
              $nomFichier = array($_SESSION['pseudo'], $destinataireBis[0]);
              //on les tri par ordre alphabétique
              usort($nomFichier, "strnatcmp");
              //on explode les deux pseudos (celui de la personne connectée et celui du destinataire)
              //afin de récupérer juste le pseudo sans le _bloqué s'il est présent
              $tmpNom = explode("_",$nomFichier[0]);
              $tmpNom2 = explode("_",$nomFichier[1]);
              //on récupère le contenu du fichier nommé pseudo1_pseudo2.txt pseudos 1 et 2
              //correspondant au pseudo de l'utilisateur et a celui du destinataire triés par ordre alphabétique
              //ce fichier contient la conversation entre les deux utilisateurs
              $messages = file_get_contents($tmpNom[0] . '_' . $tmpNom2[0] . '.txt');
              //on sépare selon les lignes pour pouvoir ensuite récupérer seulement le dernier message
              $dernierMessage = explode("\n", $messages);
              //on regarde si le detinataire est bloqué
              if(isset($destinataireBis[1]) && $destinataireBis[1] == "bloqué"){
                //si il est bloqué on écrit pseudoDestinataire est bloqué suivit d'un bouton débloquer pseudoDestinataire
                ?>
                <div class="pseudoMess">
                  <a <?php echo "href='../messagerie/messagerie.php?user=" . $destinataireBis[0] . "'" ?>><?php echo ($destinataireBis[0]) ?></a> est bloqué.
                </div>
                <div class="boutonBloquer">
                  <a <?php echo "href='../messagerie/bloquerUser.php?user=". $destinataireBis[0] ."'"?>>Débloquer <?php echo ($destinataireBis[0] . "<br>"); $_SESSION["BloquerOuDebloquer".$i] = "debloquer"; ?></a>
                </div>
                <?php
                //s'il n'est pas bloqué
              }else{
                //on écrit juste le pseudo du destinataire
                ?>
                <div class="pseudoMess">
                  <a <?php echo "href='../messagerie/messagerie.php?user=" . $destinataireBis[0] . "'" ?>><?php echo ($destinataireBis[0]) ?></a>
                </div>

                <?php
              }
              //ensuite on regarde si il y a un dernier message
              if (isset($dernierMessage[1])) {
                //si c'est le cas on le récupère
                $dernierMessageFlat = explode("§", $dernierMessage[sizeof($dernierMessage) - 2]);
                //et on l'affiche
                echo "<div class='mess'>".($dernierMessageFlat[0])."</div>";
              }
              //si le destinataire n'est pas bloqué
              if(!isset($destinataireBis[1])||($destinataireBis[1] != "bloqué")){
                //on lui donne la possibilté de le bloquer en cliquant sur bouton
                ?>
                <div class="boutonBloquer">
                  <a <?php echo "href='../messagerie/bloquerUser.php?user=". $destinataireBis[0] ."'"?>>Bloquer <?php echo ($destinataireBis[0] . "<br>"); $_SESSION["BloquerOuDebloquer".$i] = "bloquer"; ?></a>
                </div>

                <?php
              }
              //on passe ensuite au destinataire suivant et on refait pareil
              $i++;
              echo "<div class='clear'></div><br>";
            }//fin de la boucle while
            //si le fichier n'existe pas, donc s'il n'a jamais écrit à personne on le lui signal
          } else {
            echo ("<div id='messPasAbo'> Pour démarrer une conversation avec quelqu'un, rendez-vous sur son profil !</div>");
          }
          //s'il n'est pas abonné alors on l'informe qu'il doit s'abonner pour voir ses messages
        } else {
          echo "<div id='messPasAbo'>Vous n'êtes pas abonnés... Pour voir vos messages, veuillez-vous abonner !</div>";
        }
        ?>
      </div>
    </form>
  </body>
 <!-- Footer -->
 <footer id="footer">
      <div class="inner">
        <div class="content">
          <section>
            <h3>Dog Lover</h3>
            <p>Que vous soyez plutôt Bulldog, Caniche ou Labrador, DogLover est l'entremetteur des dresseurs. DogLover est un site de rencontre par affinités, dédié aux célibataires qui recherchent une relation durable et épanouie. L'interaction entre nos célibataires se fait dans un environnement sécurisé. Notre équipe est à votre écoute afin de vous offrir la meilleure expérience possible.</p>
            <br>
          </section>
          <section>
            <h4>Liens</h4>
            <ul class="alt">
              <li><a href="/home/accueil.php">Accueil</a></li>
              <li><a href="/profil/MonProfil.php">Mon Profil</a></li>
              <li><a href="/home/conseils.php">Conseils</a></li>

            </ul>
            <br>
          </section>
          <section>
            <h4>Nous contacter</h4>
            <ul class="plain">
              <li><a href="mailto:staff@dog-lovers.fr"><i class="contact">&nbsp;</i>Contact</a></li>
              <li><a href="https://gitlab.etude.eisti.fr/meetandlove/dog-lovers"><i class="github">&nbsp;</i>Github</a></li>
            </ul>
            <br>
          </section>
        </div>
        <div class="copyright">
          <img src="/ressources/favicon.ico"></img>
          <br>
          &copy; DogLover - Tout droits réservés.
        </div>
      </div>
    </footer>
  </html>
  <?php
  //on libère la variable
  unset($_POST['message']);
  //s'il n'est pa connecté on renvoi à la page d'erreur
} else {
  header("Location: /home/erreur403.php");
}
?>
