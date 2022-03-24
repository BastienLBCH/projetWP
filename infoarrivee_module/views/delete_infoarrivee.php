<?php
    global $ACTIONS_URL_infoarrivee;

    ob_start();
?>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        // Crée un formulaire qui sera envoyé via une requête JS
        var form_data = new FormData();
        form_data.append("module", "infoarrivee");
        form_data.append("action", "delete");
        form_data.append("id", "<?= $_GET["infoarrivee_id"] ?>");

        let placeinfoarriveeDiv = document.getElementById("placeinfoarriveeDiv");

        // Crée une requête qui enverra le formulaire
        var request = new XMLHttpRequest();
        request.open("POST", "<?= $ACTIONS_URL_infoarrivee["database"] ?>");
        request.send(form_data);

        request.onreadystatechange = function() {
            if(request.readyState === 4){
                // Renvoie l'utilisateur vers la liste d'infoarrivee
                document.location.href = "<?= $ACTIONS_URL_infoarrivee["list"] ?>";

                // placeinfoarriveeDiv.innerHTML = request.response;
            }
        };
    });
</script>

<?php
    $detele_infoarrivee_view = ob_get_clean();
?>