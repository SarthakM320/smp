<?php

require "../db_link.php";
require "../common.php";

function delete_internship_review() {
    try{
        $id = intval(trim($_POST["id"]));

        session_start();
        $branch = $_SESSION["branch"];

        # Deleting entry in accounts if last instance of category is deleted
        $link = linktoDAMP();
        $query1 = "SELECT COUNT(id) AS count FROM `internship_reviews` WHERE `branch` = :branch";
        $handle1 = $link->prepare($query1);
        $handle1->execute(array("branch"=>$branch));
        $result1 = $handle1->fetch(PDO::FETCH_ASSOC);
        if(intval($result1["count"]) === 1){
            $branch_key = $branch . ',';
            $prim_cat = array_search("d-internship-reviews",active_link_keys);
            $query2 = "UPDATE `accounts` SET `branches` = REGEXP_REPLACE(`branches`,:branch,'') WHERE `prim_cat` = :prim_cat";
            $handle2 = $link->prepare($query2);
            $handle2->execute(array("branch"=>$branch_key,"prim_cat"=>$prim_cat));
        }

        $query3 = "DELETE FROM `internship_reviews` WHERE id = :id";
        $handle3 = $link->prepare($query3);
        $handle3->execute(array("id"=> $id));

        return json_encode(array("status"=>"S"));
    }
    catch(Exception $e){
        return json_encode(array("status"=>"F","error"=>$e));
    }
}

echo delete_internship_review();