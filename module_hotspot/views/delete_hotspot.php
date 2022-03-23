<?php
    global $ACTIONS_URL_HOTSPOT;

    ob_start();
?>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        // Crée un formulaire qui sera envoyé via une requête JS
        var form_data = new FormData();
        form_data.append("module", "hotspot");
        form_data.append("action", "delete");
        form_data.append("id", "<?= $_GET["hotspot_id"] ?>");

        let placewifiDiv = document.getElementById("placeHotspotDiv");

        // Crée une requête qui enverra le formulaire
        var request = new XMLHttpRequest();
        request.open("POST", "<?= $ACTIONS_URL_HOTSPOT["database"] ?>");
        request.send(form_data);

        request.onreadystatechange = function() {
            if(request.readyState === 4){
                // Renvoie l'utilisateur vers la liste de hotspot
                document.location.href = "<?= $ACTIONS_URL_HOTSPOT["list"] ?>";
            }
        };
    });
</script>

<?php
    $detele_hotspot_view = ob_get_clean();
?>