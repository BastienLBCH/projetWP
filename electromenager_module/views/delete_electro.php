<?php
    global $ACTIONS_URL_electro;

    ob_start();
?>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        // Crée un formulaire qui sera envoyé via une requête JS
        var form_data = new FormData();
        form_data.append("module", "electromenage");
        form_data.append("action", "delete");
        form_data.append("id", "<?= $_GET["electro_id"] ?>");

        let placeelectroDiv = document.getElementById("placeelectroDiv");

        // Crée une requête qui enverra le formulaire
        var request = new XMLHttpRequest();
        request.open("POST", "<?= $ACTIONS_URL_electro["database"] ?>");
        request.send(form_data);

        request.onreadystatechange = function() {
            if(request.readyState === 4){
                // Renvoie l'utilisateur vers la liste d'electro
                document.location.href = "<?= $ACTIONS_URL_electro["list"] ?>";

                // placeelectroDiv.innerHTML = request.response;
            }
        };
    });
</script>

<?php
    $detele_electro_view = ob_get_clean();
?>