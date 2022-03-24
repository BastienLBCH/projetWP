<?php
    global $ACTIONS_URL;

    ob_start();
?>

<div id="accueilDiv" hidden>

    <a href="<?= $ACTIONS_URL["list"] ?>"> Retour </a>


    <form id="accueilForm">
        <input type="text" id="accueilTitreFr" placeholder="Titre" value="<?= $accueil["titre"] ?>"> <br>
        <input type="text" id="accueilTitreEn" placeholder="Title" value="<?= $accueil["titreen"] ?>"> <br>
        <br>
        <input type="text" id="accueilSousTitreFr" placeholder="Soustitre" value="<?= $accueil["sstitre"] ?>"> <br>
        <input type="text" id="accueilSousTitreEn" placeholder="subtitle" value="<?= $accueil["sstitreen"] ?>"><br>
        <br>
        <input type="submit" value="Valider">
    </form>
</div>

<script>
    // On attend que tous les éléments de la page soient chargés
    document.addEventListener("DOMContentLoaded", function(event) {
        // Place le formulaire dans la page
        let accueilDiv = document.getElementById("accueilDiv");
        let placeAccueilDiv = document.getElementById("placeAccueilDiv");

        if(placeAccueilDiv != null){
            placeAccueilDiv.appendChild(accueilDiv);
            accueilDiv.removeAttribute("hidden");
        }

        let accueilForm = document.getElementById("accueilForm");

        // Modifie le comportement du formulaire
        accueilForm.addEventListener("submit", function (e) {
            // Désactive le fonctionnement de base du formulaire
            e.preventDefault();

            // Récupère les champs du formulaire
            let accueilTitreFr = document.getElementById("accueilTitreFr");
            let accueilTitreEn = document.getElementById("accueilTitreEn");

            let accueilSousTitreFr = document.getElementById("accueilSousTitreFr");
            let accueilSousTitreEn = document.getElementById("accueilSousTitreEn");

            // Crée un formulaire qui sera envoyé via une requête JS
            var form_data = new FormData();
            form_data.append("module", "accueil");
            form_data.append("action", "update");
            form_data.append("id", "<?= $_GET["accueil_id"] ?>");
            form_data.append("titre", accueilTitreFr.value);
            form_data.append("sstitre", accueilSousTitreFr.value);
            form_data.append("titreen", accueilTitreEn.value);
            form_data.append("sstitreen", accueilSousTitreEn.value);

            for (var pair of form_data.entries()) {
                console.log(pair[0]+ ', ' + pair[1]); 
            }

            accueilTitreFr.value = "";
            accueilSousTitreFr.value = "";
            accueilTitreEn.value = "";
            accueilSousTitreEn.value = "";

            // Crée une requête qui enverra le formulaire
            var request = new XMLHttpRequest();
            request.open("POST", "<?= $ACTIONS_URL["database"] ?>");
            request.send(form_data);
            
            request.onreadystatechange = function() {
                if(request.readyState === 4){
                    // Renvoie l'utilisateur vers la liste d'accueil
                    document.location.href = "<?= $ACTIONS_URL["list"] ?>";
                }
            };
        });
    });
</script>

<?php
    $update_accueil_view = ob_get_clean();
?>
