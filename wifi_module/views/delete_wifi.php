<?php
    global $ACTIONS_URL;

    ob_start();
?>

<script>
    // Crée un formulaire qui sera envoyé via une requête JS
    var form_data = new FormData();
    form_data.append("module", "wifi");
    form_data.append("action", "delete");
    form_data.append("id", "<?= $_GET["wifi_id"] ?>");

    // Crée une requête qui enverra le formulaire
    var request = new XMLHttpRequest();
    request.open("POST", "<?= $ACTIONS_URL["database"] ?>");
    request.send(form_data);
    
    request.onreadystatechange = function() {
        if(request.readyState === 4){
            // Renvoie l'utilisateur vers la liste d'wifi
            document.location.href = "<?= $ACTIONS_URL["list"] ?>";
        }
    };
</script>

<?php
    $detele_wifi_view = ob_get_clean();
?>