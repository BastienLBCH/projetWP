<?php
    // On récupère la liste d'url de notre application
    global $ACTIONS_URL_recapitulatif;

    // Ici on démarre la construction de notre vue
    ob_start();
?>


<div id="recapitulatifListDiv" hidden>
    <ul>

        <?php
        
            // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
            // On va donc faire une boucle dessus.
            foreach($liste_recapitulatif as $recapitulatif) {
        ?>
            <li>
                <b> <?= $recapitulatif["titre"] ?> : </b> <?= $recapitulatif["descp"] ?></a> <br>
            </li>
            <br>
            <br>
        <?php
            // Ici on termine la boucle, de manière à ce que seul les <li> soient répétés
            }
        ?>
        
    </ul>  

    <!-- Accueil: -->
    <ul>

<?php

    // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
    // On va donc faire une boucle dessus.
    foreach($liste_recapitulatif_accueil as $recapitulatif_accueil) {
?>
    <li>
        <b> <?= $recapitulatif_accueil["titre"] ?> : </b> <?= $recapitulatif_accueil["sstitre"] ?></a> <br>
        <b> <?= $recapitulatif_accueil["titreen"] ?> : </b> <?= $recapitulatif_accueil["sstitreen"] ?></a> <br>
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

        let recapitulatifListDiv = document.getElementById("recapitulatifListDiv");
        let placerecapitulatifListDiv = document.getElementById("placerecapitulatifListDiv");

        // Si la div de destination est présente
        if(placerecapitulatifListDiv != null){
            // Déplace notre div
            placerecapitulatifListDiv.appendChild(recapitulatifListDiv);


            // Enlève l'attribut hidden
            recapitulatifListDiv.removeAttribute("hidden");
        }
    });
    
</script>

<?php
    // On stock le contenu généré dans une variable :
    $list_recapitulatif_view = ob_get_clean();
?>










