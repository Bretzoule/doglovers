    <?php
    //on démarre une session
    session_start();

    function removeEntryFromDestinataires($fileDestPath, $user)
    {
        $data = file_get_contents($fileDestPath);
        $data = explode("|",$data);
        foreach ($data as $subUser) {
            if ($user == $subUser) {
                $subUser = "";
            }
        }
        $data = implode("|",$data);
        file_put_contents($fileDestPath,$data);
    }

    if ((isset($_SESSION["login_Type"])) && (intval($_SESSION["login_Type"]) > 0)) {
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["user"])) {
            echo "yee";
            $user = trim($_GET["user"]);
            $nomFichier = array($user,trim($_SESSION['pseudo']));
            //on les tri par ordre alphabétique
            usort($nomFichier, "strnatcmp");
            $fileName = $nomFichier[0] . '_' . $nomFichier[1] . '.txt';
            if (file_exists($fileName)) {
                unlink($fileName);
            }
            $fileDestPath = 'destinataires_' . trim($_SESSION['pseudo']) . '.txt';
            removeEntryFromDestinataires($fileDestPath,$user);
        }
    } 
        //header("Location: /home/accueil.php");
    ?>