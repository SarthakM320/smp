<?php

require "../db_link.php";
require "../common.php";

function edit_session() {
    try{
        $id = intval($_POST["id"]);
        $title = trim($_POST["title"]);
        $content = trim($_POST["content"]);
        $category1 = intval(trim($_POST["category1"]));
        $category2 = intval(trim($_POST["category2"]));

        $link = linktoDAMP();
        # Fetch previous details of session
        $query1 = "SELECT category1, branch FROM `sessions` WHERE id = :id";
        $handle1 = $link->prepare($query1);
        $handle1->execute(array("id"=>$id));
        $result1 = $handle1->fetch(PDO::FETCH_ASSOC);
        $prev_category1 = intval($result1["category1"]);
        $branch = $result1["branch"];

        # Updating entries in accounts if category is changed
        if($prev_category1 !== $category1){
            $prim_cat = array_search("d-sessions",active_link_keys);
            $branch_key = $branch . ',';

            # Inserting entry in accounts if no instance of category present
            $query2 = "SELECT COUNT(id) AS count FROM `sessions` WHERE `category1` = :category1 AND `branch` = :branch";
            $handle2 = $link->prepare($query2);
            $handle2->execute(array("category1"=>$category1,"branch"=>$branch));
            $result2 = $handle2->fetch(PDO::FETCH_ASSOC);
            if(intval($result2["count"]) === 0){
                $query3 = "UPDATE `accounts` SET `branches` = CONCAT(`branches`,:branch) WHERE `prim_cat` = :prim_cat AND `sec_cat` = :sec_cat";
                $handle3 = $link->prepare($query3);
                $handle3->execute(array("branch"=>$branch_key,"prim_cat"=>$prim_cat,"sec_cat"=>$category1));
            }

            # Deleting entry in accounts if last instance of category is deleted
            $query4 = "SELECT COUNT(id) AS count FROM `sessions` WHERE `category1` = :category1 AND `branch` = :branch";
            $handle4 = $link->prepare($query4);
            $handle4->execute(array("category1"=>$prev_category1,"branch"=>$branch));
            $result4 = $handle4->fetch(PDO::FETCH_ASSOC);
            if(intval($result4["count"]) === 1){
                $query5 = "UPDATE `accounts` SET `branches` = REGEXP_REPLACE(`branches`,:branch,'') WHERE `prim_cat` = :prim_cat AND `sec_cat` = :sec_cat";
                $handle5 = $link->prepare($query5);
                $handle5->execute(array("branch"=>$branch_key,"prim_cat"=>$prim_cat,"sec_cat"=>$prev_category1));
            }
        }

        $query6 = "UPDATE `sessions` SET `title` = :title, `content` = :content, `category1` = :category1, `category2` = :category2 WHERE id = :id";
        $handle6 = $link->prepare($query6);
        $handle6->execute(array("title"=>$title,"content"=>$content,"category1"=>$category1,"category2"=>$category2,"id"=>$id));
        
        return json_encode(array("status"=>"S"));
    }
    catch(Exception $e){
        return json_encode(array("status"=>"F","error"=>$e));
    }
}

echo edit_session();