<?php

/*
Plugin Name: Module HOTspot
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
require("module_hotspot/models.php");

// On inclut ici les paramètres
require("module_hotspot/settings.php");
global $ACTIONS_URL_HOTSPOT;
global $DEFAULT_URL;

// D'abord, on va définir les url que l'on veut récupérer et les lier à une fonction
$actions_mapping = [
    "list_hotspot" => "list_hotspot",
    "create_hotspot" => "create_hotspot",
    "update_hotspot" => "update_hotspot",
    "delete_hotspot" => "delete_hotspot",
];


// Ensuite on définit les fonctions indiquées ci-dessus, 
// on leur donne la base de données en argument pour qu'elles puissent y accéder
function list_hotspot() {
    // Cette fonction aura pour but de lister tous les tests dans ma base de données. 
    // On va donc appeler la fonction dans le modèle permettant de les lister.
    $liste_hotspot = db_list_module_hotspot("hotspot");
    
    // L'intégralité de notre base tests est maintenant stockée dans la variable list_tests
    // On va maintenant "constuire" la page que l'on enverra à l'utilisateur
    require("module_hotspot/views/list_hotspot.php");

    // Maintenant on affiche la vue ainsi générée :
    echo $list_hotspot_view;
}

function create_hotspot() {
    require("module_hotspot/views/create_hotspot.php");
    echo $create_hotspot_view;
}


function update_hotspot(){
    if(!isset($_GET["hotspot_id"])) {
        global $ACTIONS_URL;
        $redirect = $ACTIONS_URL['list'];
        header("Location: $redirect");
    }

    $hotspot = db_get_module_hotspot("hotspot", $_GET["hotspot_id"]);
    require("module_hotspot/views/update_hotspot.php");
    echo $update_hotspot_view; 
}


function delete_hotspot(){
    if(!isset($_GET["hotspot_id"])) {
        global $ACTIONS_URL;
        $redirect = $ACTIONS_URL['list'];
        header("Location: $redirect");
    }

    require("module_hotspot/views/delete_hotspot.php");
    echo $detele_hotspot_view; 
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
let current_url_hotspot = window.location.href;

if(current_url_hotspot === "<?= $ACTIONS_URL_HOTSPOT["base"] ?>"){
    window.location.href = "<?= $DEFAULT_URL ?>"
}

</script>

<?php

?>