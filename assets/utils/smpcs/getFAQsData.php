<?php
include '../db_link.php';
function getFAQs(){
    try {
        $link = linkToSMP();
        $handle = null;
        $sql="SELECT *,id as DT_RowId FROM `faqs` ORDER BY `id` ASC";
        $handle=$link->prepare($sql);
        $handle->execute();
        $result=$handle->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0 ; $i < count($result) ; $i++) {
            $result[$i]['question']=htmlspecialchars_decode($result[$i]['question']);
            $result[$i]['answer']=htmlspecialchars_decode($result[$i]['answer']);
        }
        return json_encode($result);
    }
    catch(Exception $e){
        var_dump($e);
        return "F";
    }
}

echo getFAQs();
?>