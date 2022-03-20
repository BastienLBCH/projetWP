<?php
    global $ACTIONS_URL;

    ob_start();
?>

<div id="wifiDiv" hidden>
    <form id="wifiForm">
        <input type="text" id="wifiTitreFr" placeholder="Titre" value="<?= $wifi["titre"] ?>"> <br>
        <input type="text" id="wifiTitreEn" placeholder="Title" value="<?= $wifi["titreen"] ?>"> <br>
        <br>
        <input type="text" id="wifiSousTitreFr" placeholder="Soustitre" value="<?= $wifi["sstitre"] ?>"> <br>
        <input type="text" id="wifiSousTitreEn" placeholder="subtitle" value="<?= $wifi["sstitreen"] ?>"><br>
        <br>
        <input type="submit" value="Valider">
    </form>
</div>

<script>
    // On attend que tous les éléments de la page soient chargés
    document.addEventListener("DOMContentLoaded", function(event) {
        // Place le formulaire dans la page
        let wifiDiv = document.getElementById("wifiDiv");
        let placewifiDiv = document.getElementById("placewifiDiv");

        if(placewifiDiv != null){
            placewifiDiv.appendChild(wifiDiv);
            wifiDiv.removeAttribute("hidden");
        }

        let wifiForm = document.getElementById("wifiForm");

        // Modifie le comportement du formulaire
        wifiForm.addEventListener("submit", function (e) {
            // Désactive le fonctionnement de base du formulaire
            e.preventDefault();

            // Récupère les champs du formulaire
            let wifiTitreFr = document.getElementById("wifiTitreFr");
            let wifiTitreEn = document.getElementById("wifiTitreEn");

            let wifiSousTitreFr = document.getElementById("wifiSousTitreFr");
            let wifiSousTitreEn = document.getElementById("wifiSousTitreEn");

            // Crée un formulaire qui sera envoyé via une requête JS
            var form_data = new FormData();
            form_data.append("module", "wifi");
            form_data.append("action", "update");
            form_data.append("id", "<?= $_GET["wifi_id"] ?>");
            form_data.append("titre", wifiTitreFr.value);
            form_data.append("sstitre", wifiSousTitreFr.value);
            form_data.append("titreen", wifiTitreEn.value);
            form_data.append("sstitreen", wifiSousTitreEn.value);

            for (var pair of form_data.entries()) {
                console.log(pair[0]+ ', ' + pair[1]); 
            }

            wifiTitreFr.value = "";
            wifiSousTitreFr.value = "";
            wifiTitreEn.value = "";
            wifiSousTitreEn.value = "";

            // Crée une requête qui enverra le formulaire
            var request = new XMLHttpRequest();
            request.open("POST", "<?= $ACTIONS_URL["database"] ?>");
            request.send(form_data);
            
            request.onreadystatechange = function() {
                if(request.readyState === 4){
                    // Renvoie l'utilisateur vers la liste d'wifi
                    document.location.href = "<?= $ACTIONS_URL["list"] ?>";
                }
            };
        });
    });
</script>

<?php
    $update_wifi_view = ob_get_clean();
?>