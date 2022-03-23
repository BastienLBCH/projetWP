<?php

/*
Plugin Name: Module electro
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
require("electromenager_module/models.php");

// On inclut ici les paramètres
require("electromenager_module/settings.php");


// D'abord, on va définir les url que l'on veut récupérer et les lier à une fonction
$actions_mapping = [
    "list_electro" => "list_electro",
    "create_electro" => "create_electro",
    "update_electro" => "update_electro",
    "delete_electro" => "delete_electro",
];


// Ensuite on définit les fonctions indiquées ci-dessus, 
// on leur donne la base de données en argument pour qu'elles puissent y accéder
function list_electro() {
    // Cette fonction aura pour but de lister tous les tests dans ma base de données. 
    // On va donc appeler la fonction dans le modèle permettant de les lister.
    $liste_electro = db_list_module_electro("electromenage");
    
    // L'intégralité de notre base tests est maintenant stockée dans la variable list_tests
    // On va maintenant "constuire" la page que l'on enverra à l'utilisateur
    require("electromenager_module/views/list_electro.php");

    // Maintenant on affiche la vue ainsi générée :
    echo $list_electro_view;
}

function create_electro() {
    require("electromenager_module/views/create_electro.php");
    echo $create_electro_view;
}


function update_electro(){
    if(!isset($_GET["electro_id"])) {
        global $ACTIONS_URL_electro;
        $redirect = $ACTIONS_URL_electro['list'];
        header("Location: $redirect");
    }

    $electro = db_get_module_electro("electromenage", $_GET["electro_id"]);
    require("electromenager_module/views/update_electro.php");
    echo $update_electro_view; 
}


function delete_electro(){
    if(!isset($_GET["electro_id"])) {
        global $ACTIONS_URL_electro;
        $redirect = $ACTIONS_URL_electro['list'];
        header("Location: $redirect");
    }

    require("electromenager_module/views/delete_electro.php");
    echo $detele_electro_view; 
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
