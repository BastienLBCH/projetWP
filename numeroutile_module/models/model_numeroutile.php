<?php
$db_numeroutile = new PDO('mysql:host=localhost;dbname=livret_accueil;', 'marie.blanc', 'cjbS8l1aiGTBXLEx');

function db_numeroutile_create_numeroutile($data){
    global $db_numeroutile;

    echo "toto";

    $sql = "INSERT INTO numeroutile (nomcontact, descp, tel) VALUES (:_nomcontact, :_descp, :_tel)";
    
    $query = $db_numeroutile->prepare($sql);

    $query->execute(array(
        "_nomcontact" => $data["nomcontact"],
        "_descp" => $data["descp"],
        "_tel" => $data["tel"]
    ));
}


function db_numeroutile_get_numeroutile($numeroutile_id) {
    global $db_numeroutile;

    $sql = "SELECT * FROM numeroutile WHERE id=:_id";

    $query = $db_numeroutile->prepare($sql);
    $query->execute(array(
        "_id" => $numeroutile_id
    ));

    return $query->fetch();
}

function db_numeroutile_update_numeroutile($data) {
    global $db_numeroutile;

    $sql = "UPDATE numeroutile SET nomcontact=:_nomcontact, descp=:_descp, tel=:_tel WHERE id=:_id";
    $query = $db_numeroutile->prepare($sql);
    $query->execute(array(
        "_nomcontact" => $data["nomcontact"],
        "_descp" => $data["descp"],
        "_tel" => $data["tel"],
        "_id" => $data["id"]
    ));

}


function db_numeroutile_delete_numeroutile($data) {
    global $db_numeroutile;
    $sql = "DELETE FROM numeroutile WHERE id=:_id";
    $query = $db_numeroutile->prepare($sql);
    $query->execute(array(
        "_id" => $data["id"]
    ));
}


function db_numeroutile_list_numeroutile(){
    global $db_numeroutile;

    $sql = "SELECT * FROM numeroutile";
    $query = $db_numeroutile->prepare($sql);
    $query->execute();

    $list_numeroutile = $query->fetchAll();
    return $list_numeroutile;
}


// $_POST = $_GET;
// die(print_r($_POST));

if(isset($_POST["module"]) && isset($_POST["action"])) {
    $actions_mapping = [
        "create" => "db_numeroutile_create_numeroutile",
        "update" => "db_numeroutile_update_numeroutile",
        "delete" => "db_numeroutile_delete_numeroutile"
    ];

    $module = $_POST["module"];
    $action = $_POST["action"];

    echo "<br> Hello, je suis dans le isset";


    if( $module == "numeroutile" && array_key_exists($action, $actions_mapping) ){
        echo "<br> Est-ce qu'il y a quelqu'un ici ?";
        $actions_mapping[$_POST["action"]]($_POST);
    }
}


?>