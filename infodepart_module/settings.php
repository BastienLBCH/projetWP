<?php

    $ACTIONS_URL_infodepart = [
        "list" => "http://www.livret-accueil-numerique.fr/infodepart/?action_module=list_infodepart",
        "create" => "http://www.livret-accueil-numerique.fr/infodepart/?action_module=create_infodepart",
        "update" => "http://www.livret-accueil-numerique.fr/infodepart/?action_module=update_infodepart&infodepart_id=%d",
        "delete" => "http://www.livret-accueil-numerique.fr/infodepart/?action_module=delete_infodepart&infodepart_id=%d",
        "database" => "http://www.livret-accueil-numerique.fr/wp-content/plugins/infodepart_module/models.php"
    ];

    $DEFAULT_URL = $ACTIONS_URL["list"];
    $DEFAULT_ACTION_URL = "list_infodepart";

    // Définit le dossier dans lequel on va sauvegarder le fichier uploadé
    $DEST_DIRECTORY_FILES = "/srv/data/web/vhosts/www.livret-accueil-numerique.fr/htdocs/wp-content/medias/";

    // Base URL pour récupérer les fichiers
    $BASE_URL_FILES = "http://www.livret-accueil-numerique.fr/wp-content/medias/";
?>