<?php

    $ACTIONS_URL_WIFI = [
        "list" => "http://www.livret-accueil-numerique.fr/wifi-hotspot-2/?action_module=list_wifi",
        "create" => "http://www.livret-accueil-numerique.fr/wifi-hotspot-2/?action_module=create_wifi",
        "update" => "http://www.livret-accueil-numerique.fr/wifi-hotspot-2/?action_module=update_wifi&wifi_id=%d",
        "delete" => "http://www.livret-accueil-numerique.fr/wifi-hotspot-2/?action_module=delete_wifi&wifi_id=%d",
        "database" => "http://www.livret-accueil-numerique.fr/wp-content/plugins/models.php"
    ];

    $DEFAULT_URL = $ACTIONS_URL["list"];
    $DEFAULT_ACTION_URL = "list_wifi";

    // Définit le dossier dans lequel on va sauvegarder le fichier uploadé
    $DEST_DIRECTORY_WIFI_FILES = "/srv/data/web/vhosts/www.livret-accueil-numerique.fr/htdocs/wp-content/plugins/wifi_module/medias/";

    // Base URL pour récupérer les fichiers
    $BASE_URL_WIFI_FILES = "www.livret-accueil-numerique.fr/htdocs/wp-content/wifi_module/medias/";
?>