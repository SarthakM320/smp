<?php
require "db_link.php";

function get_search_info() {
    try{
        $link = linktoDAMP();
        $query = "SELECT department, code, MAX(title) as title FROM `course_reviews` GROUP BY department, code ORDER BY department, code";
        $handle = $link->prepare($query);
        $handle->execute();
        $result = $handle->fetchAll(PDO::FETCH_ASSOC);

        return json_encode(array("status"=>"S","courses"=>$result));
    }
    catch(Exception $e){
        return json_encode(array("status"=>"F","error"=>$e));
    }
}

echo get_search_info();