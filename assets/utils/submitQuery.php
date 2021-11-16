<?php

include 'db_link.php';
include 'mail_recaptcha_config.php';

function sendQuery(){
    try {
        session_start();
        if(isset($_POST['name']) && $_POST['email'] && $_POST['phone'] && $_POST['category'] && $_POST['query'] && $_POST['grecaptcha_response']){

            $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptcha_secret = RECAPTCHA_SECRET;
            $recaptcha_response = $_POST['grecaptcha_response'];

            // Make and decode POST request:
            $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
            $recaptcha = json_decode($recaptcha);

            // Take action based on the score returned:
            if (!$recaptcha->success) {
//                if ($recaptcha->score >= 0.5) {
//                    $_SESSION['bot']=false;
//                    $_SESSION['action']=$recaptcha->action;
//                    $_SESSION['host']=$recaptcha->hostname;
                    return json_encode(array('status'=>'bot'));
//                } else {
//                    $_SESSION['bot']=true;
//                    return 'F';
//                }
            }
            $link = linkToSMP();
            $name=htmlspecialchars($_POST['name']);
            $email=htmlspecialchars($_POST['email']);
            $phone=htmlspecialchars($_POST['phone']);
            $category=htmlspecialchars($_POST['category']);
            $query=htmlspecialchars($_POST['query']);

            $sql="INSERT INTO `queries`(`name`, `email`,`phone`,`category`,`query`) VALUES (:name,:email,:phone,:category,:query)";
            $handle=$link->prepare($sql);
            $handle->execute(array(
                'name'=>$name,
                'email'=>$email,
                'phone'=>$phone,
                'category'=>$category,
                'query' =>$query
            ));
            return json_encode(array('status'=>'S'));
        }
        else{
            return json_encode(array('status'=>'F','error'=>'Some form value is empty.'));
        }
    }
    catch(Exception $e){
        var_dump($e);
        return json_encode(array('status'=>'F','error'=>$e));
    }
}
echo sendQuery();
?>