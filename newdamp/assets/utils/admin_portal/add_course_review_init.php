<?php

require "../db_link.php";
require "functions.php";

function add_course_review_init() {
    try{
        session_start();
        return json_encode(array("status"=>"S","categories"=>course_reviews_categories));
    }
    catch(Exception $e){
        return json_encode(array("status"=>"F","error"=>$e));        
    }
}

echo add_course_review_init();