<?php

/*
Plugin Name: Module Wifi
Plugin URI: no uri
Description: Simple mvc template
Author: Marie
Version: 1.0
Author URI: no uri
*/

/*
    ### Ce fichier est censé récupérer les url et agir en conséquence. ###
*/



// On inclut ici le modèle qui permettra de récupérer la liste des fichiers de test
require("models.php");

// On inclut ici les paramètres
require("wifi_module/settings.php");


// D'abord, on va définir les url que l'on veut récupérer et les lier à une fonction
$actions_mapping = [
    "list_wifi" => "list_wifi",
    "create_wifi" => "create_wifi",
    "update_wifi" => "update_wifi",
    "delete_wifi" => "delete_wifi",
];


// Ensuite on définit les fonctions indiquées ci-dessus, 
// on leur donne la base de données en argument pour qu'elles puissent y accéder
function list_wifi() {
    // Cette fonction aura pour but de lister tous les tests dans ma base de données. 
    // On va donc appeler la fonction dans le modèle permettant de les lister.
    $liste_wifi = db_list_module("wifi");
    
    // L'intégralité de notre base tests est maintenant stockée dans la variable list_tests
    // On va maintenant "constuire" la page que l'on enverra à l'utilisateur
    require("wifi_module/views/list_wifi.php");

    // Maintenant on affiche la vue ainsi générée :
    echo $list_wifi_view;
}

function create_wifi() {
    require("wifi_module/views/create_wifi.php");
     echo $create_wifi_view;
}


function update_wifi(){
    if(!isset($_GET["wifi_id"])) {
        global $ACTIONS_URL;
        $redirect = $ACTIONS_URL['list'];
        header("Location: $redirect");
    }

    $wifi = db_get_module("wifi", $_GET["wifi_id"]);
    require("wifi_module/views/update_wifi.php");
    echo $update_wifi_view; 
}


function delete_wifi(){
    if(!isset($_GET["wifi_id"])) {
        global $ACTIONS_URL;
        $redirect = $ACTIONS_URL['list'];
        header("Location: $redirect");
    }

    require("wifi_module/views/delete_wifi.php");
    echo $detele_wifi_view; 
}


// ### Ici, on va maintenant récupérer la variable dans l'URL et déclancher la fonction correspondante :
// Variable que l'on attend dans l'url
$variable_url = "action_module";


// On vérifie que la variable est présente dans l'URL 
if(isset($_GET[$variable_url])){
    $action_url = $_GET[$variable_url];
    // On vérifie que la variable est présente dans le tableau
    // que l'on a déclaré au début du fichier
    if(array_key_exists($action_url, $actions_mapping)){
        // Si oui, on execute la fonction correspondante
        $actions_mapping[$action_url]();
    }
}
