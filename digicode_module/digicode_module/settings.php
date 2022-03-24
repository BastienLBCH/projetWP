<?php

    $ACTIONS_URL_digicode = [
        "list" => "http://www.livret-accueil-numerique.fr/digicode/?action_module=list_digicode",
        "create" => "http://www.livret-accueil-numerique.fr/digicode/?action_module=create_digicode",
        "update" => "http://www.livret-accueil-numerique.fr/digicode/?action_module=update_digicode&digicode_id=%d",
        "delete" => "http://www.livret-accueil-numerique.fr/digicode/?action_module=delete_digicode&digicode_id=%d",
        "database" => "http://www.livret-accueil-numerique.fr/wp-content/plugins/digicode_module/models/model_digicode.php"
    ];

    $DEFAULT_URL = $ACTIONS_URL_digicode["list"];
    $DEFAULT_ACTION_URL = "list_digicode";
?>