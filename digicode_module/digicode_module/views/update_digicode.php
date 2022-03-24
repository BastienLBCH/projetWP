<?php
    global $ACTIONS_URL_digicode;

    ob_start();
?>

<div id="digicodeDiv" hidden>

    <a href="<?= $ACTIONS_URL_digicode["list"] ?>"> Retour </a>


    <form id="digicodeForm">
        <input type="text" id="digicodeTitreFr" placeholder="Titre" value="<?= $digicode["titreDigi"] ?>"> <br>
        <input type="text" id="code" placeholder="Title" value="<?= $digicode["code"] ?>"> <br>
        <br>
        <input type="text" id="titredigicodeEn" placeholder="Soustitre" value="<?= $digicode["titredigicodeEn"] ?>"> <br>
        <br>
        <input type="submit" value="Valider">
    </form>
</div>

<script>
    // On attend que tous les éléments de la page soient chargés
    document.addEventListener("DOMContentLoaded", function(event) {
        // Place le formulaire dans la page
        let digicodeDiv = document.getElementById("digicodeDiv");
        let placedigicodeDiv = document.getElementById("placedigicodeDiv");

        if(placedigicodeDiv != null){
            placedigicodeDiv.appendChild(digicodeDiv);
            digicodeDiv.removeAttribute("hidden");
        }

        let digicodeForm = document.getElementById("digicodeForm");

        // Modifie le comportement du formulaire
        digicodeForm.addEventListener("submit", function (e) {
            // Désactive le fonctionnement de base du formulaire
            e.preventDefault();

            // Récupère les champs du formulaire
            let digicodeTitreFr = document.getElementById("digicodeTitreFr");
            let code = document.getElementById("code");
            let titredigicodeEn = document.getElementById("titredigicodeEn");

            // Crée un formulaire qui sera envoyé via une requête JS
            var form_data = new FormData();
            form_data.append("module", "digicode");
            form_data.append("action", "update");
            form_data.append("id", "<?= $_GET["digicode_id"] ?>");
            form_data.append("titreDigi", digicodeTitreFr.value);
            form_data.append("titredigicodeEn", titredigicodeEn.value);
            form_data.append("code", code.value);

            for (var pair of form_data.entries()) {
                console.log(pair[0]+ ', ' + pair[1]); 
            }

            digicodeTitreFr.value = "";
            titredigicodeEn.value = "";
            code.value = "";

            // Crée une requête qui enverra le formulaire
            var request = new XMLHttpRequest();
            request.open("POST", "<?= $ACTIONS_URL_digicode["database"] ?>");
            request.send(form_data);
            
            request.onreadystatechange = function() {
                if(request.readyState === 4){
                    // Renvoie l'utilisateur vers la liste d'digicode
                    document.location.href = "<?= $ACTIONS_URL_digicode["list"] ?>";
                }
            };
        });
    });
</script>

<?php
    $update_digicode_view = ob_get_clean();
?>
