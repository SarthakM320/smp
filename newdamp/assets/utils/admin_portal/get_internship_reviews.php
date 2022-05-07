<?php

require "../db_link.php";

function get_internship_reviews(){
    try{
        session_start();
        $branch = $_SESSION["branch"];

        $link = linktoDAMP();
        $query = "SELECT id as DT_RowId, title FROM `internship_reviews` WHERE `branch` = :branch";
        $handle = $link->prepare($query);
        $handle->execute(array("branch"=>$branch));
        $result = $handle->fetchAll(PDO::FETCH_ASSOC);
        return json_encode(array("status"=>"S","internship_reviews"=>$result));
    }
    catch(Exception $e){
        return json_encode(array("status"=>"F","error"=>$e));
    }
}

echo get_internship_reviews();