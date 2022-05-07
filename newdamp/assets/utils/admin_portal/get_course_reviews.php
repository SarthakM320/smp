<?php

require "../db_link.php";
require "functions.php";

function get_course_reviews(){
    try{
        session_start();
        $branch = $_SESSION["branch"];

        $link = linktoDAMP();
        $query = "SELECT id as DT_RowId, department, code, year, title, category FROM `course_reviews` WHERE `branch` = :branch";
        $handle = $link->prepare($query);
        $handle->execute(array("branch"=>$branch));
        $result = $handle->fetchAll(PDO::FETCH_ASSOC);
        $length = count($result);
        for($i = 0; $i < $length; $i++){
            $result[$i]["category"] = course_reviews_categories[$result[$i]["category"]];
        }
        return json_encode(array("status"=>"S","course_reviews"=>$result));
    }
    catch(Exception $e){
        return json_encode(array("status"=>"F","error"=>$e));
    }
}

echo get_course_reviews();