<?php
include '../db_link.php';

function export(){
    try {
        $link = linkToSMP();
        $sql="SELECT * FROM `faqs`";
        $handle=$link->prepare($sql);
        $handle->execute();
        if($handle->rowCount()==0) return 'F';
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
echo export();
?>
