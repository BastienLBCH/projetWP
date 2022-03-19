<?php
    global $ACTIONS_URL_NUMEROUTILS;

    ob_start();
?>

<div id="numeroutileDiv" hidden>
    <form id="numeroutileForm">
        <input type="text" id="numeroutileNom" placeholder="Nom" value="<?= $numeroutile["nomcontact"] ?>"> <br>
        <input type="text" id="numeroutileDesc" placeholder="Description" value="<?= $numeroutile["descp"] ?>"> <br>
        <input type="text" id="numeroutileTel" placeholder="Téléphone" value="<?= $numeroutile["tel"] ?>"> <br>
        <br>
        <input type="submit" value="Valider">
    </form>
</div>

<script>
    // On attend que tous les éléments de la page soient chargés
    document.addEventListener("DOMContentLoaded", function(event) {
        // Place le formulaire dans la page
        let numeroutileDiv = document.getElementById("numeroutileDiv");
        let placeNumeroutileDiv = document.getElementById("placeNumeroutileDiv");

        if(placeNumeroutileDiv != null){
            placeNumeroutileDiv.appendChild(numeroutileDiv);
            numeroutileDiv.removeAttribute("hidden");
        }

        let numeroutileForm = document.getElementById("numeroutileForm");

        // Modifie le comportement du formulaire
        numeroutileForm.addEventListener("submit", function (e) {
            // Désactive le fonctionnement de base du formulaire
            e.preventDefault();

            // Récupère les champs du formulaire
            let numeroutileNom = document.getElementById("numeroutileNom");
            let numeroutileDesc = document.getElementById("numeroutileDesc");
            let numeroutileTel = document.getElementById("numeroutileTel");
    

            // Crée un formulaire qui sera envoyé via une requête JS
            var form_data = new FormData();
            form_data.append("module", "numeroutile");
            form_data.append("action", "update");
            form_data.append("id", "<?= $_GET["numeroutile_id"] ?>");
            form_data.append("nomcontact", numeroutileNom.value);
            form_data.append("tel", numeroutileTel.value);
            form_data.append("descp", numeroutileDesc.value);

            for (var pair of form_data.entries()) {
                console.log(pair[0]+ ', ' + pair[1]); 
            }

            numeroutileNom.value = "";
            numeroutileTel.value = "";
            numeroutileDesc.value = "";

            // Crée une requête qui enverra le formulaire
            var request = new XMLHttpRequest();
            request.open("POST", "<?= $ACTIONS_URL_NUMEROUTILS["database"] ?>");
            request.send(form_data);
            
            request.onreadystatechange = function() {
                if(request.readyState === 4){
                    // Renvoie l'utilisateur vers la liste d'accueil
                    document.location.href = "<?= $ACTIONS_URL_NUMEROUTILS["list"] ?>";
                }
            };
        });
    });
</script>

<?php
    $update_numeroutile_view = ob_get_clean();
?>