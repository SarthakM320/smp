<?php
function login_status(){
    session_start();
    if(isset($_SESSION["branch"])){
        return "Y";
    }
    else{
        return "N";
    }
}