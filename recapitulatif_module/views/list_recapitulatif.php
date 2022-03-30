<?php
    // On récupère la liste d'url de notre application
    global $ACTIONS_URL_recapitulatif;

    // Ici on démarre la construction de notre vue
    ob_start();
?>


<div id="recapitulatifListDiv" hidden>
    <ul>



    <!-- Accueil: -->
 <ul>

<?php
    if(count($liste_recapitulatif_accueil) > 0) {
        echo '<h1> Accueil </h1>';
      }
    // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
    // On va donc faire une boucle dessus.
    foreach($liste_recapitulatif_accueil as $recapitulatif_accueil) {
?>
   
    <li>
        <b> <?= $recapitulatif_accueil["titre"] ?> : </b> <?= $recapitulatif_accueil["sstitre"] ?><br>
        <b> <?= $recapitulatif_accueil["titreen"] ?> : </b> <?= $recapitulatif_accueil["sstitreen"] ?><br>
    </li>
    <br>
    <br>
<?php
    // Ici on termine la boucle, de manière à ce que seul les <li> soient répétés
    }
?>

</ul>  

<!-- Digicode: -->
<ul>

<?php
if(count($liste_recapitulatif_digicode) > 0) {
  echo '<h1> Digicode </h1>';
}
    // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
    // On va donc faire une boucle dessus.
    foreach($liste_recapitulatif_digicode as $recapitulatif_digicode) {
?>

    <li>
        <b> <?= $recapitulatif_digicode["titreDigi"] ?> : </b> <?= $recapitulatif_digicode["code"] ?><br>
        <b> <?= $recapitulatif_digicode["titredigicodeEn"] ?>  <br>
    </li>
<?php
    // Ici on termine la boucle, de manière à ce que seul les <li> soient répétés
    }
?>

</ul>  

<!-- Electromenager: -->
<ul>

<?php
    if(count($liste_recapitulatif_electromenager) > 0) {
        echo '<h1> Electroménager </h1>';
      }
    // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
    // On va donc faire une boucle dessus.
    foreach($liste_recapitulatif_electromenager as $recapitulatif_electromenager) {
?>

    <li>
        <b> <?= $recapitulatif_electromenager["titre"] ?> : </b> <?= $recapitulatif_electromenager["descp"] ?><br>
        <b> <?= $recapitulatif_electromenager["	titreen"] ?>  <br><b> <?= $recapitulatif_electromenager["descpen"] ?>  <br>
        <img src="<?= $BASE_URL_FILES . $recapitulatif_electromenager["fichier1"] ?>" >
    </li>
    <br>
    <br>
<?php
    // Ici on termine la boucle, de manière à ce que seul les <li> soient répétés
    }
?>

</ul>
<!-- infoarrivee: -->
<ul>

<?php
    if(count($liste_recapitulatif_infoarrivee) > 0) {
        echo '<h1> Information d `arrivée </h1>';
      }
    // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
    // On va donc faire une boucle dessus.
    foreach($liste_recapitulatif_infoarrivee as $recapitulatif_infoarrivee) {
?>

    <li>
        <b> <?= $recapitulatif_infoarrivee["horaire"] ?> : </b> <?= $recapitulatif_infoarrivee["descp"] ?><br>
        <img src="<?= $BASE_URL_FILES . $recapitulatif_infoarrivee["fichier1"] ?>" >
    </li>
    <br>
    <br>
<?php
    // Ici on termine la boucle, de manière à ce que seul les <li> soient répétés
    }
?>

</ul>
<!-- infodepart: -->
<ul>

<?php
    if(count($liste_recapitulatif_infodepart) > 0) {
        echo '<h1> Information de départ </h1>';
    }
    // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
    // On va donc faire une boucle dessus.
    foreach($liste_recapitulatif_infodepart as $recapitulatif_infodepart) {
?>

    <li>
        <b> <?= $recapitulatif_infodepart["horaire"] ?> : </b> <?= $recapitulatif_infodepart["instruction"] ?><br>
    </li>
    <br>
    <br>
<?php
    // Ici on termine la boucle, de manière à ce que seul les <li> soient répétés
    }
?>

</ul>
<!-- numeroutile: -->
<ul>

<?php
    if(count($liste_recapitulatif_numeroutile) > 0) {
        echo '<h1> Numéros utiles </h1>';
      }
    // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
    // On va donc faire une boucle dessus.
    foreach($liste_recapitulatif_numeroutile as $recapitulatif_numeroutile) {
?>

    <li>
        <b> <?= $recapitulatif_numeroutile["nomcontact"] ?> : </b> <?= $recapitulatif_numeroutile["descp"] ?><br>
        <?= $recapitulatif_numeroutile["tel"] ?>
    </li>
    <br>
    <br>
<?php
    // Ici on termine la boucle, de manière à ce que seul les <li> soient répétés
    }
?>

</ul>
<!-- parkings: -->
<ul>

<?php
    if(count($liste_recapitulatif_parkings) > 0) {
        echo '<h1> Parkings </h1>';
      }
    // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
    // On va donc faire une boucle dessus.
    foreach($liste_recapitulatif_parkings as $recapitulatif_parkings) {
?>

    <li>
        <b> <?= $recapitulatif_parkings["titre"] ?> : </b> <?= $recapitulatif_parkings["descp"] ?><br>
        <b> <?= $recapitulatif_parkings["titreen"] ?> : </b> <?= $recapitulatif_parkings["descpen"] ?><br>
        <img src="<?= $BASE_URL_FILES . $recapitulatif_parkings["fichier1"] ?>" >
    </li>
    <br>
    <br>
<?php
    // Ici on termine la boucle, de manière à ce que seul les <li> soient répétés
    }
