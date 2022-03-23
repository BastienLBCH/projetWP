<?php
    // On récupère la liste d'url de notre application
    global $ACTIONS_URL_electro;

    // Ici on démarre la construction de notre vue
    ob_start();
?>


<div id="electroListDiv" hidden>
    <a href="<?= $ACTIONS_URL_electro["create"] ?>"> Ajouter un electro </a>
    <ul>

        <?php
        
            // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
            // On va donc faire une boucle dessus.
            foreach($liste_electro as $electro) {
        ?>

            <li>
                <a href="<?= sprintf($ACTIONS_URL_electro["update"], $electro["id"]) ?>">
                <b> <?= $electro["titre"] ?> : </b> <?= $electro["descp"] ?></a> <br>

                --> <a href="<?= sprintf($ACTIONS_URL_electro["delete"], $electro["id"]) ?>"> Supprimer </a> 
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

        let electroListDiv = document.getElementById("electroListDiv");
        let placeelectroListDiv = document.getElementById("placeelectroListDiv");

        // Si la div de destination est présente
        if(placeelectroListDiv != null){
            // Déplace notre div
            placeelectroListDiv.appendChild(electroListDiv);


            // Enlève l'attribut hidden
            electroListDiv.removeAttribute("hidden");
        }
    });
    
</script>

<?php
    // On stock le contenu généré dans une variable :
    $list_electro_view = ob_get_clean();
?>










