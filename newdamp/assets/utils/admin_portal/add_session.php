<?php

require "../db_link.php";
require "../common.php";

function add_session() {
    try{
        session_start();
        $branch = $_SESSION["branch"];
        $title = trim($_POST["title"]);
        $content = trim($_POST["content"]);
        $category1 = intval(trim($_POST["category1"]));
        $category2 = intval(trim($_POST["category2"]));

        # Inserting entry in accounts if no instance of category present
        $link = linktoDAMP();
        $query1 = "SELECT COUNT(id) AS count FROM `sessions` WHERE `category1` = :category1 AND `branch` = :branch";
        $handle1 = $link->prepare($query1);
        $handle1->execute(array("category1"=>$category1,"branch"=>$branch));
        $result1 = $handle1->fetch(PDO::FETCH_ASSOC);
        if(intval($result1["count"]) === 0){
            $branch_key = $branch . ',';
            $prim_cat = array_search("d-sessions",active_link_keys);
            $query2 = "UPDATE `accounts` SET `branches` = CONCAT(`branches`,:branch) WHERE `prim_cat` = :prim_cat AND `sec_cat` = :sec_cat";
            $handle2 = $link->prepare($query2);
            $handle2->execute(array("branch"=>$branch_key,"prim_cat"=>$prim_cat,"sec_cat"=>$category1));
        }

        $query3 = "INSERT INTO `sessions` (`branch`,`title`,`content`,`category1`,`category2`) VALUES (:branch,:title,:content,:category1,:category2)";
        $handle3 = $link->prepare($query3);
        $handle3->execute(array("branch"=>$branch,"title"=>$title,"content"=>$content,"category1"=>$category1,"category2"=>$category2));
        return json_encode(array("status"=>"S"));
    }
    catch(Exception $e){
        return json_encode(array("status"=>"F","error"=>$e));
    }
}

echo add_session();
