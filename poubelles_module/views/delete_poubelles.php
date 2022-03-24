<?php
    global $ACTIONS_URL_poubelles;

    ob_start();
?>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        // Crée un formulaire qui sera envoyé via une requête JS
        var form_data = new FormData();
        form_data.append("module", "poubelles");
        form_data.append("action", "delete");
        form_data.append("id", "<?= $_GET["poubelles_id"] ?>");

        let placepoubellesDiv = document.getElementById("placepoubellesDiv");

        // Crée une requête qui enverra le formulaire
        var request = new XMLHttpRequest();
        request.open("POST", "<?= $ACTIONS_URL_poubelles["database"] ?>");
        request.send(form_data);

        request.onreadystatechange = function() {
            if(request.readyState === 4){
                // Renvoie l'utilisateur vers la liste d'poubelles
                document.location.href = "<?= $ACTIONS_URL_poubelles["list"] ?>";

                // placepoubellesDiv.innerHTML = request.response;
            }
        };
    });
</script>

<?php
    $detele_poubelles_view = ob_get_clean();
?>