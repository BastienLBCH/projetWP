<?php

    $ACTIONS_URL_infoarrivee = [
        "list" => "http://www.livret-accueil-numerique.fr/infoarrivee/?action_module=list_infoarrivee",
        "create" => "http://www.livret-accueil-numerique.fr/infoarrivee/?action_module=create_infoarrivee",
        "update" => "http://www.livret-accueil-numerique.fr/infoarrivee/?action_module=update_infoarrivee&infoarrivee_id=%d",
        "delete" => "http://www.livret-accueil-numerique.fr/infoarrivee/?action_module=delete_infoarrivee&infoarrivee_id=%d",
        "database" => "http://www.livret-accueil-numerique.fr/wp-content/plugins/infoarrivee_module/models.php"
    ];

    $DEFAULT_URL = $ACTIONS_URL["list"];
    $DEFAULT_ACTION_URL = "list_infoarrivee";

    // Définit le dossier dans lequel on va sauvegarder le fichier uploadé
    $DEST_DIRECTORY_FILES = "/srv/data/web/vhosts/www.livret-accueil-numerique.fr/htdocs/wp-content/medias/";

    // Base URL pour récupérer les fichiers
    $BASE_URL_FILES = "http://www.livret-accueil-numerique.fr/wp-content/medias/";
?>