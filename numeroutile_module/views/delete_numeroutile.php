<?php
    global $ACTIONS_URL_NUMEROUTILS;

    ob_start();
?>

<script>
    // Crée un formulaire qui sera envoyé via une requête JS
    var form_data = new FormData();
    form_data.append("module", "numeroutile");
    form_data.append("action", "delete");
    form_data.append("id", "<?= $_GET["numeroutile_id"] ?>");

    // Crée une requête qui enverra le formulaire
    var request = new XMLHttpRequest();
    request.open("POST", "<?= $ACTIONS_URL_NUMEROUTILS["database"] ?>");
    request.send(form_data);
    
    request.onreadystatechange = function() {
        if(request.readyState === 4){
            // Renvoie l'utilisateur vers la liste des numeros utiles
            document.location.href = "<?= $ACTIONS_URL_NUMEROUTILS["list"] ?>";
        }
    };
</script>

<?php
    $detele_numeroutile_view = ob_get_clean();
?>