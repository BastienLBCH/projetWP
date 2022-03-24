<?php
    global $ACTIONS_URL_digicode;

    ob_start();
?>

<div id="digicodeDiv" hidden>

<a href="<?= $ACTIONS_URL_digicode["list"] ?>"> Retour </a>
    <form id="digiForm" >
<p>Renseignez les codes d'accès à votre hébergement. <br />Vos clients ne resteront plus jamais bloqué devant la porte !</p>
<br /><label for="name">Titre:</label> 
<input id="digicodeTitreFr" name="titreDigi" type="text" />
<label for="name">Code ou interphone:</label> 
<input id="code" name="code" type="text" /> <br /><br />
<br>
<input type="text" id="digicodeTitreEn" placeholder="subtitle"><br>
<div id="ajout"> </div>
<button id="ajoutDigi" type="button">Ajouter un digicode</button> 
<input  type="submit" value="Valider" />
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

        let digiForm = document.getElementById("digiForm");

        // Modifie le comportement du formulaire
        digiForm.addEventListener("submit", function (e) {
            // Désactive le fonctionnement de base du formulaire
            e.preventDefault();

            // Récupère les champs du formulaire
            let digicodeTitreFr = document.getElementById("digicodeTitreFr");
            let code = document.getElementById("code");

            let digicodeSousTitreEn = document.getElementById("digicodeTitreEn");


            // Crée un formulaire qui sera envoyé via une requête JS
            var form_data = new FormData();
            form_data.append("module", "digicode");
            form_data.append("action", "create");
            form_data.append("titreDigi", digicodeTitreFr.value);
            form_data.append("titredigicodeEn", digicodeTitreEn.value);
            form_data.append("code", code.value);


            digicodeTitreFr.value = "";
            code.value = "";
            digicodeTitreEn.value = "";


            // Crée une requête qui enverra le formulaire
            var request = new XMLHttpRequest();
            request.open("POST", "<?= $ACTIONS_URL_digicode["database"] ?>");
            request.send(form_data);


            request.onreadystatechange = function() {
                if(request.readyState === 4){
                    // Renvoie l'utilisateur vers la liste de digicode
                    document.location.href = "<?= $ACTIONS_URL_digicode["list"] ?>";
                }
            };
        });
    });
</script>

<?php
    $create_digicode_view = ob_get_clean();
?>