<?php

    $ACTIONS_URL = [
        "list" => "http://www.livret-accueil-numerique.fr/test/?action_module=list_accueil",
        "create" => "http://www.livret-accueil-numerique.fr/test/?action_module=create_accueil",
        "update" => "http://www.livret-accueil-numerique.fr/test/?action_module=update_accueil&accueil_id=%d",
        "delete" => "http://www.livret-accueil-numerique.fr/test/?action_module=delete_accueil&accueil_id=%d",
        "database" => "http://www.livret-accueil-numerique.fr/wp-content/plugins/accueil_module/models/model_accueil.php"
    ];

    $DEFAULT_URL = $ACTIONS_URL["list"];
    $DEFAULT_ACTION_URL = "list_accueil";
?>