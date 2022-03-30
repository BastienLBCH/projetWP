<?php

/*
Plugin Name: Module recapitulatif
Description: Simple mvc template
Author: Marie
Version: 1.0
Author URI: no uri
*/

/*
    ### Ce fichier est censé récupérer les url et agir en conséquence. ###
*/

// $id = $recapitulatifPlugin.check_if_user_logged_in();
// echo $id;

// On inclut ici le modèle qui permettra de récupérer la liste des fichiers de test
require("recapitulatif_module/models.php");

// On inclut ici les paramètres
require("recapitulatif_module/settings.php");

class RecapitulatifPlugin {
    public $user_id = 0;

    public function __construct(){
        add_action( 'plugins_loaded', array( $this, 'check_if_user_logged_in' ) );
    }

    public function check_if_user_logged_in(){
        if ( is_user_logged_in() ){
            $user = wp_get_current_user();
            $user_id = ( isset( $user->ID ) ? (int) $user->ID : 0 );
            

            global $ACTIONS_URL_recapitulatif;
            global $DEFAULT_URL;

            // D'abord, on va définir les url que l'on veut récupérer et les lier à une fonction
            $actions_mapping = [
                "list_recapitulatif" => "list_recapitulatif",
            ];


            // Ensuite on définit les fonctions indiquées ci-dessus, 
            // on leur donne la base de données en argument pour qu'elles puissent y accéder
            function list_recapitulatif() {
                // Cette fonction aura pour but de lister tous les tests dans ma base de données. 
                // On va donc appeler la fonction dans le modèle permettant de les lister.
                $liste_recapitulatif = db_list_module_recapitulatif("recapitulatif", $user_id);
                $liste_recapitulatif_accueil = db_list_module_recapitulatif("accueil", $user_id);
                $liste_recapitulatif_digicode = db_list_module_recapitulatif("digicode", $user_id);
                $liste_recapitulatif_electromenager = db_list_module_recapitulatif("electromenage", $user_id);
                $liste_recapitulatif_infoarrivee = db_list_module_recapitulatif("infoarrivee", $user_id);
                $liste_recapitulatif_infodepart = db_list_module_recapitulatif("infodepart", $user_id);
                $liste_recapitulatif_hotspot = db_list_module_recapitulatif("hotspot", $user_id);
                $liste_recapitulatif_numeroutile = db_list_module_recapitulatif("numeroutile", $user_id);
                $liste_recapitulatif_parkings = db_list_module_recapitulatif("parkings", $user_id);
                $liste_recapitulatif_poubelles = db_list_module_recapitulatif("poubelles", $user_id);
                $liste_recapitulatif_reglementinterieur = db_list_module_recapitulatif("reglementinterieur", $user_id);
                $liste_recapitulatif_transports = db_list_module_recapitulatif("transports", $user_id);
                $liste_recapitulatif_wifi = db_list_module_recapitulatif("wifi", $user_id);
                
                // L'intégralité de notre base tests est maintenant stockée dans la variable list_tests
                // On va maintenant "constuire" la page que l'on enverra à l'utilisateur
                require("recapitulatif_module/views/list_recapitulatif.php");

                // Maintenant on affiche la vue ainsi générée :
                echo $list_recapitulatif_view;
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
        }
    }
}

$recapitulatifPlugin = new RecapitulatifPlugin();

?>

<script>

// Redirection vers la l'url de base
let current_url_recapitulatif = window.location.href;

if(current_url_recapitulatif === "<?= $ACTIONS_URL_recapitulatif["base"] ?>"){
    window.location.href = "<?= $DEFAULT_URL ?>"
}

</script>

<?php

?>