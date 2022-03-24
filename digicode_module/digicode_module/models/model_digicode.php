<?php

$db = new PDO('mysql:host=localhost;dbname=livret_accueil;', 'marie.blanc', 'cjbS8l1aiGTBXLEx');

function db_create_digicode($data){
    global $db;

    $sql = "INSERT INTO digicode (titreDigi, code, titredigicodeEn) VALUES (:_titreDigi, :_code, :_titredigicodeEn)";
    
    $query = $db->prepare($sql);

    $query->execute(array(
        "_titreDigi" => $data["titreDigi"],
        "_code" => $data["code"],
        "_titredigicodeEn" => $data["titredigicodeEn"]
    ));
    $db =null;
}


function db_get_digicode($digicode_id) {
    global $db;

    $sql = "SELECT * FROM digicode WHERE id=:_id";

    $query = $db->prepare($sql);
    $query->execute(array(
        "_id" => $digicode_id
    ));

    return $query->fetch();
    $db =null;
}

function db_update_digicode($data) {
    global $db;

    $sql = "UPDATE digicode SET titreDigi=:_titreDigi, code=:_code, titredigicodeEn=:_titredigicodeEn WHERE id=:_id";
    $query = $db->prepare($sql);
    $query->execute(array(
        "_titreDigi" => $data["titreDigi"],
        "_code" => $data["code"],
        "_titredigicodeEn" => $data["titredigicodeEn"],
        "_id" => $data["id"]
    ));
    $db =null;
}


function db_delete_digicode($data) {
    global $db;
    $sql = "DELETE FROM digicode WHERE id=:_id";
    $query = $db->prepare($sql);
    $query->execute(array(
        "_id" => $data["id"]
    ));
    $db =null;
}


function db_list_digicode(){
    global $db;

    $sql = "SELECT * FROM digicode";
    $query = $db->prepare($sql);
    $query->execute();

    $list_digicode = $query->fetchAll();
    return $list_digicode;
    $db =null;
}


// $_POST = $_GET;
if(isset($_POST["module"]) && isset($_POST["action"])) {
    $actions_mapping = [
        "create" => "db_create_digicode",
        "update" => "db_update_digicode",
        "delete" => "db_delete_digicode"
    ];

    $module = $_POST["module"];
    $action = $_POST["action"];

    if( $module == "digicode" && array_key_exists($action, $actions_mapping) ){
        $actions_mapping[$_POST["action"]]($_POST);
    }
}


?>