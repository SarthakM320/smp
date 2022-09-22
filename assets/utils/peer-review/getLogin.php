<?php
function getLogin(){
    session_start();
    if(isset($_SESSION['code'])){
        return 'logged_in';
    }
    return 'logged_out';
}
echo getLogin();