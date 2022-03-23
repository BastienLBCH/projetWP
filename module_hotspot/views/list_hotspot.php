<?php
    // On récupère la liste d'url de notre application
    global $ACTIONS_URL_HOTSPOT;
    global $BASE_URL_FILES;

    // Ici on démarre la construction de notre vue
    ob_start();
?>


<div id="hotspotListDiv" hidden>
    <a href="<?= $ACTIONS_URL_HOTSPOT["create"] ?>"> Ajouter un hotspot </a>
    <ul>

        <?php
        
            // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
            // On va donc faire une boucle dessus.
            foreach($liste_hotspot as $hotspot) {
        ?>

            <li>
                <a href="<?= sprintf($ACTIONS_URL_HOTSPOT["update"], $hotspot["id"]) ?>">

                <b> [<?= $hotspot["id"] ?>] - </b> <?= $hotspot["indication"] ?></a> <br>

                --> <a href="<?= sprintf($ACTIONS_URL_HOTSPOT["delete"], $hotspot["id"]) ?>"> Supprimer </a> 

                <br>
                <br>

                <!-- <img src="<?= $BASE_URL_FILES . $hotspot["fichier1"] ?>">
                <img src="<?= $BASE_URL_FILES . $hotspot["fichier2"] ?>">
                <img src="<?= $BASE_URL_FILES . $hotspot["fichier3"] ?>"> -->
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

        let hotspotListDiv = document.getElementById("hotspotListDiv");
        let placehotspotListDiv = document.getElementById("placeHotspotListDiv");

        // Si la div de destination est présente
        if(placehotspotListDiv != null){
            // Déplace notre div
            placehotspotListDiv.appendChild(hotspotListDiv);


            // Enlève l'attribut hidden
            hotspotListDiv.removeAttribute("hidden");
        }
    });
    
</script>

<?php
    // On stock le contenu généré dans une variable :
    $list_hotspot_view = ob_get_clean();
?>










