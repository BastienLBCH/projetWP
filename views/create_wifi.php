<?php
    global $ACTIONS_URL_WIFI;

    ob_start();
?>

<div id="wifiDiv" hidden>

    <!-- Boutons choix wifi / hotspot -->
    <button id="classique" type="button">Classique</button>
    <button id="hotspot" type="button">Hotspot</button>
    
    <!-- Formulaire wifi -->
    <form action="" method="POST" id="wifiForm">

        <div id="textClassique">
            <p>
                Ajouter le nom de votre réseaux et le mot de passe de votre Wifi. 
                Vos voyageurs pourront très simplement copier puis coller votre code WIFI.<br>
                Rapide et efficace ! 
            </p>
            
            <br>
            
            <label for="name">Nom du WIFI:</label>
            <input type="text" id="nomWifiFr" name="wifi">

            <label for="key">Clé WIFI:</label>
            <input type="text" id="cleWifi" name="cle">

            <div class="upload">
                <p class="doc">Documents: </p>
                
                <input type="file" name="film" id="file" class="doc" multiple="">
                <input type="file" name="film" id="file2" class="doc" multiple="">
                <input type="file" name="film" id="file3" class="doc" multiple="">
                
                <p class="doc"><strong>Taille maximale :</strong> 2 GB.</p>
                <p class="doc"><strong>Formats supportés :</strong> docx, pdf, txt, jpg, png </p>
            </div>
        </div>

        <input name="mon_form" type="submit" value="Envoyer le formulaire" />

        <br>
        <div id="confirmationWifi"></div>
    </form>


    <!-- Séparation visuelle entre les deux formulaires -->
    <br>
    <br>
    ################################################
    <br>
    <br>

    <!-- Formulaire hotspot -->
    <form action="" method="POST" id="hospotForm">
        <div id="textHotspot">
            <p>Vous disposez d'un hotspot dans votre établissement ? <br>
            Indiquer la marche à suivre pour se connecter afin que vos voyageurs se connecte facilement</p>
            <br>

            <textarea id="indication" name="indication" rows="5" cols="33">
                ex: Pour vous connectez au wifi, il suffit de choisir le wifi de l'hôtel et de rentrer vos identifiants.
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
        let wifiDiv = document.getElementById("wifiDiv");
        let placewifiDiv = document.getElementById("placewifiDiv");
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
        if(placewifiDiv != null){
            placewifiDiv.appendChild(wifiDiv);
            wifiDiv.removeAttribute("hidden");
        }

        let wifiForm = document.getElementById("wifiForm");

        // Modifie le comportement du formulaire wifi
        wifiForm.addEventListener("submit", function (e) {
            // Désactive le fonctionnement de base du formulaire
            e.preventDefault();

            // Récupère les champs du formulaire
            let nomWifiFr = document.getElementById("nomWifiFr");

            // Passé en commentaire car n'existe pas encore en anglais
            // let wifiTitreEn = document.getElementById("wifiTitreEn");

            // Clé wifi, ne change pas en fonction de la langue ;P
            let cleWifi = document.getElementById("cleWifi");

            let inputFile1 = document.getElementById("file");
            let inputFile2 = document.getElementById("file2");
            let inputFile3 = document.getElementById("file3");

            // Crée un formulaire qui sera envoyé via une requête HTTP par javascript
            var form_data = new FormData();
            form_data.append("module", "wifi");
            form_data.append("action", "create");
            form_data.append("nameWifi", nomWifiFr.value);
            form_data.append("keyWifi", cleWifi.value);

            // Ajoute les fichiers au formulaire
            if(inputFile1.files.length === 1) {
                form_data.append("file1", inputFile1.files[0]);
            }

            if(inputFile2.files.length === 1) {
                form_data.append("file2", inputFile2.files[0]);
            }

            if(inputFile3.files.length === 1) {
                form_data.append("file3", inputFile3.files[0]);
            }

            // Vide les valeurs pour pas envoyer les données deux fois
            nomWifiFr.value = "";
            cleWifi.value = "";

            // for (var pair of form_data.entries()) {
            //     console.log(pair[0]+ ', ' + pair[1]); 
            // }

            // Crée une requête qui enverra le formulaire
            var request = new XMLHttpRequest();
            request.open("POST", "<?= $ACTIONS_URL_WIFI["database"] ?>");
            request.send(form_data);


            request.onreadystatechange = function() {
                if(request.readyState === 4){
                    // Renvoie l'utilisateur vers la liste d'wifi
                    // document.location.href = "<?= $ACTIONS_URL_WIFI["list"] ?>";

                    let confirmationWifi = document.getElementById("confirmationWifi");

                    confirmationWifi.innerHTML = request.response;
                }
            };
        });
    });
</script>

<?php
    $create_wifi_view = ob_get_clean();
?>