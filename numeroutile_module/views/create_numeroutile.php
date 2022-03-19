<?php
    global $ACTIONS_URL_NUMEROUTILS;

    ob_start();
?>

<div id="numeroutileDiv" hidden>

    <form id="nuForm">
        <img src="https://img.icons8.com/glyph-neue/64/000000/policeman-male.png"> <p>Police 17</p>

        <img src="https://img.icons8.com/glyph-neue/50/000000/fireman-male.png">
        <p>Pompier 18</p>

        <img src="https://img.icons8.com/external-vitaliy-gorbachev-fill-vitaly-gorbachev/50/000000/external-doctor-male-profession-vitaliy-gorbachev-fill-vitaly-gorbachev-1.png"><p>Urgences 112</p>

        <h3>Ajoutez vos numéros utiles :</h3>
        
        <label for="name">Nom du contact:</label>
        <input type="text" id="nomContact" name="nomContact">
        
        <label for="name">Description:</label>
        <input type="text" id="descp" name="descp">
        
        <label for="name">Téléphone:</label>
        <input type="text" id="tel" name="tel">

        <div id="ajoutNum"></div>
        <button id="ajoutNumero" type="button">Ajouter un numéro</button>
        <input type="submit" name="mon_form" value="Envoyer le formulaire" >
    </form>
</div>


<script>
    // On attend que tous les éléments de la page soient chargés
    document.addEventListener("DOMContentLoaded", function(event) {
        // Place le formulaire dans la page
        let numeroutileDiv = document.getElementById("numeroutileDiv");
        let placeNumeroutileDiv = document.getElementById("placeNumeroutileDiv");
        let clickFlag = document.getElementsByClassName("clickFlag");
        let inputAnglais = document.getElementsByClassName("inputAnglais");
       
        if(placeNumeroutileDiv != null){
            placeNumeroutileDiv.appendChild(numeroutileDiv);
            numeroutileDiv.removeAttribute("hidden");
        }

        let nuForm = document.getElementById("nuForm");

        // Modifie le comportement du formulaire
        nuForm.addEventListener("submit", function (e) {
            // Désactive le fonctionnement de base du formulaire
            e.preventDefault();

            // Récupère les champs du formulaire
            let nomContact = document.getElementById("nomContact");
            let descp = document.getElementById("descp");
            let tel = document.getElementById("tel");


            // Crée un formulaire qui sera envoyé via une requête JS
            var form_data = new FormData();
            console.log(nomContact.value);

            form_data.append("module", "numeroutile");
            form_data.append("action", "create");
            form_data.append("nomcontact", nomContact.value);
            form_data.append("tel", tel.value);
            form_data.append("descp", descp.value);

            nomContact.value = "";
            tel.value = "";
            descp.value = "";

            
            // Crée une requête qui enverra le formulaire
            var request = new XMLHttpRequest();
            request.open("POST", "<?= $ACTIONS_URL_NUMEROUTILS["database"] ?>");
            request.send(form_data);
            console.log(form_data.entries());


            request.onreadystatechange = function() {
                if(request.readyState === 4){
                    // Renvoie l'utilisateur vers la liste d'accueil
                    document.location.href = "<?= $ACTIONS_URL_NUMEROUTILS["list"] ?>";
                }
            };
        });
    });
</script>

<?php
    $create_numeroutile_view = ob_get_clean();
?>