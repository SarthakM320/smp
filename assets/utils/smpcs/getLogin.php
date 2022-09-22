<?php
function getLogin(){
    session_start();
    if(isset($_SESSION['admin']) && $_SESSION['admin']=='admin_smp'){
        return 'logged_in';
    }
    return 'logged_out';
}
echo getLogin();