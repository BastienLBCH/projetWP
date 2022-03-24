<?php
    global $ACTIONS_URL_parkings;

    ob_start();
?>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        // Crée un formulaire qui sera envoyé via une requête JS
        var form_data = new FormData();
        form_data.append("module", "parkings");
        form_data.append("action", "delete");
        form_data.append("id", "<?= $_GET["parkings_id"] ?>");

        let placeparkingsDiv = document.getElementById("placeparkingsDiv");

        // Crée une requête qui enverra le formulaire
        var request = new XMLHttpRequest();
        request.open("POST", "<?= $ACTIONS_URL_parkings["database"] ?>");
        request.send(form_data);

        request.onreadystatechange = function() {
            if(request.readyState === 4){
                // Renvoie l'utilisateur vers la liste d'parkings
                document.location.href = "<?= $ACTIONS_URL_parkings["list"] ?>";

                // placeparkingsDiv.innerHTML = request.response;
            }
        };
    });
</script>

<?php
    $detele_parkings_view = ob_get_clean();
?>