?>

</ul>
<!-- poubelles: -->
<ul>

<?php
    if(count($liste_recapitulatif_poubelles) > 0) {
        echo '<h1> Poubelles </h1>';
      }
    // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
    // On va donc faire une boucle dessus.
    foreach($liste_recapitulatif_poubelles as $recapitulatif_poubelles) {
?>

    <li>
        <b> <?= $recapitulatif_poubelles["titre"] ?> : </b> <?= $recapitulatif_poubelles["descp"] ?><br>
        <b> <?= $recapitulatif_poubelles["titreen"] ?> : </b> <?= $recapitulatif_poubelles["descpen"] ?><br>
        <img src="<?= $BASE_URL_FILES . $recapitulatif_poubelles["fichier1"] ?>" >
    </li>
    <br>
    <br>
<?php
    // Ici on termine la boucle, de manière à ce que seul les <li> soient répétés
    }
?>

</ul>
<!-- reglementinterieur: -->
<ul>

<?php
    if(count($liste_recapitulatif_reglementinterieur) > 0) {
        echo '<h1> Règlement intérieur </h1>';
      }
    // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
    // On va donc faire une boucle dessus.
    foreach($liste_recapitulatif_reglementinterieur as $recapitulatif_reglementinterieur) {
?>
    <li>
        <b> <?= $recapitulatif_reglementinterieur["titre"] ?> : </b> <?= $recapitulatif_reglementinterieur["descp"] ?><br>
        <b> <?= $recapitulatif_reglementinterieur["titreen"] ?> : </b> <?= $recapitulatif_reglementinterieur["descpen"] ?><br>
        <img src="<?= $BASE_URL_FILES . $recapitulatif_reglementinterieur["fichier1"] ?>" >
    </li>
    <br>
    <br>
<?php
    // Ici on termine la boucle, de manière à ce que seul les <li> soient répétés
    }
?>

</ul>
<!-- transports: -->
<ul>

<?php
    if(count($liste_recapitulatif_transports) > 0) {
        echo '<h1> Transports </h1>';
      }
    // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
    // On va donc faire une boucle dessus.
    foreach($liste_recapitulatif_transports as $recapitulatif_transports) {
?>
    <li>
        <b> <?= $recapitulatif_transports["titre"] ?> : </b> <?= $recapitulatif_transports["descp"] ?><br>
        <b> <?= $recapitulatif_transports["titreen"] ?> : </b> <?= $recapitulatif_transports["descpen"] ?><br>
        <img src="<?= $BASE_URL_FILES . $recapitulatif_transports["fichier1"] ?>" >
    </li>
    <br>
    <br>
<?php
    // Ici on termine la boucle, de manière à ce que seul les <li> soient répétés
    }
?>

</ul>
<!-- wifi: -->
<ul>

<?php
    if(count($liste_recapitulatif_wifi) > 0) {
        echo '<h1> Wifi </h1>';
      }
    // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
    // On va donc faire une boucle dessus.
    foreach($liste_recapitulatif_wifi as $recapitulatif_wifi) {
?>
    <li>
    <b> <?= $recapitulatif_wifi["nomWifiFr"] ?> : </b> <?= $recapitulatif_wifi["cleWifi"] ?><br>
    <b> <?= $recapitulatif_wifi["nameWifi"] ?> : </b> <?= $recapitulatif_wifi["keyWifi"] ?><br>

    </li>
    <br>
    <br>
<?php
    // Ici on termine la boucle, de manière à ce que seul les <li> soient répétés
    }
?>

</ul>
<!-- hotspot: -->
<ul>

<?php
    if(count($liste_recapitulatif_hotspot) > 0) {
        echo '<h1> Hotspot </h1>';
      }
    // Ici on a accès à la variable $liste_tests définie dans le fichier précédent
    // On va donc faire une boucle dessus.
    foreach($liste_recapitulatif_hotspot as $recapitulatif_hotspot) {
?>
    <li>
 <?= $recapitulatif_hotspot["indication"] ?><br><?= $recapitulatif_hotspot["indicationEn"] ?><br>

    </li>
    <br>
    <br>
<?php
    // Ici on termine la boucle, de manière à ce que seul les <li> soient répétés
    }
?>

</ul>
</div>


<script>
    // On attend que tous les éléments de la page soient chargés
    document.addEventListener("DOMContentLoaded", function(event) {
        
        // Maintenant on écrit notre code qui va permettre de placer notre division déclarée plus haut au bon endroit dans la page

        let recapitulatifListDiv = document.getElementById("recapitulatifListDiv");
        let placerecapitulatifListDiv = document.getElementById("placerecapitulatifListDiv");

        // Si la div de destination est présente
        if(placerecapitulatifListDiv != null){
            // Déplace notre div
            placerecapitulatifListDiv.appendChild(recapitulatifListDiv);


            // Enlève l'attribut hidden
            recapitulatifListDiv.removeAttribute("hidden");
        }
    });
    
</script>

<?php
    // On stock le contenu généré dans une variable :
    $list_recapitulatif_view = ob_get_clean();
?>










