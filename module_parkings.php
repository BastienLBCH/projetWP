<?php

/*
Plugin Name: Module parkings
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
require("parkings_module/models.php");

// On inclut ici les paramètres
require("parkings_module/settings.php");

global $ACTIONS_URL_parkings;
global $DEFAULT_URL;
// D'abord, on va définir les url que l'on veut récupérer et les lier à une fonction
$actions_mapping = [
    "list_parkings" => "list_parkings",
    "create_parkings" => "create_parkings",
    "update_parkings" => "update_parkings",
    "delete_parkings" => "delete_parkings",
];


// Ensuite on définit les fonctions indiquées ci-dessus, 
// on leur donne la base de données en argument pour qu'elles puissent y accéder
function list_parkings() {
    // Cette fonction aura pour but de lister tous les tests dans ma base de données. 
    // On va donc appeler la fonction dans le modèle permettant de les lister.
    $liste_parkings = db_list_module_parkings("parkings");
    
    // L'intégralité de notre base tests est maintenant stockée dans la variable list_tests
    // On va maintenant "constuire" la page que l'on enverra à l'utilisateur
    require("parkings_module/views/list_parkings.php");

    // Maintenant on affiche la vue ainsi générée :
    echo $list_parkings_view;
}

function create_parkings() {
    require("parkings_module/views/create_parkings.php");
     echo $create_parkings_view;
}


function update_parkings(){
    if(!isset($_GET["parkings_id"])) {
        global $ACTIONS_URL;
        $redirect = $ACTIONS_URL['list'];
        header("Location: $redirect");
    }

    $parkings = db_get_module_parkings("parkings", $_GET["parkings_id"]);
    require("parkings_module/views/update_parkings.php");
    echo $update_parkings_view; 
}


function delete_parkings(){
    if(!isset($_GET["parkings_id"])) {
        global $ACTIONS_URL;
        $redirect = $ACTIONS_URL['list'];
        header("Location: $redirect");
    }

    require("parkings_module/views/delete_parkings.php");
    echo $detele_parkings_view; 
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
let current_url_parkings = window.location.href;

if(current_url_parkings === "<?= $ACTIONS_URL_parkings["base"] ?>"){
    window.location.href = "<?= $DEFAULT_URL ?>"
}

</script>

<?php

?>