<?php
    global $ACTIONS_URL;

    ob_start();
?>

<div id="accueilDiv" hidden>

<a href="<?= $ACTIONS_URL["list"] ?>"> Retour </a>

    <form id="accueilForm">
    <label for="titre">Choissisez votre titre:</label>
    <input type="text" id="accueilTitreFr"  minlength="4" maxlength="75" size="75">
    <div class="inputAnglais">
    <label  for="titreEn">Choose your title:</label>
    <input  type="text" id="accueilTitreEn"  minlength="4" maxlength="75" size="75">
    </div>

    <label for="ssTitre">Choissisez votre sous titre:</label>
    <input type="text" id="accueilSousTitreFr"  minlength="4" maxlength="75" size="75">
     <div class="inputAnglais">
    <label  for="ssTitreEn">Choose your subtitle:</label>
    <input  type="text" id="accueilSousTitreEn"  minlength="4" maxlength="75" size="75">
    </div>
   <img id="clickFlag" src="https://img.icons8.com/color/48/000000/great-britain.png">
    <p><img src="https://img.icons8.com/ios-glyphs/30/000000/info--v1.png"> Max. 75 characters. </p>

  
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
        let clickFlag = document.getElementById("clickFlag");
        let inputAnglais = document.getElementsByClassName("inputAnglais");
        for(var i=0; i<inputAnglais.length; i++){ 
            console.log(inputAnglais[i]);
            inputAnglais[i].style.display = "none";
         }
        
        // Ajoute un événement lors d'un clique sur un drapeau

            clickFlag.addEventListener("click", ()=>{
                for(var i=0; i<inputAnglais.length; i++) {
                    inputAnglais[i].style.display = "block";
                }
            });
        

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
            form_data.append("action", "create");
            form_data.append("titre", accueilTitreFr.value);
            form_data.append("sstitre", accueilSousTitreFr.value);
            form_data.append("titreen", accueilTitreEn.value);
            form_data.append("sstitreen", accueilSousTitreEn.value);

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
    $create_accueil_view = ob_get_clean();
?>