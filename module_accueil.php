<?php

/*
Plugin Name: MVC template
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
require("accueil_module/models/model_accueil.php");

// On inclut ici les paramètres
require("accueil_module/settings.php");
global $ACTIONS_URL;
global $DEFAULT_URL;

// D'abord, on va définir les url que l'on veut récupérer et les lier à une fonction
$actions_mapping = [
    "list_accueil" => "list_accueil",
    "create_accueil" => "create_accueil",
    "update_accueil" => "update_accueil",
    "delete_accueil" => "delete_accueil",
];


// Ensuite on définit les fonctions indiquées ci-dessus, 
// on leur donne la base de données en argument pour qu'elles puissent y accéder
function list_accueil() {
    // Cette fonction aura pour but de lister tous les tests dans ma base de données. 
    // On va donc appeler la fonction dans le modèle permettant de les lister.
    $liste_accueil = db_list_accueil();

    // L'intégralité de notre base tests est maintenant stockée dans la variable list_tests
    // On va maintenant "constuire" la page que l'on enverra à l'utilisateur
    require("accueil_module/views/list_accueil.php");

    // Maintenant on affiche la vue ainsi générée :
    echo $list_accueil_view;
}

function create_accueil() {
    require("accueil_module/views/create_accueil.php");
    echo $create_accueil_view;
}


function update_accueil(){
    if(!isset($_GET["accueil_id"])) {
        global $ACTIONS_URL;
        $redirect = $ACTIONS_URL['list'];
        header("Location: $redirect");
    }

    $accueil = db_get_accueil($_GET["accueil_id"]);
    require("accueil_module/views/update_accueil.php");
    echo $update_accueil_view; 
}


function delete_accueil(){
    if(!isset($_GET["accueil_id"])) {
        global $ACTIONS_URL;
        $redirect = $ACTIONS_URL['list'];
        header("Location: $redirect");
    }

    require("accueil_module/views/delete_accueil.php");
    echo $detele_accueil_view; 
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
?>

<script>

// Redirection vers la l'url de base
let current_url_accueil = window.location.href;

if(current_url_accueil === "<?= $ACTIONS_URL["base"] ?>"){
    window.location.href = "<?= $DEFAULT_URL ?>"
}

</script>