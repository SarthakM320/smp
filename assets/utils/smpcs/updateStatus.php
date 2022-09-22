<?php
include '../db_link.php';
function Update(){
    try
    {
        $id = $_POST['id'];
        $active = $_POST['active'];
        $link = linkToSMP();
        if($active=='0'){
            $sql="UPDATE `reviews` SET `active`='1',`login`='0' WHERE `id`=:id";
        }
        else{
            $sql="UPDATE `reviews` SET `active`='0',`login`='0' WHERE `id`=:id";
        }
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
echo Update();
?>
