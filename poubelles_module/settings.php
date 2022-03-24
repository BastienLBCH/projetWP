<?php

    $ACTIONS_URL_poubelles = [
        "list" => "http://www.livret-accueil-numerique.fr/poubelles/?action_module=list_poubelles",
        "create" => "http://www.livret-accueil-numerique.fr/poubelles/?action_module=create_poubelles",
        "update" => "http://www.livret-accueil-numerique.fr/poubelles/?action_module=update_poubelles&poubelles_id=%d",
        "delete" => "http://www.livret-accueil-numerique.fr/poubelles/?action_module=delete_poubelles&poubelles_id=%d",
        "database" => "http://www.livret-accueil-numerique.fr/wp-content/plugins/poubelles_module/models.php"
    ];

    $DEFAULT_URL = $ACTIONS_URL["list"];
    $DEFAULT_ACTION_URL = "list_poubelles";

    // Définit le dossier dans lequel on va sauvegarder le fichier uploadé
    $DEST_DIRECTORY_FILES = "/srv/data/web/vhosts/www.livret-accueil-numerique.fr/htdocs/wp-content/medias/";

    // Base URL pour récupérer les fichiers
    $BASE_URL_FILES = "http://www.livret-accueil-numerique.fr/wp-content/medias/";
?>