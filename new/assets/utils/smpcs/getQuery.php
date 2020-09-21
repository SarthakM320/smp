<?php
include '../db_link.php';
function getQuery(){
    try {
        $link = linkToSMP();
        $handle = null;
        $id = $_POST['id'];
        $sql="SELECT * FROM `queries` where `id`=:id";
        $handle=$link->prepare($sql);
        $handle->execute(array('id'=>$id));
        $result=$handle->fetchAll(PDO::FETCH_ASSOC);
        $result=$result[0];
        return json_encode($result);
    }
    catch(Exception $e){
        var_dump($e);
        return "F";
    }
}

echo getQuery();
?>