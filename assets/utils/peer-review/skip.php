<?php
include 'exit.php';
include '../db_link.php';
function skip(){
    try{
        session_start();
        if(isset($_SESSION['code'])){
            $code=$_SESSION['code'];
            $link = linkToSMP();
            $handle = null;
            $sql="SELECT * FROM `reviews` WHERE `code`=:code AND `active`=1 LIMIT 1";
            $handle=$link->prepare($sql);
            $handle->execute(array('code'=>$code));
            if($handle->rowCount()==0) {
                destroy();
                return 'F';
            }
            else{
                $_SESSION['current']=$_SESSION['current']+1;
                array_push($_SESSION['data'],[]);
                return 'S';
            }
        }
        else{
            destroy();
            return 'F';
        }
    }
    catch(Exception $e)
    {
        var_dump($e);
        return "F";
    }
}
echo skip();