<?php

require "../db_link.php";
require "functions.php";

function add_session_init() {
    try{
        return json_encode(array("status"=>"S","categories1"=>sessions_categories1,"categories2"=>sessions_categories2));
    }
    catch(Exception $e){
        return json_encode(array("status"=>"F","error"=>$e));
    }
}

echo add_session_init();
