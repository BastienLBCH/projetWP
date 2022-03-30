<?php
    // On récupère la liste d'url de notre application
    global $ACTIONS_URL_infodepart;
    global $BASE_URL_FILES;

    // Ici on démarre la construction de notre vue
    ob_start();
?>


<div id="infodepartListDiv" hidden>
    <a href="<?= $ACTIONS_URL_infodepart["create"] ?>"> Ajouter des informations de départ </a>
    <ul>

        <?php
        
            // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
            // On va donc faire une boucle dessus.
            foreach($liste_infodepart as $infodepart) {
        ?>

            <li>
                <a href="<?= sprintf($ACTIONS_URL_infodepart["update"], $infodepart["id"]) ?>">
                <b> <?= $infodepart["horaire"] ?> : </b> <?= $infodepart["instruction"] ?> </a> <br>
                --> <a href="<?= sprintf($ACTIONS_URL_infodepart["delete"], $infodepart["id"]) ?>"> Supprimer </a> 
            </li>
            <br>
            <br>

        <?php
            // Ici on termine la boucle, de manière à ce que seul les <li> soient répétés
            }
        ?>
    </ul>  
    <a href="http://www.livret-accueil-numerique.fr/livret/infoarrivee/?action_module=create_infoarrivee">Previous </a>

</div>


<script>
    // On attend que tous les éléments de la page soient chargés
    document.addEventListener("DOMContentLoaded", function(event) {
        
        // Maintenant on écrit notre code qui va permettre de placer notre division déclarée plus haut au bon endroit dans la page

        let infodepartListDiv = document.getElementById("infodepartListDiv");
        let placeinfodepartListDiv = document.getElementById("placeinfodepartListDiv");

        // Si la div de destination est présente
        if(placeinfodepartListDiv != null){
            // Déplace notre div
            placeinfodepartListDiv.appendChild(infodepartListDiv);


            // Enlève l'attribut hidden
            infodepartListDiv.removeAttribute("hidden");
        }
    });
    
</script>

<?php
    // On stock le contenu généré dans une variable :
    $list_infodepart_view = ob_get_clean();
?>










