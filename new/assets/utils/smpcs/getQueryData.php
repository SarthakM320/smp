<?php
include '../db_link.php';
function getQueries(){
    try {
        $link = linkToSMP();
        $handle = null;
        $sql="SELECT *,id as DT_RowId FROM `queries`  WHERE `answered`='0' ORDER BY `id` ASC";
        $handle=$link->prepare($sql);
        $handle->execute();
        $result=$handle->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }
    catch(Exception $e){
        var_dump($e);
        return "F";
    }
}

echo getQueries();
?>