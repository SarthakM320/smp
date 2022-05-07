<?php

require "../db_link.php";
require "functions.php";

function get_career_information(){
    try{
        session_start();
        $branch = $_SESSION["branch"];

        $link = linktoDAMP();
        $query = "SELECT id as DT_RowId, title, category1, category2 FROM `career_information` WHERE `branch` = :branch";
        $handle = $link->prepare($query);
        $handle->execute(array("branch"=>$branch));
        $result = $handle->fetchAll(PDO::FETCH_ASSOC);
        $length = count($result);
        for($i = 0; $i < $length; $i++){
            $index1 = $result[$i]["category1"];
            $index2 = $result[$i]["category2"];
            $result[$i]["category1"] = career_information_categories1[$index1];
            $result[$i]["category2"] = career_information_categories2[$index1][$index2];
        }
        return json_encode(array("status"=>"S","career_information"=>$result));
    }
    catch(Exception $e){
        return json_encode(array("status"=>"F","error"=>$e));
    }
}

echo get_career_information();