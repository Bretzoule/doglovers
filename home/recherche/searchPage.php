<?php
session_start();
if ((isset($_SESSION["login_Type"])) && (intval($_SESSION["login_Type"]) > 0)) { ?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Dog Lovers - Recherche</title>
    <link rel="stylesheet" type="text/css" href="./searchPage.css">
    <script src="./recherche.js"></script>
    <link rel="shortcut icon" href="./../ressources/favicon.ico" />
  </head>

  <body>
    <div id="blocTitre"></div>
    <div id="Titre">
      <img src="/ressources/dogloverslogo.png" alt="logoDogLovers">
      <h1>Recherche</h1>
    </div>
    <div class="menu">
      <ul>
        <li><a href="/home/accueil.php">Accueil</a></li>
        <li class="deconnexion"><a href="/login/logout.php">Deconnexion</a></li>
        </form>
        </li>
      </ul>
    </div>
    <div id="page">

      <div class="part_recherche">
        <span id="titreInfo">Recherche :</span><br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
          <!-- -->
          <input id="searchbar" name="recherche" type="text" value="<?php if (isset($_GET["recherche"])) { echo htmlspecialchars($_GET["recherche"]);} ?>" placeholder="(Recherche.....)" />
        </form>
      </div>


      <div id="BlocInfo">

      <?php
      $default = "/ressources/logo.png";
      function checkFumeur(string $field): string
      {
        $tmp = "";
        if ($field == "") {
          $tmp = "Non fumeur";
        }
        return $tmp;
      }

      function getDateNaissance(string $date): string
      {
        $dateAnniv = explode("-", $date);
        $dateAjd = explode("-", date("Y-m-d"));
        $age = intval($dateAjd[0]) - intval($dateAnniv[0]);
        if ((intval($dateAjd[1]) < intval($dateAnniv[1]) || ((intval($dateAjd[1])) == intval($dateAnniv[1])) && (intval($dateAjd[2]) < intval($dateAnniv[2])))) {
          $age--;
        }
        return ($age . "ans");
      }

      function addUnits(string $data): string
      {
        $tmp = explode("|",$data);
        $tmp[0] .= "kg";
        $tmp[1] .= "cm";
        $data = implode("|",$tmp);
        return($data);
      }

      if ($_SERVER["REQUEST_METHOD"] == "GET") { {
          $response = "";
          if (!empty($_GET["recherche"])) {
            $elementsRecherche = explode(' ', $_GET["recherche"]); // recup??ration des mots cl??s.
            $file = fopen('./../../register/data/userList.txt', 'r'); // ouverture du fichier
            $data = array();
            $photoArray = array();
            if ($file) {
              while (($line = fgets($file)) !== false) {
                $userData = explode("??", $line);
                $userData[10] = checkFumeur($userData[10]); // permet d'??crire si l'utilisateur fume ou non
                $userData[3] = getDateNaissance($userData[3]); // permet d'??crire l'age de l'utilisateur
                $userData[6] = addUnits($userData[6]); // permet d'ajouter kg et cm
                $tmp = explode("|",$userData[12]);
                array_push($photoArray,$tmp[0]);
                array_push($data, array_slice($userData, 0, sizeof($userData) - 7)); // ajoute l'utilisateur ?? la liste de recherche
              }
              fclose($file);
            } else {
              phpAlert("Une erreur est survenue lors de l'acc??s au site...Veuillez r??essayer!");
            }
            $usercount = 0; // compteur pour le num??ro de l'utilisateur dans la liste de recherche
            foreach ($data as $utilisateur) {
              foreach ($elementsRecherche as $keyword) {
                if (!empty($keyword)) {
                  $found = false;
                  $i = 0;
                  while ($i < sizeof($utilisateur) && !$found && (strpos($response, $utilisateur[0]) === false)) { // permet de v??rifier tout les donn??es de l'utilisateur
                    if (stristr($utilisateur[$i], $keyword)) { // , tant que rien de coh??rent n'a ??t?? trouv?? et que l'utilisateur ne matche pas d??j?? avec un keyword
                      $link = (empty($photoArray[$usercount])) ? $default : $photoArray[$usercount];
                      $response .= '<div class="divUtilisateur"><a href="/profil/profil.php?user=' . $utilisateur[0] . '"><img alt="image utilisateur" src="'. $link .'"></a><br>' . $utilisateur[0] .'</div>'; // ajoute l'utilisateur aux r??sultats
                      $found = true;
                    }
                    $i++;
                  }
                }
              }
              $usercount++;
            }
          }
          if ($response == "") {
            $response = "Aucun r??sultat.";
          }
        }
        echo $response;
      }
      ?>
      </div>
    </div>
  </body>
 <!-- Footer -->
 <footer id="footer">
      <div class="inner">
        <div class="content">
          <section>
            <h3>Dog Lovers</h3>
            <p>Que vous soyez plut??t Bulldog, Caniche ou Labrador, DogLovers est l'entremetteur des dresseurs. DogLovers est un site de rencontre par affinit??s, d??di?? aux c??libataires qui recherchent une relation durable et ??panouie. L'interaction entre nos c??libataires se fait dans un environnement s??curis??. Notre ??quipe est ?? votre ??coute afin de vous offrir la meilleure exp??rience possible.</p>
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
          &copy; DogLovers - Tout droits r??serv??s.
        </div>
      </div>
    </footer>
  </html>
<?php
} else {
  header('Location: ./../errors/erreur403.php');
}
?>
