<?php

    $ACTIONS_URL_electro = [
        "base" => "http://www.livret-accueil-numerique.fr/livret/electromenager/",
        "list" => "http://www.livret-accueil-numerique.fr/livret/electromenager/?action_module=list_electro",
        "create" => "http://www.livret-accueil-numerique.fr/livret/electromenager/?action_module=create_electro",
        "update" => "http://www.livret-accueil-numerique.fr/livret/electromenager/?action_module=update_electro&electro_id=%d",
        "delete" => "http://www.livret-accueil-numerique.fr/livret/electromenager/?action_module=delete_electro&electro_id=%d",
        "database" => "http://www.livret-accueil-numerique.fr/wp-content/plugins/electromenager_module/models.php"
    ];

    $DEFAULT_URL = $ACTIONS_URL_electro["create"];
    $DEFAULT_ACTION_URL = "create_electro";

    // Définit le dossier dans lequel on va sauvegarder le fichier uploadé
    $DEST_DIRECTORY_electro_FILES = "/srv/data/web/vhosts/www.livret-accueil-numerique.fr/htdocs/wp-content/plugins/electro_module/medias/";

    // Base URL pour récupérer les fichiers
    $BASE_URL_electro_FILES = "www.livret-accueil-numerique.fr/htdocs/wp-content/electro_module/medias/";
?>
