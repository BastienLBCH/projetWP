<?php
    global $ACTIONS_URL_HOTSPOT;

    ob_start();
?>

<div id="hotspotDiv" hidden>

    <!-- Formulaire hotspot -->
    <form action="" method="POST" id="hotspotForm">
        <div id="textHotspot">
            <p>Vous disposez d'un hotspot dans votre établissement ? <br>
            Indiquer la marche à suivre pour se connecter afin que vos voyageurs se connecte facilement</p>
            <br>

            <textarea id="indication" name="indication" rows="5" cols="33">
<?= $hotspot["indication"] ?>
            </textarea>


            <div class="upload">
                <p class="doc">Documents: </p>
                <input type="file" name="film" id="file" class="doc" multiple="">
                <input type="file" name="film" id="file2" class="doc" multiple="">
                <input type="file" name="film" id="file3" class="doc" multiple="">
                <p class="doc"><strong>Taille maximale :</strong> 2 GB.</p>
                <p class="doc"><strong>Formats supportés :</strong> docx, pdf, txt, jpg, png </p>
            </div>
        </div>
        <input name="mon_form" type="submit" value="Envoyer le formulaire" /></form>

        <br>
        <div id="confirmationWifi"></div>
    </form>
</div>

<script>
    // On attend que tous les éléments de la page soient chargés
    document.addEventListener("DOMContentLoaded", function(event) {
        
        // Récupère les éléments
        let hotspotDiv = document.getElementById("hotspotDiv");
        let placeHotspotDiv = document.getElementById("placeHotspotDiv");

        let clickFlag = document.getElementsByClassName("clickFlag");
        let inputAnglais = document.getElementsByClassName("inputAnglais");
        
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
        if(placeHotspotDiv != null){
            placeHotspotDiv.appendChild(hotspotDiv);
            hotspotDiv.removeAttribute("hidden");
        }

        let hotspotForm = document.getElementById("hotspotForm");

        // Modifie le comportement du formulaire hotspot
        hotspotForm.addEventListener("submit", function (e) {
            // Désactive le fonctionnement de base du formulaire
            e.preventDefault();


            // Récupération des éléments du formulaire
            let indicationHotspot = document.getElementById("indication");

            let inputFile1 = document.getElementById("file");
            let inputFile2 = document.getElementById("file2");
            let inputFile3 = document.getElementById("file3");

            // Crée un formulaire qui sera envoyé via une requête HTTP par javascript
            var form_data = new FormData();
            form_data.append("module", "hotspot");
            form_data.append("action", "update");
            form_data.append("id", "<?= $_GET["hotspot_id"] ?>");
            form_data.append("indication", indicationHotspot.value);

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
            indicationHotspot.value = "";

            // for (var pair of form_data.entries()) {
            //     console.log(pair[0]+ ', ' + pair[1]); 
            // }

            // Crée une requête qui enverra le formulaire
            var request = new XMLHttpRequest();
            request.open("POST", "<?= $ACTIONS_URL_HOTSPOT["database"] ?>");
            request.send(form_data);


            request.onreadystatechange = function() {
                if(request.readyState === 4){
                    // Renvoie l'utilisateur vers la liste d'wifi
                    document.location.href = "<?= $ACTIONS_URL_HOTSPOT["list"] ?>";

                    // let confirmationWifi = document.getElementById("confirmationWifi");

                    // confirmationWifi.innerHTML = request.response;
                }
            };
        });
    });
</script>

<?php
    $update_hotspot_view = ob_get_clean();
?>