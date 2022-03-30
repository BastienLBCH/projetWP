<?php

/*
Plugin Name: Module poubelles
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
require("poubelles_module/models.php");

// On inclut ici les paramètres
require("poubelles_module/settings.php");
global $ACTIONS_URL_poubelles;
global $DEFAULT_URL;

// D'abord, on va définir les url que l'on veut récupérer et les lier à une fonction
$actions_mapping = [
    "list_poubelles" => "list_poubelles",
    "create_poubelles" => "create_poubelles",
    "update_poubelles" => "update_poubelles",
    "delete_poubelles" => "delete_poubelles",
];


// Ensuite on définit les fonctions indiquées ci-dessus, 
// on leur donne la base de données en argument pour qu'elles puissent y accéder
function list_poubelles() {
    // Cette fonction aura pour but de lister tous les tests dans ma base de données. 
    // On va donc appeler la fonction dans le modèle permettant de les lister.
    $liste_poubelles = db_list_module_poubelles("poubelles");
    
    // L'intégralité de notre base tests est maintenant stockée dans la variable list_tests
    // On va maintenant "constuire" la page que l'on enverra à l'utilisateur
    require("poubelles_module/views/list_poubelles.php");

    // Maintenant on affiche la vue ainsi générée :
    echo $list_poubelles_view;
}

function create_poubelles() {
    require("poubelles_module/views/create_poubelles.php");
     echo $create_poubelles_view;
}


function update_poubelles(){
    if(!isset($_GET["poubelles_id"])) {
        global $ACTIONS_URL;
        $redirect = $ACTIONS_URL['list'];
        header("Location: $redirect");
    }

    $poubelles = db_get_module_poubelles("poubelles", $_GET["poubelles_id"]);
    require("poubelles_module/views/update_poubelles.php");
    echo $update_poubelles_view; 
}


function delete_poubelles(){
    if(!isset($_GET["poubelles_id"])) {
        global $ACTIONS_URL;
        $redirect = $ACTIONS_URL['list'];
        header("Location: $redirect");
    }

    require("poubelles_module/views/delete_poubelles.php");
    echo $detele_poubelles_view; 
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
let current_url_poubelles = window.location.href;

if(current_url_poubelles === "<?= $ACTIONS_URL_poubelles["base"] ?>"){
    window.location.href = "<?= $DEFAULT_URL ?>"
}

</script>

