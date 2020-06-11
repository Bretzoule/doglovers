<?php 
    $typeAbo = $_GET["abonnement"];
    switch ($typeAbo) {
        case '48h':
            addSubscription("P2D");
            $_SESSION["erreurAbo"] = "Merci d'avoir renouvelé votre abonnement de 48h!";
            break;
        case '1mo':
            addSubscription("P1M");
            $_SESSION["erreurAbo"] = "Merci d'avoir renouvelé votre abonnement de 1 mois!";
            break;
        case '6mo':
            addSubscription("P6M");
            $_SESSION["erreurAbo"] = "Merci d'avoir renouvelé votre abonnement de 6 mois!";
            break;
        // case 'cancel':
        //     removeSub();
        // $_SESSION["erreurAbo"] = "Vous avez bien annulé votre abonnement !";
        //     break;
        default:
            $_SESSION["erreurAbo"] = "Erreur lors de la gestion de l'abonnement";
            break;
    }
    header("Location: ./subscribe.php");
?>