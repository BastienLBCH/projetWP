<?php
    // On récupère la liste d'url de notre application
    global $ACTIONS_URL_transports;
    global $BASE_URL_FILES;

    // Ici on démarre la construction de notre vue
    ob_start();
?>


<div id="transportsListDiv" hidden>
    <a href="<?= $ACTIONS_URL_transports["create"] ?>"> Ajouter des informations de transports </a>
    <ul>

        <?php
        
            // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
            // On va donc faire une boucle dessus.
            foreach($liste_transports as $transports) {
        ?>

            <li>
                <a href="<?= sprintf($ACTIONS_URL_transports["update"], $transports["id"]) ?>">
                <b> <?= $transports["titre"] ?> : </b> <?= $transports["descp"] ?> </a> <br>
                <b> <?= $transports["titreen"] ?> : </b> <?= $transports["descpen"] ?> </a> <br>
                <img src="<?= $BASE_URL_FILES . $transports["fichier1"] ?>" >
                --> <a href="<?= sprintf($ACTIONS_URL_transports["delete"], $transports["id"]) ?>"> Supprimer </a> 
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

        let transportsListDiv = document.getElementById("transportsListDiv");
        let placetransportsListDiv = document.getElementById("placetransportsListDiv");

        // Si la div de destination est présente
        if(placetransportsListDiv != null){
            // Déplace notre div
            placetransportsListDiv.appendChild(transportsListDiv);


            // Enlève l'attribut hidden
            transportsListDiv.removeAttribute("hidden");
        }
    });
    
</script>

<?php
    // On stock le contenu généré dans une variable :
    $list_transports_view = ob_get_clean();
?>










