<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
<html>

<head>

  <meta http-equiv="content-type" content="text/html;charset=UTF-8">
  <title>Dog Lovers - Le site de rencontre pour les amoureux des chiens.</title>
  <link rel="stylesheet" type="text/css" href="MonProfil.css">
  <link rel="shortcut icon" href="./../ressources/favicon.ico"/>
</head>

<body>
  <div id="blocTitre"></div>
  <div id="Titre">
  <img src="/ressources/dogloverslogo.png" alt="logoDogLovers">
  <h1>Mon Profil</h1>
</div>
<div class="menu">
  <ul>
    <li><a class="active" href="../home/accueil.php">Accueil</a></li>
    <li><a class="active" href="">Infos Publiques</a></li>
    <li class="deconnexion"><a href="./../login/logout.php">Deconnexion</a></li>
  </ul>
</div>
<?php
function afficher ($donneeBis,$i,$j){
  if($donneeBis[$i][$j]==""){
    $afficher = false;
  }else{
    $afficher = true;
  }
  return($afficher);
}
//on récupère les contenus des fichiers prof et élèves
$contenu_du_fichierUserList = file_get_contents('../register/data/userList.txt');
//on met chaque ligne dans un tableau
$nbrUser = explode("\n",$contenu_du_fichierUserList);
$j = 0;
$i = 0;
$fin = false;
//on démarre une session
session_start();
/*on lit le tableau (donc le fichier text ligne par ligne)
jusqu'à ce qu'on ait trouvé un identifiant correspondant
ou jusqu'à la fin du tableau*/
while (($j<count($nbrUser)-1)&&(!$fin)){
  /*on met ce qui est entre les § dans des cases d'un tableau afin de pouvoir
  récupérer les différentes données présentes dans chaque ligne*/
  $donnee = explode("§",$nbrUser[$j]);
  /*on regarde si l'identifiant dans la ligne en cour est le bon*/
  if($donnee[0] == $_SESSION['pseudo']){
    /*si c'est le cas on passe fin a true pour arréter la recherche*/
    $fin = true;

  while (($i<count($donnee)-1)){
    /*on fait un tableau de tableau : on reprend le tableau séparer selon
    les § et on le sépare à nouveaux selon les | on pourra donc
    récupérer les différentes données en faisant $donneeBis[$i][$j]*/
    $donneeBis[$i] = explode("|",$donnee[$i]);
    $i++;
    }
    //Données modifiables :
    ?>
    <div id="Infos">
      <div id="BlocInfo">
        <h2>Photos !</h2>
        <ul>
          <li>Photos : <img  src="<?php echo ($donnee[12]);?>"></img></li>
        </ul>
        <span>Vous pouvez mettre en ligne jusqu'à 4 photos !</span>
        <input type="file" id="photos" name="photos"placeholder="Ajouter une photo" accept="image/png, image/jpeg" multiple/>
      </div>
      <div id="BlocInfo">
        <h2>Informations Générales :</h2>
        <ul>
          <!--On ecrit chaque donnée avec soit donnee[$i] si la donnée de
        contient pas de | soit avec donneeBis[$i][$j] si elle en contient.
      Puis on stock la donnée dans une variable de session pour pouvoir la réutiliser-->
        <li>Pseudo : <?php echo($donnee[0]); $_SESSION["Pseudo"]=$donnee[0]?></li>
<?php if (afficher($donneeBis,1,1)){ ?>
          <li>Lieu de résidence : <?php echo($donnee[1]); $_SESSION["LieuRes"]=$donnee[1];?></li>
<?php } ?>
          <li>Sexe : <?php echo($donnee[2]); $_SESSION["Sexe"]=$donnee[2];?></li>
          <li>Date de naissance : <?php echo($donnee[3]); $_SESSION["DateNaissance"]=$donnee[3];?></li>
<?php if (afficher($donneeBis,4,0)){ ?>
          <li>Profession : <?php echo($donnee[4]); $_SESSION["Profession"]=$donnee[4];?></li>
<?php } ?>
          <li>Situation amoureuse : <?php echo($donneeBis[5][0]); $_SESSION["Situation"]=$donneeBis[5][0];?></li>
          <?php if(($donneeBis[5][1]=="1")||($donneeBis[5][1]=="2")||($donneeBis[5][1]=="3-5")||($donneeBis[5][1]=="5+")){ ?>
          <li>Nombre d'enfants : <?php echo($donneeBis[5][1]); $_SESSION["NbrEnfants"]=$donneeBis[5][1];?></li>
        <?php } ?>
        </ul>
      </div>
      <div id="BlocInfo">
        <h2>Informations physiques :</h2>
        <ul>
          <li>Poids : <?php echo($donneeBis[6][0]); $_SESSION["Poids"]=$donneeBis[6][0];?> kg</li>
          <li>Taille : <?php echo($donneeBis[6][1]); $_SESSION["Taille"]=$donneeBis[6][1];?> cm</li>
          <li>Couleur des cheveux : <?php echo($donneeBis[6][2]); $_SESSION["CouleurCheveux"]=$donneeBis[6][2];?></li>
          <li>Couleur des yeux : <?php echo($donneeBis[6][3]); $_SESSION["CouleurYeux"]=$donneeBis[6][3];?></li>
        </ul>
      </div>
      <div id="BlocInfo">
        <h2>Informations profil :</h2>
        <ul>
          <?php if (afficher($donneeBis,7,0)){ ?>
          <li>Message d'accueil : <?php echo($donnee[7]); $_SESSION["MsgAcc"]=$donnee[7];?></li>
<?php} if (afficher($donneeBis,8,0)){ ?>
          <li>Citation : <?php echo($donnee[8]); $_SESSION["Citation"]=$donnee[8];?></li>
<?php} if (afficher($donneeBis,9,0)){ ?>
          <li>Interets : <?php echo($donnee[9]); $_SESSION["Interets"]=$donnee[9];?></li>
<?php } if($donnee[10]=="on"){ ?>
          <li>Fumeur ? : <?php echo("oui"); $_SESSION["Fumeur"]=$donnee[10];?></li>
        <?php } if(($donnee[11][0]=="1")||($donnee[11][0]=="2")||($donnee[11][0]=="3+")){ ?>
          <li>Nombre de chiens : <?php echo($donneeBis[11][0]); $_SESSION["NombreChiens"]=$donneeBis[11][0];?></li>
          <li>Infos chiens : <?php echo($donneeBis[11][1]); $_SESSION["InfosChiens"]=$donneeBis[11][1];?></li>
<?php } ?>
        </ul>
      </div>
    </div>

    <?php
  }
  //on passe à la ligne suivante
  $j++;
}
?>
</body>
</html>