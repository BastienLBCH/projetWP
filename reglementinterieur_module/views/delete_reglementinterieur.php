<?php
    global $ACTIONS_URL_reglementinterieur;

    ob_start();
?>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        // Crée un formulaire qui sera envoyé via une requête JS
        var form_data = new FormData();
        form_data.append("module", "reglementinterieur");
        form_data.append("action", "delete");
        form_data.append("id", "<?= $_GET["reglementinterieur_id"] ?>");

        let placereglementinterieurDiv = document.getElementById("placereglementinterieurDiv");

        // Crée une requête qui enverra le formulaire
        var request = new XMLHttpRequest();
        request.open("POST", "<?= $ACTIONS_URL_reglementinterieur["database"] ?>");
        request.send(form_data);

        request.onreadystatechange = function() {
            if(request.readyState === 4){
                // Renvoie l'utilisateur vers la liste d'reglementinterieur
                document.location.href = "<?= $ACTIONS_URL_reglementinterieur["list"] ?>";

                // placereglementinterieurDiv.innerHTML = request.response;
            }
        };
    });
</script>

<?php
    $detele_reglementinterieur_view = ob_get_clean();
?>