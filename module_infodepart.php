<?php

/*
Plugin Name: Module info départ
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
require("infodepart_module/models.php");

// On inclut ici les paramètres
require("infodepart_module/settings.php");

global $ACTIONS_URL_infodepart;
global $DEFAULT_URL;
// D'abord, on va définir les url que l'on veut récupérer et les lier à une fonction
$actions_mapping = [
    "list_infodepart" => "list_infodepart",
    "create_infodepart" => "create_infodepart",
    "update_infodepart" => "update_infodepart",
    "delete_infodepart" => "delete_infodepart",
];


// Ensuite on définit les fonctions indiquées ci-dessus, 
// on leur donne la base de données en argument pour qu'elles puissent y accéder
function list_infodepart() {
    // Cette fonction aura pour but de lister tous les tests dans ma base de données. 
    // On va donc appeler la fonction dans le modèle permettant de les lister.
    $liste_infodepart = db_list_module_infodepart("infodepart");
    
    // L'intégralité de notre base tests est maintenant stockée dans la variable list_tests
    // On va maintenant "constuire" la page que l'on enverra à l'utilisateur
    require("infodepart_module/views/list_infodepart.php");

    // Maintenant on affiche la vue ainsi générée :
    echo $list_infodepart_view;
}

function create_infodepart() {
    require("infodepart_module/views/create_infodepart.php");
     echo $create_infodepart_view;
}


function update_infodepart(){
    if(!isset($_GET["infodepart_id"])) {
        global $ACTIONS_URL;
        $redirect = $ACTIONS_URL['list'];
        header("Location: $redirect");
    }

    $infodepart = db_get_module_infodepart("infodepart", $_GET["infodepart_id"]);
    require("infodepart_module/views/update_infodepart.php");
    echo $update_infodepart_view; 
}


function delete_infodepart(){
    if(!isset($_GET["infodepart_id"])) {
        global $ACTIONS_URL;
        $redirect = $ACTIONS_URL['list'];
        header("Location: $redirect");
    }

    require("infodepart_module/views/delete_infodepart.php");
    echo $detele_infodepart_view; 
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
let current_url_infodepart = window.location.href;

if(current_url_infodepart === "<?= $ACTIONS_URL_infodepart["base"] ?>"){
    window.location.href = "<?= $DEFAULT_URL ?>"
}

</script>

<?php

?>