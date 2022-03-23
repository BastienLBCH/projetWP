<?php
    // On récupère la liste d'url de notre application
    global $ACTIONS_URL_WIFI;

    // Ici on démarre la construction de notre vue
    ob_start();
?>


<div id="wifiListDiv" hidden>
    <a href="<?= $ACTIONS_URL_WIFI["create"] ?>"> Ajouter un wifi </a>
    <ul>

        <?php
        
            // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
            // On va donc faire une boucle dessus.
            foreach($liste_wifi as $wifi) {
        ?>

            <li>
                <a href="<?= sprintf($ACTIONS_URL_WIFI["update"], $wifi["id"]) ?>">
                <b> <?= $wifi["nameWifi"] ?> : </b> <?= $wifi["keyWifi"] ?></a> <br>

                --> <a href="<?= sprintf($ACTIONS_URL_WIFI["delete"], $wifi["id"]) ?>"> Supprimer </a> 
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

        let wifiListDiv = document.getElementById("wifiListDiv");
        let placewifiListDiv = document.getElementById("placewifiListDiv");

        // Si la div de destination est présente
        if(placewifiListDiv != null){
            // Déplace notre div
            placewifiListDiv.appendChild(wifiListDiv);


            // Enlève l'attribut hidden
            wifiListDiv.removeAttribute("hidden");
        }
    });
    
</script>

<?php
    // On stock le contenu généré dans une variable :
    $list_wifi_view = ob_get_clean();
?>










