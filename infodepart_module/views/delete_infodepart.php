<?php
    global $ACTIONS_URL_infodepart;

    ob_start();
?>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        // Crée un formulaire qui sera envoyé via une requête JS
        var form_data = new FormData();
        form_data.append("module", "infodepart");
        form_data.append("action", "delete");
        form_data.append("id", "<?= $_GET["infodepart_id"] ?>");

        let placeinfodepartDiv = document.getElementById("placeinfodepartDiv");

        // Crée une requête qui enverra le formulaire
        var request = new XMLHttpRequest();
        request.open("POST", "<?= $ACTIONS_URL_infodepart["database"] ?>");
        request.send(form_data);

        request.onreadystatechange = function() {
            if(request.readyState === 4){
                // Renvoie l'utilisateur vers la liste d'infodepart
                document.location.href = "<?= $ACTIONS_URL_infodepart["list"] ?>";

                // placeinfodepartDiv.innerHTML = request.response;
            }
        };
    });
</script>

<?php
    $detele_infodepart_view = ob_get_clean();
?>