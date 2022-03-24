<?php
    global $ACTIONS_URL_poubelles;

    ob_start();
?>

<div id="poubellesDiv" hidden>
    <form method="POST" id="poubellesForm">
        <label for="name">Titre:</label>
        <input type="text" id="titre" name="titre">
        <div class="inputAnglais">
        <label  for="titreEn">Choose your title:</label>
        <input  type="text" id="titreEn"  minlength="4" maxlength="75" size="75">
    </div>
    <img id="clickFlag" src="https://img.icons8.com/color/48/000000/great-britain.png">

        <p>
            <img src="https://img.icons8.com/ios-glyphs/30/000000/info--v1.png"> Max. 23 caractères. 
        </p>

        <div class="upload">
            <p class="doc">Documents: </p>

            <input type="file" id="file" class="doc" multiple="">
            <input type="file" id="file2" class="doc" multiple="">
            <input type="file" id="file3" class="doc" multiple="">

            <p class="doc"><strong>Taille maximale :</strong> 2 GB.</p>
            <p class="doc"><strong>Formats supportés :</strong> docx, pdf, txt, jpg, png </p>
        </div>

        <label for="name">Description:</label>
        <textarea id="descp" name="descp"rows="5" cols="33">It was a dark and stormy night...
        </textarea>
        <div class="inputAnglais">
        <label for="name">Description:</label>
        <textarea id="descpen" name="descp"rows="5" cols="33">It was a dark and stormy night...
        </textarea>
    </div>
        
        <p>
            <img src="https://img.icons8.com/ios-glyphs/30/000000/info--v1.png"> Max. 1500 caractères.
        </p>

        <input type="submit" name="my_form" value="Envoyer le formulaire">
    </form>
    <div id="confirmationpoubelles"></div>
</div>

<script>
    // On attend que tous les éléments de la page soient chargés
    document.addEventListener("DOMContentLoaded", function(event) {
        
        // Récupère les éléments
        let poubellesDiv = document.getElementById("poubellesDiv");
        let placepoubellesDiv = document.getElementById("placepoubellesDiv");
        let clickFlag = document.getElementById("clickFlag");
        let inputAnglais = document.getElementsByClassName("inputAnglais");
        for(var i=0; i<inputAnglais.length; i++){ 
            inputAnglais[i].style.display = "none";
         }
        
        // Ajoute un événement lors d'un clique sur un drapeau

            clickFlag.addEventListener("click", ()=>{
                for(var i=0; i<inputAnglais.length; i++) {
                    inputAnglais[i].style.display = "block";
                }
            });


        // Place le formulaire dans la page
        if(placepoubellesDiv != null){
            placepoubellesDiv.appendChild(poubellesDiv);
            poubellesDiv.removeAttribute("hidden");
        }

        let poubellesForm = document.getElementById("poubellesForm");

        // Modifie le comportement du formulaire poubelles
        poubellesForm.addEventListener("submit", function (e) {
            // Désactive le fonctionnement de base du formulaire
            e.preventDefault();

            // Récupère les champs du formulaire
            let nompoubellesFr = document.getElementById("titre");
            let nompoubellesEn = document.getElementById("titreEn");

            // Clé poubelles, ne change pas en fonction de la langue 
            let descpoubelles = document.getElementById("descp");
            let descpoubellesEn = document.getElementById("descpen");
            let inputFile1 = document.getElementById("file");
            let inputFile2 = document.getElementById("file2");
            let inputFile3 = document.getElementById("file3");

            // Crée un formulaire qui sera envoyé via une requête HTTP par javascript
            var form_data = new FormData();
            form_data.append("module", "poubelles");
            form_data.append("action", "create");
            form_data.append("titre", nompoubellesFr.value);
            form_data.append("descp", descpoubelles.value);
            form_data.append("titreen", nompoubellesEn.value);
            form_data.append("descpen", descpoubellesEn.value);
            // Ajoute les fichiers au formulaire
            if(inputFile1.files.length === 1) {
                form_data.append("fichier1", inputFile1.files[0]);
            }

            if(inputFile2.files.length === 1) {
                form_data.append("fichier2", inputFile2.files[0]);
            }

            if(inputFile3.files.length === 1) {
                form_data.append("fichier3", inputFile3.files[0]);
            }

            // Vide les valeurs pour pas envoyer les données deux fois
            nompoubellesFr.value = "";
            descpoubelles.value = "";
            nompoubellesEn.value = "";
            descpoubellesEn.value = "";

            // Crée une requête qui enverra le formulaire
            var request = new XMLHttpRequest();
            request.open("POST", "<?= $ACTIONS_URL_poubelles["database"] ?>");
            request.send(form_data);


            request.onreadystatechange = function() {
                if(request.readyState === 4){
                    // Renvoie l'utilisateur vers la liste d'poubelles
                    document.location.href = "<?= $ACTIONS_URL_poubelles["list"] ?>";

                }
            };
        });
    });
</script>

<?php
    $create_poubelles_view = ob_get_clean();
?>