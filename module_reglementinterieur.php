<?php

/*
Plugin Name: Module Règlement intérieur
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
require("reglementinterieur_module/models.php");

// On inclut ici les paramètres
require("reglementinterieur_module/settings.php");

global $ACTIONS_URL_reglementinterieur;
global $DEFAULT_URL;
// D'abord, on va définir les url que l'on veut récupérer et les lier à une fonction
$actions_mapping = [
    "list_reglementinterieur" => "list_reglementinterieur",
    "create_reglementinterieur" => "create_reglementinterieur",
    "update_reglementinterieur" => "update_reglementinterieur",
    "delete_reglementinterieur" => "delete_reglementinterieur",
];


// Ensuite on définit les fonctions indiquées ci-dessus, 
// on leur donne la base de données en argument pour qu'elles puissent y accéder
function list_reglementinterieur() {
    // Cette fonction aura pour but de lister tous les tests dans ma base de données. 
    // On va donc appeler la fonction dans le modèle permettant de les lister.
    $liste_reglementinterieur = db_list_module_reglementinterieur("reglementinterieur");
    
    // L'intégralité de notre base tests est maintenant stockée dans la variable list_tests
    // On va maintenant "constuire" la page que l'on enverra à l'utilisateur
    require("reglementinterieur_module/views/list_reglementinterieur.php");

    // Maintenant on affiche la vue ainsi générée :
    echo $list_reglementinterieur_view;
}

function create_reglementinterieur() {
    require("reglementinterieur_module/views/create_reglementinterieur.php");
     echo $create_reglementinterieur_view;
}


function update_reglementinterieur(){
    if(!isset($_GET["reglementinterieur_id"])) {
        global $ACTIONS_URL;
        $redirect = $ACTIONS_URL['list'];
        header("Location: $redirect");
    }

    $reglementinterieur = db_get_module_reglementinterieur("reglementinterieur", $_GET["reglementinterieur_id"]);
    require("reglementinterieur_module/views/update_reglementinterieur.php");
    echo $update_reglementinterieur_view; 
}


function delete_reglementinterieur(){
    if(!isset($_GET["reglementinterieur_id"])) {
        global $ACTIONS_URL;
        $redirect = $ACTIONS_URL['list'];
        header("Location: $redirect");
    }

    require("reglementinterieur_module/views/delete_reglementinterieur.php");
    echo $detele_reglementinterieur_view; 
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
let current_url_reglementinterieur = window.location.href;

if(current_url_reglementinterieur === "<?= $ACTIONS_URL_reglementinterieur["base"] ?>"){
    window.location.href = "<?= $DEFAULT_URL ?>"
}

</script>

<?php

?>