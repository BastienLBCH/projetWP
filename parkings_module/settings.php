<?php

    $ACTIONS_URL_parkings = [
        "base" => "http://www.livret-accueil-numerique.fr/livret/parkings/",
        "list" => "http://www.livret-accueil-numerique.fr/livret/parkings/?action_module=list_parkings",
        "create" => "http://www.livret-accueil-numerique.fr/livret/parkings/?action_module=create_parkings",
        "update" => "http://www.livret-accueil-numerique.fr/livret/parkings/?action_module=update_parkings&parkings_id=%d",
        "delete" => "http://www.livret-accueil-numerique.fr/livret/parkings/?action_module=delete_parkings&parkings_id=%d",
        "database" => "http://www.livret-accueil-numerique.fr/wp-content/plugins/parkings_module/models.php"
    ];

    $DEFAULT_URL = $ACTIONS_URL_parkings["create"];
    $DEFAULT_ACTION_URL = "create_parkings";

    // Définit le dossier dans lequel on va sauvegarder le fichier uploadé
    $DEST_DIRECTORY_FILES = "/srv/data/web/vhosts/www.livret-accueil-numerique.fr/htdocs/wp-content/medias/";

    // Base URL pour récupérer les fichiers
    $BASE_URL_FILES = "http://www.livret-accueil-numerique.fr/wp-content/medias/";
?>