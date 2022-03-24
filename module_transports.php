<?php

/*
Plugin Name: Module transports
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
require("transports_module/models.php");

// On inclut ici les paramètres
require("transports_module/settings.php");


// D'abord, on va définir les url que l'on veut récupérer et les lier à une fonction
$actions_mapping = [
    "list_transports" => "list_transports",
    "create_transports" => "create_transports",
    "update_transports" => "update_transports",
    "delete_transports" => "delete_transports",
];


// Ensuite on définit les fonctions indiquées ci-dessus, 
// on leur donne la base de données en argument pour qu'elles puissent y accéder
function list_transports() {
    // Cette fonction aura pour but de lister tous les tests dans ma base de données. 
    // On va donc appeler la fonction dans le modèle permettant de les lister.
    $liste_transports = db_list_module_transports("transports");
    
    // L'intégralité de notre base tests est maintenant stockée dans la variable list_tests
    // On va maintenant "constuire" la page que l'on enverra à l'utilisateur
    require("transports_module/views/list_transports.php");

    // Maintenant on affiche la vue ainsi générée :
    echo $list_transports_view;
}

function create_transports() {
    require("transports_module/views/create_transports.php");
     echo $create_transports_view;
}


function update_transports(){
    if(!isset($_GET["transports_id"])) {
        global $ACTIONS_URL;
        $redirect = $ACTIONS_URL['list'];
        header("Location: $redirect");
    }

    $transports = db_get_module_transports("transports", $_GET["transports_id"]);
    require("transports_module/views/update_transports.php");
    echo $update_transports_view; 
}


function delete_transports(){
    if(!isset($_GET["transports_id"])) {
        global $ACTIONS_URL;
        $redirect = $ACTIONS_URL['list'];
        header("Location: $redirect");
    }

    require("transports_module/views/delete_transports.php");
    echo $detele_transports_view; 
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
