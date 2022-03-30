<?php

    $ACTIONS_URL_NUMEROUTILS = [
        "base" => "http://www.livret-accueil-numerique.fr/livret/numero-utiles/",
        "list" => "http://www.livret-accueil-numerique.fr/livret/numero-utiles/?action_module=list_numeroutile",
        "create" => "http://www.livret-accueil-numerique.fr/livret/numero-utiles/?action_module=create_numeroutile",
        "update" => "http://www.livret-accueil-numerique.fr/livret/numero-utiles/?action_module=update_numeroutile&numeroutile_id=%d",
        "delete" => "http://www.livret-accueil-numerique.fr/livret/numero-utiles/?action_module=delete_numeroutile&numeroutile_id=%d",
        "database" => "http://www.livret-accueil-numerique.fr/wp-content/plugins/numeroutile_module/models/model_numeroutile.php"
    ];

    $DEFAULT_URL = $ACTIONS_URL_NUMEROUTILS["create"];
    $DEFAULT_ACTION_URL = "create_numeroutile";
?>