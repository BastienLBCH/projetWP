<?php

$db = new PDO('mysql:host=localhost;dbname=livret_accueil;', 'marie.blanc', 'cjbS8l1aiGTBXLEx');

// require("../settings.php");

function move_files($files) {
    require("../settings.php");

    // Définit le dossier dans lequel on va sauvegarder le fichier uploadé
    $DEST_DIRECTORY_WIFI_FILES = "/srv/data/web/vhosts/www.livret-accueil-numerique.fr/htdocs/wp-content/plugins/wifi_module/medias/";

    // Base URL pour récupérer les fichiers
    $BASE_URL_WIFI_FILES = "www.livret-accueil-numerique.fr/htdocs/wp-content/wifi_module/medias/";

    // Déplace les fichiers envoyés
    $files_url = array();
    foreach($files as $key => $file) {
        $extension = explode('.', $file["name"]);
        $new_name = bin2hex(random_bytes(8)) . "." . $extension[array_key_last($extension)];

        $dest = $DEST_DIRECTORY_WIFI_FILES . $new_name;
        $fileURL = $BASE_URL_WIFI_FILES . $new_name;

        move_uploaded_file($file["tmp_name"], $dest);

        $files_url[$key] = array(
            "url" => $fileURL,
            "absolute_path" => $dest,
            "filename" => $new_name
        );
    }

    return $files_url;
}


function db_create_wifi($data, $files=false){
    global $db;

    // Génère le fichier d'execution de la requête et la requête
    $execution_array = array(
        "_textClassique" => $data["textClassique"],
        "_nameWifi" => $data["nameWifi"],
        "_keyWifi" => $data["keyWifi"]
    );

    $liste_fichiers = "";
    $liste_cles = "";
    if($files != false) {
        $files_urls = move_files($files);

        foreach(array_keys($files) as $fichier) {
            // Vaudra : , fichier1, fichier2, fichier3
            // Comme ça quand on l'ajoute à la requête ça donne :
            // INSERT INTO wifi (textClassique, nameWifi, keyWifi , fichier1, fichier2, fichier 3)
            $liste_fichiers = $liste_fichiers . ", $fichier";


            // Vaudra : , :_fichier1, :_fichier2, :_fichier3
            // Comme ça quand on l'ajoute à la requête ça donne :
            //INSERT INTO [...] VALUES (:_textClassique, :_nameWifi, :_keyWifi , :_fichier1, :_fichier2, :_fichier3)
            $liste_cles = $liste_cles . ", :_$fichier";


            // Ajoute les fichiers dans le dictionnaire qui servira a exécuter la requête
            $execution_array["_$fichier"] = $files_urls[$fichier]["filename"];
        }
    }

    // Génère la requête sql en fonction des fichiers présents
    $sql = "INSERT INTO wifi (textClassique, nameWifi, keyWifi $liste_fichiers) VALUES (:_textClassique, :_nameWifi, :_keyWifi $liste_cles)";


    $query = $db->prepare($sql);

    $result = $query->execute($execution_array);
}


function db_get_wifi($wifi_id) {
    global $db;

    $sql = "SELECT * FROM wifi WHERE id=:_id";

    $query = $db->prepare($sql);
    $query->execute(array(
        "_id" => $wifi_id
    ));

    return $query->fetch();
}

function db_update_wifi($data) {
    global $db;

    $sql = "UPDATE wifi SET titre=:_titre, sstitre=:_sstitre, titreen=:_titreen, sstitreen=:_sstitreen WHERE id=:_id";
    $query = $db->prepare($sql);
    $query->execute(array(
        "_titre" => $data["titre"],
        "_sstitre" => $data["sstitre"],
        "_titreen" => $data["titreen"],
        "_sstitreen" => $data["sstitreen"],
        "_id" => $data["id"]
    ));

}


function db_delete_wifi($data) {
    global $db;
    $sql = "DELETE FROM wifi WHERE id=:_id";
    $query = $db->prepare($sql);
    $query->execute(array(
        "_id" => $data["id"]
    ));
}


function db_list_wifi(){
    global $db;

    $sql = "SELECT * FROM wifi";
    $query = $db->prepare($sql);
    $query->execute();

    $list_wifi = $query->fetchAll();
    return $list_wifi;
}


// $_POST = $_GET;
if(isset($_POST["module"]) && isset($_POST["action"])) {
    $actions_mapping = [
        "create" => "db_create_wifi",
        "update" => "db_update_wifi",
        "delete" => "db_delete_wifi"
    ];

    $module = $_POST["module"];
    $action = $_POST["action"];

    if( $module == "wifi" && array_key_exists($action, $actions_mapping) ){
        if(isset($_FILES)) {
            $actions_mapping[$_POST["action"]]($_POST, $_FILES);
        }
        else {
            $actions_mapping[$_POST["action"]]($_POST);
        }
    }
}

?>