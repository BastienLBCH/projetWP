<?php
    // On récupère la liste d'url de notre application
    global $ACTIONS_URL_NUMEROUTILS;

    // Ici on démarre la construction de notre vue
    ob_start();
?>


<div id="numeroutileListDiv" hidden>
    <a href="http://www.livret-accueil-numerique.fr/numero-utiles/?action_module=create_numeroutile"> Ajouter un numeroutile </a>
    <ul>
        <?php
            // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
            // On va donc faire une boucle dessus.
            foreach($liste_numeroutile as $numeroutile) {
        ?>

            <li>
                <a href="<?= sprintf($ACTIONS_URL_NUMEROUTILS["update"], $numeroutile["id"]) ?>">
                <b> <?= $numeroutile["nomcontact"] ?> : </b> <?= $numeroutile["descp"] ?> <br>
                <b> <?= $numeroutile["tel"] ?> </a> <br>

            <a href="<?= sprintf($ACTIONS_URL_NUMEROUTILS["delete"], $numeroutile["id"]) ?>"> Supprimer </a> 
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

        let numeroutileListDiv = document.getElementById("numeroutileListDiv");
        let placenumeroutileListDiv = document.getElementById("placeNumeroutileListDiv");

        // Si la div de destination est présente
        if(placenumeroutileListDiv != null){
            // Déplace notre div
            placenumeroutileListDiv.appendChild(numeroutileListDiv);


            // Enlève l'attribut hidden
            numeroutileListDiv.removeAttribute("hidden");
        }
    });
    
</script>

<?php
    // On stock le contenu généré dans une variable :
    $list_numeroutile_view = ob_get_clean();
?>










