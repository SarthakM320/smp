<?php

require "../db_link.php";
require "../common.php";

function delete_session() {
    try{
        $id = intval(trim($_POST["id"]));

        $link = linktoDAMP();
        # Fetch current details of session
        $query1 = "SELECT category1, branch FROM `sessions` WHERE id = :id";
        $handle1 = $link->prepare($query1);
        $handle1->execute(array("id"=>$id));
        $result1 = $handle1->fetch(PDO::FETCH_ASSOC);
        $category1 = $result1["category1"];
        $branch = $result1["branch"];

        # Deleting entry in accounts if last instance of category is deleted
        $query2 = "SELECT COUNT(id) AS count FROM `sessions` WHERE `category1` = :category1 AND `branch` = :branch";
        $handle2 = $link->prepare($query2);
        $handle2->execute(array("category1"=>$category1,"branch"=>$branch));
        $result2 = $handle2->fetch(PDO::FETCH_ASSOC);
        if(intval($result2["count"]) === 1){
            $branch_key = $branch . ',';
            $prim_cat = array_search("d-sessions",active_link_keys);
            $query3 = "UPDATE `accounts` SET `branches` = REGEXP_REPLACE(`branches`,:branch,'') WHERE `prim_cat` = :prim_cat AND `sec_cat` = :sec_cat";
            $handle3 = $link->prepare($query3);
            $handle3->execute(array("branch"=>$branch_key,"prim_cat"=>$prim_cat,"sec_cat"=>$category1));
        }

        # Deleting session from sessions
        $query4 = "DELETE FROM `sessions` WHERE id = :id";
        $handle4 = $link->prepare($query4);
        $handle4->execute(array("id"=> $id));
        
        return json_encode(array("status"=>"S"));
    }
    catch(Exception $e){
        return json_encode(array("status"=>"F","error"=>$e));
    }
}

echo delete_session();