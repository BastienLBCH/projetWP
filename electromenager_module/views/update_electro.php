<?php
    global $ACTIONS_URL_electro;

    ob_start();
?>

<div id="electroDiv" hidden>
    <form method="POST" id="electroForm">
        <!-- Titre -->
        <label for="name">Titre:</label>
        <input type="text" id="titre" name="titre" value="<?= $electro["titre"] ?>">

        <div class="inputAnglais">
        <label  for="titreEn">Choose your title:</label>
        <input  type="text" id="titreEn" value="<?= $electro["titreen"] ?>" minlength="4" maxlength="75" size="75">
    </div>
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
        <label for="name">Description:</label>
        <textarea id="descp" name="descp"rows="5" cols="33">
<?= $electro["descp"] ?>
        </textarea>

        <div class="inputAnglais">
        <label for="name">Description:</label>
        <textarea id="descpen" name="descp"rows="5" cols="33"><?= $electro["descpen"] ?>
        </textarea>
    </div>
        
        <p>
            <img src="https://img.icons8.com/ios-glyphs/30/000000/info--v1.png"> Max. 1500 caractères.
        </p>

        <input type="submit" name="my_form" value="Envoyer le formulaire">
    </form>
    <div id="confirmationelectro"></div>
</div>


<script>
    // On attend que tous les éléments de la page soient chargés
    document.addEventListener("DOMContentLoaded", function(event) {
        
        // Récupère les éléments
        let electroDiv = document.getElementById("electroDiv");
        let placeelectroDiv = document.getElementById("placeelectroDiv");
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
        if(placeelectroDiv != null){
            placeelectroDiv.appendChild(electroDiv);
            electroDiv.removeAttribute("hidden");
        }

        let electroForm = document.getElementById("electroForm");

        // Modifie le comportement du formulaire electro
        electroForm.addEventListener("submit", function (e) {
            // Désactive le fonctionnement de base du formulaire
            e.preventDefault();

            // Récupère les champs du formulaire
            let nomelectroFr = document.getElementById("titre");
            let nomelectroEn = document.getElementById("titreEn");
            // Passé en commentaire car n'existe pas encore en anglais
            // let electroTitreEn = document.getElementById("electroTitreEn");

            // Description electro, ne change pas en fonction de la langue 
            let descpelectro = document.getElementById("descp");
            let descelectroEn = document.getElementById("descpen");
            let inputFile1 = document.getElementById("file");
            let inputFile2 = document.getElementById("file2");
            let inputFile3 = document.getElementById("file3");

            // Crée un formulaire qui sera envoyé via une requête HTTP par javascript
            var form_data = new FormData();
            form_data.append("module", "electromenage");
            form_data.append("action", "update");
            form_data.append("id", "<?= $_GET["electro_id"] ?>");
            form_data.append("titre", nomelectroFr.value);
            form_data.append("descp", descpelectro.value);
            form_data.append("titreen", nomelectroEn.value);
            form_data.append("descpen", descelectroEn.value);
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
            nomelectroFr.value = "";
            descpelectro.value = "";    
            nomelectroEn.value = "";
            descelectroEn.value = "";

            // Crée une requête qui enverra le formulaire
            var request = new XMLHttpRequest();
            request.open("POST", "<?= $ACTIONS_URL_electro["database"] ?>");
            request.send(form_data);


            request.onreadystatechange = function() {
                if(request.readyState === 4){
                    // Renvoie l'utilisateur vers la liste d'electro
                    document.location.href = "<?= $ACTIONS_URL_electro["list"] ?>";

                }
            };
        });
    });
</script>

<?php
    $update_electro_view = ob_get_clean();
?>