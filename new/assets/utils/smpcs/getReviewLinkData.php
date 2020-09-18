<?php
include '../db_link.php';
function getReviewLinks(){
    try {
        $link = linkToSMP();
        $handle = null;
        $sql="SELECT *,id as DT_RowId FROM `reviews` WHERE `peer_ids`!=''";
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

echo getReviewLinks();
?>