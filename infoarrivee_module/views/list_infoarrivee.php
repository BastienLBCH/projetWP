<?php
    // On récupère la liste d'url de notre application
    global $ACTIONS_URL_infoarrivee;
    global $BASE_URL_FILES;

    // Ici on démarre la construction de notre vue
    ob_start();
?>


<div id="infoarriveeListDiv" hidden>
    <a href="<?= $ACTIONS_URL_infoarrivee["create"] ?>"> Ajouter des informations d'arrivée </a>
    <ul>

        <?php
        
            // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
            // On va donc faire une boucle dessus.
            foreach($liste_infoarrivee as $infoarrivee) {
        ?>

            <li>
                <a href="<?= sprintf($ACTIONS_URL_infoarrivee["update"], $infoarrivee["id"]) ?>">
                <b> <?= $infoarrivee["horaire"] ?> : </b> <?= $infoarrivee["descp"] ?> </a> <br>
                <img src="<?= $BASE_URL_FILES . $infoarrivee["fichier1"] ?>" >
                --> <a href="<?= sprintf($ACTIONS_URL_infoarrivee["delete"], $infoarrivee["id"]) ?>"> Supprimer </a> 
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

        let infoarriveeListDiv = document.getElementById("infoarriveeListDiv");
        let placeinfoarriveeListDiv = document.getElementById("placeinfoarriveeListDiv");

        // Si la div de destination est présente
        if(placeinfoarriveeListDiv != null){
            // Déplace notre div
            placeinfoarriveeListDiv.appendChild(infoarriveeListDiv);


            // Enlève l'attribut hidden
            infoarriveeListDiv.removeAttribute("hidden");
        }
    });
    
</script>

<?php
    // On stock le contenu généré dans une variable :
    $list_infoarrivee_view = ob_get_clean();
?>










