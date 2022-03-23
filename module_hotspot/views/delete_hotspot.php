<?php
    global $ACTIONS_URL_WIFI;

    ob_start();
?>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        // Crée un formulaire qui sera envoyé via une requête JS
        var form_data = new FormData();
        form_data.append("module", "wifi");
        form_data.append("action", "delete");
        form_data.append("id", "<?= $_GET["wifi_id"] ?>");

        let placewifiDiv = document.getElementById("placewifiDiv");

        // Crée une requête qui enverra le formulaire
        var request = new XMLHttpRequest();
        request.open("POST", "<?= $ACTIONS_URL_WIFI["database"] ?>");
        request.send(form_data);

        request.onreadystatechange = function() {
            if(request.readyState === 4){
                // Renvoie l'utilisateur vers la liste d'wifi
                document.location.href = "<?= $ACTIONS_URL_WIFI["list"] ?>";
            }
        };
    });
</script>

<?php
    $detele_wifi_view = ob_get_clean();
?>