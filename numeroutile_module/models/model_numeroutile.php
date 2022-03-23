<?php
$db = new PDO('mysql:host=localhost;dbname=livret_accueil;', 'marie.blanc', 'cjbS8l1aiGTBXLEx');

function db_create_numeroutile($data){
    global $db;

    echo "toto";

    $sql = "INSERT INTO numeroutile (nomcontact, descp, tel) VALUES (:_nomcontact, :_descp, :_tel)";
    
    $query = $db->prepare($sql);

    $query->execute(array(
        "_nomcontact" => $data["nomcontact"],
        "_descp" => $data["descp"],
        "_tel" => $data["tel"]
    ));
}


function db_get_numeroutile($numeroutile_id) {
    global $db;

    $sql = "SELECT * FROM numeroutile WHERE id=:_id";

    $query = $db->prepare($sql);
    $query->execute(array(
        "_id" => $numeroutile_id
    ));

    return $query->fetch();
}

function db_update_numeroutile($data) {
    global $db;

    $sql = "UPDATE numeroutile SET nomcontact=:_nomcontact, descp=:_descp, tel=:_tel WHERE id=:_id";
    $query = $db->prepare($sql);
    $query->execute(array(
        "_nomcontact" => $data["nomcontact"],
        "_descp" => $data["descp"],
        "_tel" => $data["tel"],
        "_id" => $data["id"]
    ));

}


function db_delete_numeroutile($data) {
    global $db;
    $sql = "DELETE FROM numeroutile WHERE id=:_id";
    $query = $db->prepare($sql);
    $query->execute(array(
        "_id" => $data["id"]
    ));
}


function db_list_numeroutile(){
    global $db;

    $sql = "SELECT * FROM numeroutile";
    $query = $db->prepare($sql);
    $query->execute();

    $list_numeroutile = $query->fetchAll();
    return $list_numeroutile;
}


// $_POST = $_GET;

if(isset($_POST["module"]) && isset($_POST["action"])) {
    $actions_mapping = [
        "create" => "db_create_numeroutile",
        "update" => "db_update_numeroutile",
        "delete" => "db_delete_numeroutile"
    ];

    $module = $_POST["module"];
    $action = $_POST["action"];


    if( $module == "numeroutile" && array_key_exists($action, $actions_mapping) ){
        $actions_mapping[$_POST["action"]]($_POST);
    }
}


?>