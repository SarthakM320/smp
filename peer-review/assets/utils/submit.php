<?php
include 'exit.php';
include 'db_link.php';
function submit(){
    try{
        session_start();
        if(isset($_SESSION['code']) && is_array($_POST['data'])){
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
                if(count($_POST['data'])==1){
                    array_push($_SESSION['data'],[]);
                }
                else{
                    array_push($_SESSION['data'],$_POST['data']);
                }
                $json=json_encode($_SESSION['data']);
                $id = $_SESSION['user_id'];
                $sql="UPDATE `reviews` SET `active`='0',`login`='0',`data`=:data WHERE `id`=:id";
                $handle=$link->prepare($sql);
                $handle->execute(array('data'=>$json, 'id' => $id));
                destroy();
                return "S";
            }
        }
        else{
            destroy();
            return json_encode($_POST['data']);
        }
    }
    catch(Exception $e)
    {
        var_dump($e);
        return "F";
    }
}
echo submit();