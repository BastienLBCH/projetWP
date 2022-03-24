<?php
    // On récupère la liste d'url de notre application
    global $ACTIONS_URL_parkings;
    global $BASE_URL_FILES;

    // Ici on démarre la construction de notre vue
    ob_start();
?>


<div id="parkingsListDiv" hidden>
    <a href="<?= $ACTIONS_URL_parkings["create"] ?>"> Ajouter un parking </a>
    <ul>

        <?php
        
            // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
            // On va donc faire une boucle dessus.
            foreach($liste_parkings as $parkings) {
        ?>

            <li>
                <a href="<?= sprintf($ACTIONS_URL_parkings["update"], $parkings["id"]) ?>">
                <b> <?= $parkings["titre"] ?> : </b> <?= $parkings["descp"] ?> </a> <br>
                <b> <?= $parkings["titreEn"] ?> : </b> <?= $parkings["descpen"] ?> </a> <br>
                <img src="<?= $BASE_URL_FILES . $parkings["fichier1"] ?>" >
                --> <a href="<?= sprintf($ACTIONS_URL_parkings["delete"], $parkings["id"]) ?>"> Supprimer </a> 
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

        let parkingsListDiv = document.getElementById("parkingsListDiv");
        let placeparkingsListDiv = document.getElementById("placeparkingsListDiv");

        // Si la div de destination est présente
        if(placeparkingsListDiv != null){
            // Déplace notre div
            placeparkingsListDiv.appendChild(parkingsListDiv);


            // Enlève l'attribut hidden
            parkingsListDiv.removeAttribute("hidden");
        }
    });
    
</script>

<?php
    // On stock le contenu généré dans une variable :
    $list_parkings_view = ob_get_clean();
?>










