<?php
include '../db_link.php';

function export(){
    try {
        $link = linkToSMP();
        $sql="SELECT * FROM `reviews`";
        $handle=$link->prepare($sql);
        $handle->execute();
        if($handle->rowCount()==0) return 'F';
        $result=$handle->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }
    catch(Exception $e){
        var_dump($e);
        return "F";
    }
}
echo export();
?>
