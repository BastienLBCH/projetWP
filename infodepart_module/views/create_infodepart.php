<?php
    global $ACTIONS_URL_infodepart;

    ob_start();
?>

<div id="infodepartDiv" hidden>
<form id="infodepartForm"  method="POST">
<label for="horaire_selecte">Horaires:</label>
<select id="horaireDepart" name="horaire">
<option value="">Choisissez votre horaire d'arrivée</option>
<option value="9h-10h">9h-10h</option>
<option value="10h-11h">10h-11h</option>
<option value="11h-12h">11h-12h</option>
<option value="12h-13h">12h-13h</option>
<option value="13h-14h">13h-14h</option>
<option value="14h-15h">14h-15h</option>
<option value="15h-16h">15h-16h</option>
</select>
<p>&nbsp;</p>
<p><label for="infodepart">Instructions de départ:</label> <textarea id="infodepart" cols="33" name="infodepart" rows="5">It was a dark and stormy night...
</textarea></p>
<p><img src="https://img.icons8.com/ios-glyphs/30/000000/info--v1.png" /> Max. 1500 caractères.</p>

<a href=""><img id ="clickFlag"src="https://img.icons8.com/color/48/000000/great-britain.png"></a>
        <label for="name">Information:</label>
        <textarea id="infodepartEn" name="descp" rows="5" cols="33">
        </textarea>
<input name="mon_form" type="submit" value="Envoyer le formulaire" /></form>
    <div id="confirmationinfodepart"></div>
</div>

<script>
    // On attend que tous les éléments de la page soient chargés
    document.addEventListener("DOMContentLoaded", function(event) {
        
        // Récupère les éléments
        let infodepartDiv = document.getElementById("infodepartDiv");
        let placeinfodepartDiv = document.getElementById("placeinfodepartDiv");
        let clickFlag = document.getElementsByClassName("clickFlag");
        let inputAnglais = document.getElementsByClassName("inputAnglais");
        let champSelect = document.getElementById("horaireDepart");





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
        if(placeinfodepartDiv != null){
            placeinfodepartDiv.appendChild(infodepartDiv);
            infodepartDiv.removeAttribute("hidden");
        }

        let infodepartForm = document.getElementById("infodepartForm");

        // Modifie le comportement du formulaire infodepart
        infodepartForm.addEventListener("submit", function (e) {
            // Désactive le fonctionnement de base du formulaire
            e.preventDefault();
                // Récupère l'index de l'option sélectionnée
                // (Si c'est la première, la deuxième, la troisième, ..., la X-ième qui a été sélectionnée)
                let selected = champSelect.selectedIndex;

            // Récupère l'élément html de l'option qui a été sélectionnée
            // Donnant ainsi accès à ses attributs comme sa value ou son text
            let selectedOption = champSelect.options[selected];

            // Passé en commentaire car n'existe pas encore en anglais
            // let infodepartTitreEn = document.getElementById("infodepartTitreEn");

            // Clé infodepart, ne change pas en fonction de la langue 
            let descinfodepart = document.getElementById("infodepart");

           

            // Crée un formulaire qui sera envoyé via une requête HTTP par javascript
            var form_data = new FormData();
            form_data.append("module", "infodepart");
            form_data.append("action", "create");
            form_data.append("instruction", descinfodepart.value);
            form_data.append("horaire", selectedOption.value);

        

            // Vide les valeurs pour pas envoyer les données deux fois
            selectedOption.value = "";
            descinfodepart.value = "";


            // Crée une requête qui enverra le formulaire
            var request = new XMLHttpRequest();
            request.open("POST", "<?= $ACTIONS_URL_infodepart["database"] ?>");
            request.send(form_data);


            request.onreadystatechange = function() {
                if(request.readyState === 4){
                    // Renvoie l'utilisateur vers la liste d'infodepart
                    document.location.href = "<?= $ACTIONS_URL_infodepart["list"] ?>";

                    // let confirmationinfodepart = document.getElementById("confirmationinfodepart");

                    // confirmationinfodepart.innerHTML = request.response;
                }
            };
        });
    });
</script>

<?php
    $create_infodepart_view = ob_get_clean();
?>