<?php
    // On récupère la liste d'url de notre application
    global $ACTIONS_URL;

    // Ici on démarre la construction de notre vue
    ob_start();
?>


<div id="accueilListDiv" hidden>
    <a href="<?= $ACTIONS_URL["create"] ?>"> Ajouter un accueil </a>
    <ul>
        <?php
            // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
            // On va donc faire une boucle dessus.
            foreach($liste_accueil as $accueil) {
        ?>

            <li>
                <a href="<?= sprintf($ACTIONS_URL["update"], $accueil["id"]) ?>">
                <b> <?= $accueil["titre"] ?> : </b> <?= $accueil["sstitre"] ?> <br>
                <b> <?= $accueil["titreen"] ?> : </b> <?= $accueil["sstitreen"] ?></a> <br>
               
                --> <a href="<?= sprintf($ACTIONS_URL["delete"], $accueil["id"]) ?>"> Supprimer </a> 
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

        let accueilListDiv = document.getElementById("accueilListDiv");
        let placeAccueilListDiv = document.getElementById("placeAccueilListDiv");

        // Si la div de destination est présente
        if(placeAccueilListDiv != null){
            // Déplace notre div
            placeAccueilListDiv.appendChild(accueilListDiv);


            // Enlève l'attribut hidden
            accueilListDiv.removeAttribute("hidden");
        }
    });
    
</script>

<?php
    // On stock le contenu généré dans une variable :
    $list_accueil_view = ob_get_clean();
?>










