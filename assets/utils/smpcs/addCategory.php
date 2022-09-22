<?php
include '../db_link.php';
function AddCategory(){
    try
    {
        $category = $_POST['category'];
        $link = linkToSMP();
        $sql="INSERT INTo `category`(`category`) VALUES (:category)";
        $handle=$link->prepare($sql);
        $handle->execute(array('category' => $category));
        return "S";
    }
    catch(Exception $e)
    {
        var_dump($e);
        return "F";
    }
}
echo AddCategory();
?>
