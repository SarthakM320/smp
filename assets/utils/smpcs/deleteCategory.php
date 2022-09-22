<?php
include '../db_link.php';
function DeleteCategory(){
    try
    {
        $id = $_POST['id'];
        $link = linkToSMP();
        $sql="DELETE FROM `category` WHERE `id`=:id";
        $handle=$link->prepare($sql);
        $handle->execute(array('id' => $id));
        return "S";
    }
    catch(Exception $e)
    {
        var_dump($e);
        return "F";
    }
}
echo DeleteCategory();
?>
