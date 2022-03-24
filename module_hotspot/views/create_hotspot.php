<?php
    global $ACTIONS_URL_HOTSPOT;

    ob_start();
?>

<div id="hotspotDiv" hidden>
<a href="http://www.livret-accueil-numerique.fr/wifi-hotspot-2/?action_module=list_wifi"> Classique</a>
    <!-- Formulaire hotspot -->
    <form action="" method="POST" id="hotspotForm">
        <div id="textHotspot">
            <p>Vous disposez d'un hotspot dans votre établissement ? <br>
            Indiquer la marche à suivre pour se connecter afin que vos voyageurs se connecte facilement</p>
            <br>
            <div class="inputAnglais">
            <p>Do you have a hotspot in your establishment? <br>
            Indicate how to connect so that your travelers can easily connect</p>
            <br>
                </div>
            <textarea id="indication" name="indication" rows="5" cols="33">
                ex: Pour vous connectez au wifi, il suffit de choisir le wifi de l'hôtel et de rentrer vos identifiants.
            </textarea>
            <div class="inputAnglais">
            <textarea id="indicationEn" name="indication" rows="5" cols="33">
                ex: To connect to the wifi, you just have to choose the hotel wifi and enter your identifiers.
            </textarea>
            <br>
                </div>

            <div class="upload">
                <p class="doc">Documents: </p>
                <input type="file" name="film" id="file" class="doc" multiple="">
                <input type="file" name="film" id="file2" class="doc" multiple="">
                <input type="file" name="film" id="file3" class="doc" multiple="">
                <p class="doc"><strong>Taille maximale :</strong> 2 GB.</p>
                <p class="doc"><strong>Formats supportés :</strong> docx, pdf, txt, jpg, png </p>
            </div>
            <img id="clickFlag" src="https://img.icons8.com/color/48/000000/great-britain.png">
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
            let indicationEn = document.getElementById("indicationEn");

            let inputFile1 = document.getElementById("file");
            let inputFile2 = document.getElementById("file2");
            let inputFile3 = document.getElementById("file3");

            let userID = document.getElementById("user_id").getAttribute("value");

            // Crée un formulaire qui sera envoyé via une requête HTTP par javascript
            var form_data = new FormData();
            form_data.append("module", "hotspot");
            form_data.append("action", "create");
            form_data.append("id_user", userID);
            form_data.append("indication", indicationHotspot.value);
            form_data.append("indicationEn", indicationEn.value);

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
            indicationEn.value = "";

            // Crée une requête qui enverra le formulaire
            var request = new XMLHttpRequest();
            request.open("POST", "<?= $ACTIONS_URL_HOTSPOT["database"] ?>");
            request.send(form_data);


            request.onreadystatechange = function() {
                if(request.readyState === 4){
                    // Renvoie l'utilisateur vers la liste d'wifi
                    document.location.href = "<?= $ACTIONS_URL_HOTSPOT["list"] ?>";

                }
            };
        });
    });
</script>

<?php
    $create_hotspot_view = ob_get_clean();
?>