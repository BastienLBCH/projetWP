<?php

/*
Plugin Name: Module info arrivee
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
require("infoarrivee_module/models.php");

// On inclut ici les paramètres
require("infoarrivee_module/settings.php");

global $ACTIONS_URL_infoarrivee;
global $DEFAULT_URL;
// D'abord, on va définir les url que l'on veut récupérer et les lier à une fonction
$actions_mapping = [
    "list_infoarrivee" => "list_infoarrivee",
    "create_infoarrivee" => "create_infoarrivee",
    "update_infoarrivee" => "update_infoarrivee",
    "delete_infoarrivee" => "delete_infoarrivee",
];


// Ensuite on définit les fonctions indiquées ci-dessus, 
// on leur donne la base de données en argument pour qu'elles puissent y accéder
function list_infoarrivee() {
    // Cette fonction aura pour but de lister tous les tests dans ma base de données. 
    // On va donc appeler la fonction dans le modèle permettant de les lister.
    $liste_infoarrivee = db_list_module_infoarrivee("infoarrivee");
    
    // L'intégralité de notre base tests est maintenant stockée dans la variable list_tests
    // On va maintenant "constuire" la page que l'on enverra à l'utilisateur
    require("infoarrivee_module/views/list_infoarrivee.php");

    // Maintenant on affiche la vue ainsi générée :
    echo $list_infoarrivee_view;
}

function create_infoarrivee() {
    require("infoarrivee_module/views/create_infoarrivee.php");
     echo $create_infoarrivee_view;
}


function update_infoarrivee(){
    if(!isset($_GET["infoarrivee_id"])) {
        global $ACTIONS_URL;
        $redirect = $ACTIONS_URL['list'];
        header("Location: $redirect");
    }

    $infoarrivee = db_get_module_infoarrivee("infoarrivee", $_GET["infoarrivee_id"]);
    require("infoarrivee_module/views/update_infoarrivee.php");
    echo $update_infoarrivee_view; 
}


function delete_infoarrivee(){
    if(!isset($_GET["infoarrivee_id"])) {
        global $ACTIONS_URL;
        $redirect = $ACTIONS_URL['list'];
        header("Location: $redirect");
    }

    require("infoarrivee_module/views/delete_infoarrivee.php");
    echo $detele_infoarrivee_view; 
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
let current_url_infoarrive = window.location.href;

if(current_url_infoarrive === "<?= $ACTIONS_URL_infoarrivee["base"] ?>"){
    window.location.href = "<?= $DEFAULT_URL ?>"
}

</script>