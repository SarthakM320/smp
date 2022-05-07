<?php

require "../db_link.php";
require "../common.php";

function edit_internship_review() {
    try{
        $id = intval(trim($_POST["id"]));
        $title = trim($_POST["title"]);
        $content = trim($_POST["content"]);

        $query = "UPDATE `internship_reviews` SET `title` = :title, `content` = :content WHERE id = :id";
        $handle = $link->prepare($query);
        $handle->execute(array("title"=>$title,"content"=>$content,"id"=>$id));
        return json_encode(array("status"=>"S"));
    }
    catch(Exception $e){
        return json_encode(array("status"=>"F","error"=>$e));
    }
}

echo edit_internship_review();