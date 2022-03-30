<?php
    // On récupère la liste d'url de notre application
    global $ACTIONS_URL_digicode;

    // Ici on démarre la construction de notre vue
    ob_start();
?>


<div id="digicodeListDiv" hidden>
    <a href="<?= $ACTIONS_URL_digicode["create"] ?>"> Ajouter un digicode </a>
    <ul>
        <?php
            // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
            // On va donc faire une boucle dessus.
            foreach($liste_digicode as $digicode) {
        ?>

            <li>
                <a href="<?= sprintf($ACTIONS_URL_digicode["update"], $digicode["id"]) ?>">
                <b> <?= $digicode["titreDigi"] ?> : </b> <?= $digicode["code"] ?> <br>
                <b> <?= $digicode["titredigicodeEn"] ?> </a> 

                --> <a href="<?= sprintf($ACTIONS_URL_digicode["delete"], $digicode["id"]) ?>"> Supprimer </a> 
            </li>
            <br>
            <br>

        <?php
            // Ici on termine la boucle, de manière à ce que seul les <li> soient répétés
            }
        ?>
    </ul>  
    <a href="http://www.livret-accueil-numerique.fr/livret/wifi-hotspot-2/?action_module=create_wifi">Previous </a>
    <a href="http://www.livret-accueil-numerique.fr/livret/numero-utiles/?action_module=create_numeroutile">Next </a>
</div>


<script>
    // On attend que tous les éléments de la page soient chargés
    document.addEventListener("DOMContentLoaded", function(event) {
        
        // Maintenant on écrit notre code qui va permettre de placer notre division déclarée plus haut au bon endroit dans la page

        let digicodeListDiv = document.getElementById("digicodeListDiv");
        let placedigicodeListDiv = document.getElementById("placedigicodeListDiv");

        // Si la div de destination est présente
        if(placedigicodeListDiv != null){
            // Déplace notre div
            placedigicodeListDiv.appendChild(digicodeListDiv);


            // Enlève l'attribut hidden
            digicodeListDiv.removeAttribute("hidden");
        }
    });
    
</script>

<?php
    // On stock le contenu généré dans une variable :
    $list_digicode_view = ob_get_clean();
?>










