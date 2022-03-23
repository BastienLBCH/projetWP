<?php

    $ACTIONS_URL_reglementinterieur = [
        "list" => "http://www.livret-accueil-numerique.fr/reglementinterieur/?action_module=list_reglementinterieur",
        "create" => "http://www.livret-accueil-numerique.fr/reglementinterieur/?action_module=create_reglementinterieur",
        "update" => "http://www.livret-accueil-numerique.fr/reglementinterieur/?action_module=update_reglementinterieur&reglementinterieur_id=%d",
        "delete" => "http://www.livret-accueil-numerique.fr/reglementinterieur/?action_module=delete_reglementinterieur&reglementinterieur_id=%d",
        "database" => "http://www.livret-accueil-numerique.fr/wp-content/plugins/reglementinterieur_module/models.php"
    ];

    $DEFAULT_URL = $ACTIONS_URL["list"];
    $DEFAULT_ACTION_URL = "list_reglementinterieur";

    // Définit le dossier dans lequel on va sauvegarder le fichier uploadé
    $DEST_DIRECTORY_FILES = "/srv/data/web/vhosts/www.livret-accueil-numerique.fr/htdocs/wp-content/medias/";

    // Base URL pour récupérer les fichiers
    $BASE_URL_FILES = "http://www.livret-accueil-numerique.fr/wp-content/medias/";
?>