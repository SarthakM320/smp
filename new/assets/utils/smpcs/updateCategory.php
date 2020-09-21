<?php
include '../db_link.php';
function UpdateCategory(){
    try
    {
        $category = $_POST['category'];
        $id = $_POST['id'];
        $link = linkToSMP();
        $sql="UPDATE `category` SET `category`=:category WHERE `id`=:id";
        $handle=$link->prepare($sql);
        $handle->execute(array('category' => $category, 'id'=>$id));
        return "S";
    }
    catch(Exception $e)
    {
        var_dump($e);
        return "F";
    }
}
echo UpdateCategory();
?>
