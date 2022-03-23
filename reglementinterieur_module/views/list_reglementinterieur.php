<?php
    // On récupère la liste d'url de notre application
    global $ACTIONS_URL_reglementinterieur;
    global $BASE_URL_FILES;

    // Ici on démarre la construction de notre vue
    ob_start();
?>


<div id="reglementinterieurListDiv" hidden>
    <a href="<?= $ACTIONS_URL_reglementinterieur["create"] ?>"> Ajouter un règlement intérieur </a>
    <ul>

        <?php
        
            // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
            // On va donc faire une boucle dessus.
            foreach($liste_reglementinterieur as $reglementinterieur) {
        ?>

            <li>
                <a href="<?= sprintf($ACTIONS_URL_reglementinterieur["update"], $reglementinterieur["id"]) ?>">
                <b> <?= $reglementinterieur["titre"] ?> : </b> <?= $reglementinterieur["descp"] ?> </a> <br>
                <img src="<?= $BASE_URL_FILES . $reglementinterieur["fichier1"] ?>" >
                --> <a href="<?= sprintf($ACTIONS_URL_reglementinterieur["delete"], $reglementinterieur["id"]) ?>"> Supprimer </a> 
            </li>
            <br>
            <br>

        <?php
            // Ici on termine la boucle, de manière à ce que seul les <li> soient répétés
            }
        ?>
    </ul>  
</div>


<script>
    // On attend que tous les éléments de la page soient chargés
    document.addEventListener("DOMContentLoaded", function(event) {
        
        // Maintenant on écrit notre code qui va permettre de placer notre division déclarée plus haut au bon endroit dans la page

        let reglementinterieurListDiv = document.getElementById("reglementinterieurListDiv");
        let placereglementinterieurListDiv = document.getElementById("placereglementinterieurListDiv");

        // Si la div de destination est présente
        if(placereglementinterieurListDiv != null){
            // Déplace notre div
            placereglementinterieurListDiv.appendChild(reglementinterieurListDiv);


            // Enlève l'attribut hidden
            reglementinterieurListDiv.removeAttribute("hidden");
        }
    });
    
</script>

<?php
    // On stock le contenu généré dans une variable :
    $list_reglementinterieur_view = ob_get_clean();
?>










