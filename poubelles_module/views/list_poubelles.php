<?php
    // On récupère la liste d'url de notre application
    global $ACTIONS_URL_poubelles;
    global $BASE_URL_FILES;

    // Ici on démarre la construction de notre vue
    ob_start();
?>


<div id="poubellesListDiv" hidden>
    <a href="<?= $ACTIONS_URL_poubelles["create"] ?>"> Ajouter une poubelle: </a>
    <ul>

        <?php
        
            // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
            // On va donc faire une boucle dessus.
            foreach($liste_poubelles as $poubelles) {
        ?>

            <li>
                <a href="<?= sprintf($ACTIONS_URL_poubelles["update"], $poubelles["id"]) ?>">
                <b> <?= $poubelles["titre"] ?> : </b> <?= $poubelles["descp"] ?> </a> <br>
                <b> <?= $poubelles["titreen"] ?> : </b> <?= $poubelles["descpen"] ?> </a> <br>
                <img src="<?= $BASE_URL_FILES . $poubelles["fichier1"] ?>" >
                --> <a href="<?= sprintf($ACTIONS_URL_poubelles["delete"], $poubelles["id"]) ?>"> Supprimer </a> 
            </li>
            <br>
            <br>

        <?php
            // Ici on termine la boucle, de manière à ce que seul les <li> soient répétés
            }
        ?>
    </ul>  
    <a href="http://www.livret-accueil-numerique.fr/livret/reglementinterieur/?action_module=create_reglementinterieur">Previous </a>
    <a href="http://www.livret-accueil-numerique.fr/livret/parkings/?action_module=create_parkings">Next </a>
</div>


<script>
    // On attend que tous les éléments de la page soient chargés
    document.addEventListener("DOMContentLoaded", function(event) {
        
        // Maintenant on écrit notre code qui va permettre de placer notre division déclarée plus haut au bon endroit dans la page

        let poubellesListDiv = document.getElementById("poubellesListDiv");
        let placepoubellesListDiv = document.getElementById("placepoubellesListDiv");

        // Si la div de destination est présente
        if(placepoubellesListDiv != null){
            // Déplace notre div
            placepoubellesListDiv.appendChild(poubellesListDiv);


            // Enlève l'attribut hidden
            poubellesListDiv.removeAttribute("hidden");
        }
    });
    
</script>

<?php
    // On stock le contenu généré dans une variable :
    $list_poubelles_view = ob_get_clean();
?>










