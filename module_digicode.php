<?php

/*
Plugin Name: MVC template Digicode
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
require("digicode_module/models.php");

// On inclut ici les paramètres
require("digicode_module/settings.php");

global $ACTIONS_URL_digicode;
global $DEFAULT_URL;

// D'abord, on va définir les url que l'on veut récupérer et les lier à une fonction
$actions_mapping = [
    "list_digicode" => "list_digicode",
    "create_digicode" => "create_digicode",
    "update_digicode" => "update_digicode",
    "delete_digicode" => "delete_digicode",
];


// Ensuite on définit les fonctions indiquées ci-dessus, 
// on leur donne la base de données en argument pour qu'elles puissent y accéder
function list_digicode() {
    // Cette fonction aura pour but de lister tous les tests dans ma base de données. 
    // On va donc appeler la fonction dans le modèle permettant de les lister.
    $liste_digicode = db_list_module_digicode("digicode");

    // L'intégralité de notre base tests est maintenant stockée dans la variable list_tests
    // On va maintenant "constuire" la page que l'on enverra à l'utilisateur
    require("digicode_module/views/list_digicode.php");

    // Maintenant on affiche la vue ainsi générée :
    echo $list_digicode_view;
}

function create_digicode() {
    require("digicode_module/views/create_digicode.php");
    echo $create_digicode_view;
}


function update_digicode(){
    if(!isset($_GET["digicode_id"])) {
        global $ACTIONS_URL_digicode;
        $redirect = $ACTIONS_URL_digicode['list'];
        header("Location: $redirect");
    }

    $digicode = db_get_module_digicode("digicode", $_GET["digicode_id"]);
    require("digicode_module/views/update_digicode.php");
    echo $update_digicode_view; 
}


function delete_digicode(){
    if(!isset($_GET["digicode_id"])) {
        global $ACTIONS_URL_digicode;
        $redirect = $ACTIONS_URL_digicode['list'];
        header("Location: $redirect");
    }

    require("digicode_module/views/delete_digicode.php");
    echo $detele_digicode_view; 
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
let current_url_digicode = window.location.href;

if(current_url_digicode === "<?= $ACTIONS_URL_digicode["base"] ?>"){
    window.location.href = "<?= $DEFAULT_URL ?>"
}

</script>

<?php

?>