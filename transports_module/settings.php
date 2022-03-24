<?php

    $ACTIONS_URL_transports = [
        "base" => "http://www.livret-accueil-numerique.fr/page-d-exemple/transports/",
        "list" => "http://www.livret-accueil-numerique.fr/page-d-exemple/transports/?action_module=list_transports",
        "create" => "http://www.livret-accueil-numerique.fr/page-d-exemple/transports/?action_module=create_transports",
        "update" => "http://www.livret-accueil-numerique.fr/page-d-exemple/transports/?action_module=update_transports&transports_id=%d",
        "delete" => "http://www.livret-accueil-numerique.fr/page-d-exemple/transports/?action_module=delete_transports&transports_id=%d",
        "database" => "http://www.livret-accueil-numerique.fr/wp-content/plugins/transports_module/models.php"
    ];

    $DEFAULT_URL = $ACTIONS_URL_transports["create"];
    $DEFAULT_ACTION_URL = "create_transports";

    // Définit le dossier dans lequel on va sauvegarder le fichier uploadé
    $DEST_DIRECTORY_FILES = "/srv/data/web/vhosts/www.livret-accueil-numerique.fr/htdocs/wp-content/medias/";

    // Base URL pour récupérer les fichiers
    $BASE_URL_FILES = "http://www.livret-accueil-numerique.fr/wp-content/medias/";
?>