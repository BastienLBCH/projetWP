<?php

    $ACTIONS_URL_HOTSPOT = [
        "base" => "http://www.livret-accueil-numerique.fr/page-d-exemple/hotspot/",
        "list" => "http://www.livret-accueil-numerique.fr/page-d-exemple/hotspot/?action_module=list_hotspot",
        "create" => "http://www.livret-accueil-numerique.fr/page-d-exemple/hotspot/?action_module=create_hotspot",
        "update" => "http://www.livret-accueil-numerique.fr/page-d-exemple/hotspot/?action_module=update_hotspot&hotspot_id=%d",
        "delete" => "http://www.livret-accueil-numerique.fr/page-d-exemple/hotspot/?action_module=delete_hotspot&hotspot_id=%d",
        "database" => "http://www.livret-accueil-numerique.fr/wp-content/plugins/module_hotspot/models.php"
    ];

    $DEFAULT_URL = $ACTIONS_URL_HOTSPOT["create"];
    $DEFAULT_ACTION_URL = "create_hotspot";

    // Définit le dossier dans lequel on va sauvegarder le fichier uploadé
    $DEST_DIRECTORY_FILES = "/srv/data/web/vhosts/www.livret-accueil-numerique.fr/htdocs/wp-content/medias/";

    // Base URL pour récupérer les fichiers
    $BASE_URL_FILES = "http://www.livret-accueil-numerique.fr/wp-content/medias/";
?>