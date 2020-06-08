<?php
session_start();
if ((isset($_SESSION["login_Type"])) && (intval($_SESSION["login_Type"]) > 0)) { ?>
  <!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1−strict.dtd">
  <html>

  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Dog Lovers - Accueil</title>
    <link rel="stylesheet" type="text/css" href="./accueil.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./recherche/recherche.js"></script>
    <link rel="shortcut icon" href="./../ressources/favicon.ico" />
  </head>

  <body>
    <div id="blocTitre"></div>
    <div id="Titre">
      <img src="/ressources/dogloverslogo.png" alt="logoDogLovers">
      <h1>Accueil</h1>
    </div>
    <script>
      function showResult(str) {
        if (str.length == 0) {
          document.getElementById("resultats").innerHTML = "";
          document.getElementById("resultats").style.border = "0px";
          return;
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("resultats").innerHTML = this.responseText;
            document.getElementById("resultats").style.background = "#A5ACB2";
            document.getElementById("resultats").style.paddingLeft = "0";
          }
        }
        xmlhttp.open("GET", "./recherche/recherche.php?recherche=" + str, true);
        xmlhttp.send();
      }
    </script>
    <div class="menu">
      <ul>
        <li><a class="active" href="./accueil.php">Accueil</a></li>
        <li class="deconnexion"><a href="./../login/logout.php">Deconnexion</a></li>
        <li class="formulaireee">
          <form action="./recherche/searchPage.php" method="get"><input class="searchbar" name="recherche" type="text" value="" onkeyup="showResult(this.value)" placeholder="(Recherche.....)" />
          <div id="resultats"></div>
          </form>
        </li>
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