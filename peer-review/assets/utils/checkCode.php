<?php
include 'db_link.php';
function getReviewLinks(){
    try {
        if(!isset($_POST['code'])) return 'F';
        $code=$_POST['code'];
        $link = linkToSMP();
        $handle = null;
        $sql="SELECT * FROM `reviews` WHERE `code`=:code AND `active`=1 LIMIT 1";
        $handle=$link->prepare($sql);
        $handle->execute(array('code'=>$code));
        if($handle->rowCount()==0) return 'F';
        $result=$handle->fetchAll(PDO::FETCH_ASSOC);
        $result=$result[0];
        $login=$result['login'];
        if($login == '1') return 'used_code';

        session_start();
        $_SESSION['code']=$code;
        $_SESSION['user_id']=$result['id'];
        $_SESSION['name']=$result['name'];
        $peer_ids=$result['peer_ids'];
        $peer_ids=explode(',',$peer_ids);
        $_SESSION['peer_ids']=$peer_ids;
        $_SESSION['current']=0;
        $_SESSION['last']=0;
        $_SESSION['data']=array();

        $sql="UPDATE `reviews` SET `login`='1' WHERE `id`=:id";
        $handle=$link->prepare($sql);
        $handle->execute(array('id' => $_SESSION['user_id']));

        return 'S';
    }
    catch(Exception $e){
        var_dump($e);
        return "F";
    }
}

echo getReviewLinks();
?>