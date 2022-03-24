<?php
    global $ACTIONS_URL_infoarrivee;

    ob_start();
?>

<div id="infoarriveeDiv" hidden>
    <form method="POST" id="infoarriveeForm">
    <select id="horaireArrivee" name="horaire">
<option value=""><?= $infoarrivee["horaire"] ?></option>
<option value="9h-10h">9h-10h</option>
<option value="10h-11h">10h-11h</option>
<option value="11h-12h">11h-12h</option>
<option value="12h-13h">12h-13h</option>
<option value="13h-14h">13h-14h</option>
<option value="14h-15h">14h-15h</option>
<option value="15h-16h">15h-16h</option>
<option value="16h-17h">16h-17h</option>
<option value="17h-18h">17h-18h</option>
<option value="18h-19h">18h-19h</option>
<option value="19h-20h">19h-20h</option>
<option value="20h-21h">20h-21h</option>
<option value="21h-22h">21h-22h</option>
</select>


        <a href=""><img src="https://img.icons8.com/color/48/000000/france.png"></a>
        <a href=""><img src="https://img.icons8.com/color/48/000000/great-britain.png"></a>

        <p>
            <img src="https://img.icons8.com/ios-glyphs/30/000000/info--v1.png"> Max. 23 caractères. 
        </p>

        <!-- Documents -->
        <div class="upload">
            <p class="doc">Documents: </p>

            <input type="file" id="file" class="doc" multiple="">
            <input type="file" id="file2" class="doc" multiple="">
            <input type="file" id="file3" class="doc" multiple="">

            <p class="doc"><strong>Taille maximale :</strong> 2 GB.</p>
            <p class="doc"><strong>Formats supportés :</strong> docx, pdf, txt, jpg, png </p>
        </div>

        <!-- Description -->
        <label for="name">Information:</label>
        <textarea id="descp" name="descp"rows="5" cols="33">
        <?= $infoarrivee["descp"] ?>
        </textarea>

        <a href=""><img src="https://img.icons8.com/color/48/000000/france.png"></a>
        <a href=""><img src="https://img.icons8.com/color/48/000000/great-britain.png"></a>
        
        <p>
            <img src="https://img.icons8.com/ios-glyphs/30/000000/info--v1.png"> Max. 1500 caractères.
        </p>

        <input type="submit" name="my_form" value="Envoyer le formulaire">
    </form>
    <div id="confirmationinfoarrivee"></div>
</div>


<script>
    // On attend que tous les éléments de la page soient chargés
    document.addEventListener("DOMContentLoaded", function(event) {
        
        // Récupère les éléments
        let infoarriveeDiv = document.getElementById("infoarriveeDiv");
        let placeinfoarriveeDiv = document.getElementById("placeinfoarriveeDiv");
        let clickFlag = document.getElementsByClassName("clickFlag");
        let inputAnglais = document.getElementsByClassName("inputAnglais");
        let champSelect = document.getElementById("horaireArrivee");
        // Cache les éléments en anglais
        for(var i=0; i<inputAnglais.length; i++) {
            inputAnglais[i].style.display = "none";
        }
        
        // Ajoute un événement lors d'un clique sur un drapeau
        for(var i=0; i<clickFlag.length; i++) {
            clickFlag[i].addEventListener("click", ()=>{
                for(var i=0; i<inputAnglais.length; i++) {
                    inputAnglais[i].style.display = "block";
                }
            });
        }


        // Place le formulaire dans la page
        if(placeinfoarriveeDiv != null){
            placeinfoarriveeDiv.appendChild(infoarriveeDiv);
            infoarriveeDiv.removeAttribute("hidden");
        }

        let infoarriveeForm = document.getElementById("infoarriveeForm");

        // Modifie le comportement du formulaire infoarrivee
        infoarriveeForm.addEventListener("submit", function (e) {
            // Désactive le fonctionnement de base du formulaire
            e.preventDefault();
                            // Récupère l'index de l'option sélectionnée
                // (Si c'est la première, la deuxième, la troisième, ..., la X-ième qui a été sélectionnée)
                let selected = champSelect.selectedIndex;

            // Récupère l'élément html de l'option qui a été sélectionnée
            // Donnant ainsi accès à ses attributs comme sa value ou son text
            let selectedOption = champSelect.options[selected];
       

            // Passé en commentaire car n'existe pas encore en anglais
            // let infoarriveehoraireEn = document.getElementById("infoarriveehoraireEn");

            // Clé infoarrivee, ne change pas en fonction de la langue 
            let descinfoarrivee = document.getElementById("descp");

            let inputFile1 = document.getElementById("file");
            let inputFile2 = document.getElementById("file2");
            let inputFile3 = document.getElementById("file3");

            // Crée un formulaire qui sera envoyé via une requête HTTP par javascript
            var form_data = new FormData();
            form_data.append("module", "infoarrivee");
            form_data.append("action", "update");
            form_data.append("id", "<?= $_GET["infoarrivee_id"] ?>");
            form_data.append("descp", descinfoarrivee.value);
            form_data.append("horaire", selectedOption.value);

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
            selectedOption.value = "";
            descinfoarrivee.value = "";

            // for (var pair of form_data.entries()) {
            //     console.log(pair[0]+ ', ' + pair[1]); 
            // }

            // Crée une requête qui enverra le formulaire
            var request = new XMLHttpRequest();
            request.open("POST", "<?= $ACTIONS_URL_infoarrivee["database"] ?>");
            request.send(form_data);


            request.onreadystatechange = function() {
                if(request.readyState === 4){
                    // Renvoie l'utilisateur vers la liste d'infoarrivee
                    document.location.href = "<?= $ACTIONS_URL_infoarrivee["list"] ?>";

                    // let confirmationinfoarrivee = document.getElementById("confirmationinfoarrivee");

                    // confirmationinfoarrivee.innerHTML = request.response;
                }
            };
        });
    });
</script>

<?php
    $update_infoarrivee_view = ob_get_clean();
?>