<?php

/*
Plugin Name: MVC template Numéro Utile
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
require("numeroutile_module/models/model_numeroutile.php");


// On inclut ici les paramètres
require("module_numeroutile/settings.php");


// D'abord, on va définir les url que l'on veut récupérer et les lier à une fonction
$actions_mapping = [
    "list_numeroutile" => "list_numeroutile",
    "create_numeroutile" => "create_numeroutile",
    "update_numeroutile" => "update_numeroutile",
    "delete_numeroutile" => "delete_numeroutile",
];


// Ensuite on définit les fonctions indiquées ci-dessus, 
// on leur donne la base de données en argument pour qu'elles puissent y accéder
function list_numeroutile() {
    // Cette fonction aura pour but de lister tous les tests dans ma base de données. 
    // On va donc appeler la fonction dans le modèle permettant de les lister.
    $liste_numeroutile = db_list_numeroutile();

    // L'intégralité de notre base tests est maintenant stockée dans la variable list_tests
    // On va maintenant "constuire" la page que l'on enverra à l'utilisateur
    require("numeroutile_module/views/list_numeroutile.php");

    // Maintenant on affiche la vue ainsi générée :
    echo $list_numeroutile_view;
}


function create_numeroutile() {
    require("numeroutile_module/views/create_numeroutile.php");
    echo $create_numeroutile_view;
}


function update_numeroutile(){
    if(!isset($_GET["numeroutile_id"])) {
        global $ACTIONS_URL;
        $redirect = $ACTIONS_URL['list'];
        header("Location: $redirect");
    }

    $numeroutile = db_get_numeroutile($_GET["numeroutile_id"]);
    require("numeroutile_module/views/update_numeroutile.php");
     echo $update_numeroutile_view; 
}


function delete_numeroutile(){
    if(!isset($_GET["numeroutile_id"])) {
        global $ACTIONS_URL;
        $redirect = $ACTIONS_URL['list'];
        header("Location: $redirect");
    }

    require("numeroutile_module/views/delete_numeroutile.php");
     echo $detele_numeroutile_view; 
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
