<?php

    $ACTIONS_URL_recapitulatif = [
        "base" => "http://www.livret-accueil-numerique.fr/page-d-exemple/recapitulatif/",
        "list" => "http://www.livret-accueil-numerique.fr/page-d-exemple/recapitulatif/?action_module=list_recapitulatif"
    ];

    $DEFAULT_URL = $ACTIONS_URL_recapitulatif["list"];
    $DEFAULT_ACTION_URL = "list_recapitulatif";

    // Définit le dossier dans lequel on va sauvegarder le fichier uploadé
    $DEST_DIRECTORY_recapitulatif_FILES = "/srv/data/web/vhosts/www.livret-accueil-numerique.fr/htdocs/wp-content/plugins/recapitulatif_module/medias/";

    // Base URL pour récupérer les fichiers
    $BASE_URL_recapitulatif_FILES = "www.livret-accueil-numerique.fr/htdocs/wp-content/recapitulatif_module/medias/";
?>
