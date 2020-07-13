<?php
include 'db_link.php';
include 'exit.php';
function getName($id){
    $link2 = linkToSMP();
    $handle2 = null;
    $sql2="SELECT * FROM `reviews` WHERE `id`=:id";
    $handle2=$link2->prepare($sql2);
    $handle2->execute(array('id'=>$id));
    $result2=$handle2->fetchAll(PDO::FETCH_ASSOC);
    return $result2[0]['name'];
}
function getStatus(){
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
                $json['name']=$_SESSION['name'];
                $json['peer_name']=getName($_SESSION['peer_ids'][$_SESSION['current']]);
                if($_SESSION['current'] == (count($_SESSION['peer_ids'])-1)) $json['last']=1;
                else $json['last']=0;
            }
        }
        else{
            destroy();
            return 'F';
        }
        return json_encode($json);
    }
    catch(Exception $e)
    {
        var_dump($e);
        return "F";
    }
}
echo getStatus();