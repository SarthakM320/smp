<?php

require "../db_link.php";
require "functions.php";

function edit_course_review_init() {
    try{
        $link = linktoDAMP();
        $id = intval($_GET["id"]);
        $query ="SELECT * FROM `course_reviews` WHERE `id` = :id";
        $handle = $link->prepare($query);
        $handle->execute(array("id"=>$id));
        $result = $handle->fetch(PDO::FETCH_ASSOC);
        return json_encode(array("status"=>"S","categories"=>course_reviews_categories,"course_review"=>$result));
    }
    catch(Exception $e){
        return json_encode(array("status"=>"F","error"=>$e));
    }
}

echo edit_course_review_init();