<?php

$db = new PDO('mysql:host=localhost;dbname=livret_accueil;', 'marie.blanc', 'cjbS8l1aiGTBXLEx');

function db_create_accueil($data){
    global $db;

    $sql = "INSERT INTO accueil (titre, sstitre, titreen, sstitreen) VALUES (:_titre, :_sstitre, :_titreen, :_sstitreen)";
    
    $query = $db->prepare($sql);

    $query->execute(array(
        "_titre" => $data["titre"],
        "_sstitre" => $data["sstitre"],
        "_titreen" => $data["titreen"],
        "_sstitreen" => $data["sstitreen"]
    ));
    $db =null;
}


function db_get_accueil($accueil_id) {
    global $db;

    $sql = "SELECT * FROM accueil WHERE id=:_id";

    $query = $db->prepare($sql);
    $query->execute(array(
        "_id" => $accueil_id
    ));

    return $query->fetch();
    $db =null;
}

function db_update_accueil($data) {
    global $db;

    $sql = "UPDATE accueil SET titre=:_titre, sstitre=:_sstitre, titreen=:_titreen, sstitreen=:_sstitreen WHERE id=:_id";
    $query = $db->prepare($sql);
    $query->execute(array(
        "_titre" => $data["titre"],
        "_sstitre" => $data["sstitre"],
        "_titreen" => $data["titreen"],
        "_sstitreen" => $data["sstitreen"],
        "_id" => $data["id"]
    ));
    $db =null;
}


function db_delete_accueil($data) {
    global $db;
    $sql = "DELETE FROM accueil WHERE id=:_id";
    $query = $db->prepare($sql);
    $query->execute(array(
        "_id" => $data["id"]
    ));
    $db =null;
}


function db_list_accueil(){
    global $db;

    $sql = "SELECT * FROM accueil";
    $query = $db->prepare($sql);
    $query->execute();

    $list_accueil = $query->fetchAll();
    return $list_accueil;
    $db =null;
}


// $_POST = $_GET;
if(isset($_POST["module"]) && isset($_POST["action"])) {
    $actions_mapping = [
        "create" => "db_create_accueil",
        "update" => "db_update_accueil",
        "delete" => "db_delete_accueil"
    ];

    $module = $_POST["module"];
    $action = $_POST["action"];

    if( $module == "accueil" && array_key_exists($action, $actions_mapping) ){
        $actions_mapping[$_POST["action"]]($_POST);
    }
}


?>