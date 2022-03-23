<?php

    $ACTIONS_URL_HOTSPOT = [
        "list" => "http://www.livret-accueil-numerique.fr/wifi-hotspot-2/?action_module=list_hotspot",
        "create" => "http://www.livret-accueil-numerique.fr/wifi-hotspot-2/?action_module=create_hotspot",
        "update" => "http://www.livret-accueil-numerique.fr/wifi-hotspot-2/?action_module=update_hotspot&hotspot_id=%d",
        "delete" => "http://www.livret-accueil-numerique.fr/wifi-hotspot-2/?action_module=delete_hotspot&hotspot_id=%d",
        "database" => "http://www.livret-accueil-numerique.fr/wp-content/plugins/module_hotspot/models.php"
    ];

    $DEFAULT_URL = $ACTIONS_URL["list"];
    $DEFAULT_ACTION_URL = "list_hotspot";

    // Définit le dossier dans lequel on va sauvegarder le fichier uploadé
    $DEST_DIRECTORY_FILES = "/srv/data/web/vhosts/www.livret-accueil-numerique.fr/htdocs/wp-content/medias/";

    // Base URL pour récupérer les fichiers
    $BASE_URL_FILES = "http://www.livret-accueil-numerique.fr/wp-content/medias/";
?>