<?php

require "../db_link.php";
require "functions.php";

function edit_session_init() {
    try{
        $link = linktoDAMP();
        $id = intval(trim($_GET["id"]));
        $query ="SELECT * FROM `sessions` WHERE `id` = :id";
        $handle = $link->prepare($query);
        $handle->execute(array("id"=>$id));
        $result = $handle->fetch(PDO::FETCH_ASSOC);
        return json_encode(array("status"=>"S","categories1"=>sessions_categories1,"categories2"=>sessions_categories2,"session"=>$result));
    }
    catch(Exception $e){
        return json_encode(array("status"=>"F","error"=>$e));
    }
}

echo edit_session_init();