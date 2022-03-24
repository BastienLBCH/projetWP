<?php

$db = new PDO('mysql:host=localhost;dbname=livret_accueil;', 'marie.blanc', 'cjbS8l1aiGTBXLEx');

// Définit le dossier dans lequel on va sauvegarder le fichier uploadé
$DEST_DIRECTORY_WIFI_FILES = "/srv/data/web/vhosts/www.livret-accueil-numerique.fr/htdocs/wp-content/medias/";

// Base URL pour récupérer les fichiers
$BASE_URL_WIFI_FILES = "www.livret-accueil-numerique.fr/htdocs/wp-content/plugins/medias/";


// Reserved keys
$reserved_keys = array(
    "action",
    "module",
    "id",
);


function move_files_reglementinterieur($files) {

    global $DEST_DIRECTORY_WIFI_FILES;
    global $BASE_URL_WIFI_FILES;

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


function delete_files_reglementinterieur($data, $files) {
    global $DEST_DIRECTORY_WIFI_FILES;
    global $BASE_URL_WIFI_FILES;


    global $db;
    $module = $data["module"];
    $module_id = $data["id"];

    // List the files that will be updated
    $files_in_request = [];
    if($files != false) {

        foreach(array_keys($files) as $key) {
            $files_in_request[] = $key;
        }

    }

    $files_in_request_str = implode(",", $files_in_request);
    // Get the filenames from the database
    $sql = "SELECT $files_in_request_str FROM $module WHERE id=$module_id";

    $query = $db->prepare($sql);
    $query->execute();
    $files_to_delete = $query->fetch();

    foreach($files_in_request as $file) {
        $file_absolute_path = $DEST_DIRECTORY_WIFI_FILES . $files_to_delete[$file];
        unlink($file_absolute_path);
    }
}


function db_create_module_reglementinterieur($data, $files=false){
    global $db;
    global $reserved_keys;

    // Génère les arguments
    $execution_array = array();
    $args = "";
    $liste_cles = "";
    $liste_fichiers = "";
    $module = $data["module"];

    foreach($data as $key => $value){
        if(!in_array($key, $reserved_keys)){
            $execution_array["_$key"] = $value;

            $args = $args . ", $key";
            $liste_cles = $liste_cles . ", :_$key";
        }
    }


    // Insère les fichiers
    if($files != false) {
        $files_urls = move_files_reglementinterieur($files);

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


    $args = substr($args, 1);
    $liste_cles = substr($liste_cles, 1);

    // Génère la requête sql en fonction des arguments présents
    $sql = "INSERT INTO $module ($args $liste_fichiers) VALUES ($liste_cles)";

    $query = $db->prepare($sql);

    $query->execute($execution_array);
}


function db_get_module_reglementinterieur($module, $module_id) {
    global $db;

    $sql = "SELECT * FROM $module WHERE id=:_id";

    $query = $db->prepare($sql);
    $query->execute(array(
        "_id" => $module_id
    ));

    return $query->fetch();
}


function db_update_module_reglementinterieur($data, $files=false) {
    global $db;
    global $reserved_keys;
    
    
    // Génère les arguments
    $execution_array = array();
    $args = "";
    $liste_cles = "";

    $module = $data["module"];

    foreach($data as $key => $value) {
        if(!in_array($key, $reserved_keys)){
            $args = $args . ", $key = :_$key";
            $execution_array["_$key"] = $value;
        }
        elseif($key == "id"){
            $execution_array["_id"] = $value;
        }
    }

    if($files != false) {
        delete_files_reglementinterieur($data, $files);

        $uploaded_files = move_files_reglementinterieur($files);

        foreach(array_keys($files) as $filename) {
            $args = $args . ", $filename = :_$filename";

            $execution_array["_$filename"] = $uploaded_files[$filename]["filename"];
        }
    }

    $args = substr($args, 1);
    $liste_cles = substr($liste_cles, 1);

    // Génère la requête sql en fonction des arguments présents
    $sql = "UPDATE $module SET $args WHERE id=:_id";

    $query = $db->prepare($sql);
    $query->execute($execution_array);
}   


function get_fichiers_columns_reglementinterieur($module){
    global $db;

    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'livret_accueil' AND TABLE_NAME = '$module' AND COLUMN_NAME REGEXP 'fichier*'";

    $query = $db->prepare($sql);
    $query->execute();

    $result = $query->fetchAll();

    $columns = array();
    foreach($result as $column) {
        $columns[] = $column[0];
    }

    return $columns;
}


function delete_register_files_reglementinterieur($columns, $module, $module_id) {
    global $db;
    global $DEST_DIRECTORY_WIFI_FILES;

    $columns_text = implode(',', $columns);

    $sql = "SELECT $columns_text FROM $module WHERE id=:_id";

    $query = $db->prepare($sql);

    $query->execute(array(
        '_id' => $module_id,
    ));

    $result = $query->fetch();

    foreach(array_keys($result) as $key) {
        if(in_array($key, $columns)) {
            $file_to_delete = $DEST_DIRECTORY_WIFI_FILES . $result[$key];
            unlink($file_to_delete);
        }
    }
}


function db_delete_module_reglementinterieur($data) {
    global $db;

    $module = $data["module"];

    $columns = get_fichiers_columns_reglementinterieur($module);
    
    delete_register_files_reglementinterieur($columns, $data["module"], $data["id"]);

    $sql = "DELETE FROM $module WHERE id=:_id";

    $query = $db->prepare($sql);

    $query->execute(array(
        '_id' => $data["id"]
    ));
}


function db_list_module_reglementinterieur($module){
    global $db;

    $sql = "SELECT * FROM $module";
    $query = $db->prepare($sql);
    $query->execute();

    $list_module = $query->fetchAll();
    return $list_module;
}


// $_POST = $_GET;
if(isset($_POST["module"]) && isset($_POST["action"])) {
    $actions_mapping = [
        "create" => "db_create_module_reglementinterieur",
        "update" => "db_update_module_reglementinterieur",
        "delete" => "db_delete_module_reglementinterieur"
    ];

    $action = $_POST["action"];

    if(array_key_exists($action, $actions_mapping) ){
        if(isset($_FILES)) {
            $actions_mapping[$_POST["action"]]($_POST, $_FILES);
        }
        else {
            $actions_mapping[$_POST["action"]]($_POST);
        }
    }
}

?>