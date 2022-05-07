<?php

require "../db_link.php";
require "functions.php";

function add_career_information_init() {
    try{
        return json_encode(array("status"=>"S","categories1"=>career_information_categories1,"categories2"=>career_information_categories2));
    }
    catch(Exception $e){
        return json_encode(array("status"=>"F","error"=>$e));
    }
}

echo add_career_information_init();
