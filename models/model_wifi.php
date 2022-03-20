<?php

$db = new PDO('mysql:host=localhost;dbname=livret_accueil;', 'marie.blanc', 'cjbS8l1aiGTBXLEx');

require("../settings.php");

function move_files($files) {
    // Définit le dossier dans lequel on va sauvegarder le fichier uploadé
    global $DEST_DIRECTORY_WIFI_FILES;

    // Base URL pour récupérer les fichiers
    global $BASE_URL_WIFI_FILES;

    // Déplace les fichiers envoyés
    $files_url = array();
    foreach($files as $key => $file) {
        $extension = explode('.', $file["name"])[1];
        $new_name = bin2hex(random_bytes(8)) . "." . $extension;

        $dest = $DEST_DIRECTORY_WIFI_FILES . $file["name"];
        $fileURL = $BASE_URL_WIFI_FILES . $new_name;

        move_uploaded_file($file["tmp_name"], $dest);

        echo $file["tmp_name"] . '<br>' . $dest . '<br><br>';

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
    if($_FILES != false) {
        $files_urls = move_files($files);


        foreach(array_keys($files) as $fichier) {
            $liste_fichiers = $liste_fichiers . ", $fichier";
            $liste_cles = $liste_cles . ", :_$fichier";

            $execution_array["_$fichier"] = $files_urls[$fichier]["name"];
        }
    }


    $sql = "INSERT INTO wifi 
        (textClassique, nameWifi, keyWifi $liste_fichiers) 
        VALUES (:_textClassique, :_nameWifi, :_keyWifi $liste_cles)";
    

    echo $sql . '<br>';
    print_r($execution_array);

    $query = $db->prepare($sql);

    $query->execute($execution_array);
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