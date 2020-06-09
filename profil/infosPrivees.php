<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
<html>

<head>

  <meta http-equiv="content-type" content="text/html;charset=UTF-8">
  <title>Dog Lovers - Le site de rencontre pour les amoureux des chiens.</title>
  <link rel="stylesheet" type="text/css" href="profil.css">
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
    <li><a class="active" href="./profil.php">Infos Publiques</a></li>
  <li><a class="active" href="">Infos Privées</a></li>
  <li><a class="active" href="./modification.php">Modifier mon profil</a></li>
    <li class="deconnexion"><a href="./../login/logout.php">Deconnexion</a></li>
  </ul>
</div>
<?php
/*Cette fonction permet de vérifier si les données
ont été remplies dans le formulaire*/
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
//on initialise les variables
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
      <h2>Informations privées</h2>
    <ul>
      <li>Nom : <?php echo($donneeBis[16][0]); $_SESSION["Nom"]=$donneeBis[16][0];?></li>
      <li>Prénom : <?php echo($donneeBis[16][1]); $_SESSION["Prénom"]=$donneeBis[16][1];?></li>
      <li>Adresse : <?php echo($donnee[17]); $_SESSION["Adresse"]=$donnee[17];?></li>
    </ul>
  </div>
    <?php
  }
  //on passe à la ligne suivante
  $j++;
}
?>
</body>
