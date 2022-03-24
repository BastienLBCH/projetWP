<?php

    $ACTIONS_URL = [
        "base" => "http://www.livret-accueil-numerique.fr/page-d-exemple/accueil/",
        "list" => "http://www.livret-accueil-numerique.fr/page-d-exemple/accueil/?action_module=list_accueil",
        "create" => "http://www.livret-accueil-numerique.fr/page-d-exemple/accueil/?action_module=create_accueil",
        "update" => "http://www.livret-accueil-numerique.fr/page-d-exemple/accueil/?action_module=update_accueil&accueil_id=%d",
        "delete" => "http://www.livret-accueil-numerique.fr/page-d-exemple/accueil/?action_module=delete_accueil&accueil_id=%d",
        "database" => "http://www.livret-accueil-numerique.fr/wp-content/plugins/accueil_module/model_accueil.php"
    ];

    $DEFAULT_URL = $ACTIONS_URL["create"];
    $DEFAULT_ACTION_URL = "create_accueil";

?>