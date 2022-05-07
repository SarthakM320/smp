<?php

require "../db_link.php";
require "functions.php";

function edit_career_information_init() {
    try{
        $link = linktoDAMP();
        $id = intval(trim($_GET["id"]));
        $query ="SELECT * FROM `career_information` WHERE `id` = :id";
        $handle = $link->prepare($query);
        $handle->execute(array("id"=>$id));
        $result = $handle->fetch(PDO::FETCH_ASSOC);
        return json_encode(array("status"=>"S","categories1"=>career_information_categories1,"categories2"=>career_information_categories2,"career_information"=>$result));
    }
    catch(Exception $e){
        return json_encode(array("status"=>"F","error"=>$e));
    }
}

echo edit_career_information_init();