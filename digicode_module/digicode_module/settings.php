<?php

    $ACTIONS_URL_digicode = [
        "base" => "http://www.livret-accueil-numerique.fr/page-d-exemple/digicode/",
        "list" => "http://www.livret-accueil-numerique.fr/page-d-exemple/digicode/?action_module=list_digicode",
        "create" => "http://www.livret-accueil-numerique.fr/page-d-exemple/digicode/?action_module=create_digicode",
        "update" => "http://www.livret-accueil-numerique.fr/page-d-exemple/digicode/?action_module=update_digicode&digicode_id=%d",
        "delete" => "http://www.livret-accueil-numerique.fr/page-d-exemple/digicode/?action_module=delete_digicode&digicode_id=%d",
        "database" => "http://www.livret-accueil-numerique.fr/wp-content/plugins/digicode_module/model_digicode.php"
    ];

    $DEFAULT_URL = $ACTIONS_URL_digicode["create"];
    $DEFAULT_ACTION_URL = "create_digicode";

?>