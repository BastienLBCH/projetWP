<?php
    global $ACTIONS_URL_transports;

    ob_start();
?>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        // Crée un formulaire qui sera envoyé via une requête JS
        var form_data = new FormData();
        form_data.append("module", "transports");
        form_data.append("action", "delete");
        form_data.append("id", "<?= $_GET["transports_id"] ?>");

        let placetransportsDiv = document.getElementById("placetransportsDiv");

        // Crée une requête qui enverra le formulaire
        var request = new XMLHttpRequest();
        request.open("POST", "<?= $ACTIONS_URL_transports["database"] ?>");
        request.send(form_data);

        request.onreadystatechange = function() {
            if(request.readyState === 4){
                // Renvoie l'utilisateur vers la liste d'transports
                document.location.href = "<?= $ACTIONS_URL_transports["list"] ?>";

                // placetransportsDiv.innerHTML = request.response;
            }
        };
    });
</script>

<?php
    $detele_transports_view = ob_get_clean();
?>