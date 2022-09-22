<?php

function Login()
{
    try{
        $user=trim($_POST['user']);
        $pass=trim($_POST['pass']);
        if($user=='admin_smp' && $pass=='smpforever'){
            session_start();
            $_SESSION['admin']=$user;
            $_SESSION['role']='admin';
            return 'S';
        }
        else if($user=='admin_smp' && $pass=='ISMP2020_21'){
            session_start();
            $_SESSION['admin']=$user;
            $_SESSION['role']='mentor';
            return 'S';
        }
        return 'F';
    }
    catch(Exception $e)
    {
        var_dump($e);
        return "F";
    }
}
echo Login();
?>