<?php
include '../db_link.php';
function getFAQ(){
    try {
        $link = linkToSMP();
        $handle = null;
        $id = $_POST['id'];
        $sql="SELECT * FROM `faqs` where `id`=:id";
        $handle=$link->prepare($sql);
        $handle->execute(array('id'=>$id));
        $result=$handle->fetchAll(PDO::FETCH_ASSOC);
        $result[0]['question']=htmlspecialchars_decode($result[0]['question']);
        $result[0]['answer']=htmlspecialchars_decode($result[0]['answer']);
        $result=$result[0];
        return json_encode($result);
    }
    catch(Exception $e){
        var_dump($e);
        return "F";
    }
}

echo getFAQ();
?>