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


function move_files_recapitulatif($files) {

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




function db_get_module_recapitulatif($module, $module_id) {
    global $db;

    $sql = "SELECT * FROM $module WHERE id=:_id";

    $query = $db->prepare($sql);
    $query->execute(array(
        "_id" => $module_id
    ));

    return $query->fetch();
}




function get_fichiers_columns_recapitulatif($module){
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




function db_list_module_recapitulatif($module, $user_id){
    global $db;

    $sql = "SELECT * FROM $module WHERE id_user=:_id_user";
    $query = $db->prepare($sql);
    $query->execute(array(
        '_id_user' => $user_id,
    ));

    $list_module = $query->fetchAll();
    return $list_module;
}



?>