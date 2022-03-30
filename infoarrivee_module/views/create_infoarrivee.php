<?php
    global $ACTIONS_URL_infoarrivee;

    ob_start();
?>

<div id="infoarriveeDiv" hidden>
<form id="infoarriveeForm"  method="POST">
<label for="horaire_selecte">Tranche horaire d'arrivée:</label>
<select id="horaireArrivee" name="horaire">
<option value="">--Horaires--</option>
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
<div class="upload">
<p class="doc">Inventaire:</p>
<input id="file" class="doc" multiple="multiple" name="film" type="file" /> <input id="file2" class="doc" multiple="multiple" name="film" type="file" /> <input id="file3" class="doc" multiple="multiple" name="film" type="file" />
<p class="doc"><strong>Taille maximale :</strong> 2 GB.</p>
<p class="doc"><strong>Formats supportés :</strong> docx, pdf, txt, jpg, png</p>
</div>
<div class="upload">
<p class="doc">État des lieux:</p>
<input id="file" class="doc" multiple="multiple" name="film" type="file" /> <input id="file2" class="doc" multiple="multiple" name="film" type="file" /> <input id="file3" class="doc" multiple="multiple" name="film" type="file" />
<p class="doc"><strong>Taille maximale :</strong> 2 GB.</p>
<p class="doc"><strong>Formats supportés :</strong> docx, pdf, txt, jpg, png</p>
</div>
<textarea id="descp" cols="33" name="infodepart" rows="5">It was a dark and stormy night...
</textarea>
<p><img src="https://img.icons8.com/ios-glyphs/30/000000/info--v1.png" /> Max. 1500 caractères.</p>
<input name="mon_form" type="submit" value="Envoyer le formulaire" /></form>
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
            // let infoarriveeTitreEn = document.getElementById("infoarriveeTitreEn");

            // Clé infoarrivee, ne change pas en fonction de la langue 
            let descinfoarrivee = document.getElementById("descp");

            let inputFile1 = document.getElementById("file");
            let inputFile2 = document.getElementById("file2");
            let inputFile3 = document.getElementById("file3");
            let userID = document.getElementById("user_id").getAttribute("value");
            // Crée un formulaire qui sera envoyé via une requête HTTP par javascript
            var form_data = new FormData();
            form_data.append("module", "infoarrivee");
            form_data.append("action", "create");
            form_data.append("id_user", userID);
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
    $create_infoarrivee_view = ob_get_clean();
?>