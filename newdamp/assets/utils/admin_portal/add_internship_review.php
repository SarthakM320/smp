<?php

require "../db_link.php";
require "../common.php";

function add_internship_review() {
    try{
        session_start();
        $branch = $_SESSION["branch"];
        $title = trim($_POST["title"]);
        $content = trim($_POST["content"]);

        # Inserting entry in accounts if no instance of category present
        $link = linktoDAMP();
        $query1 = "SELECT COUNT(id) AS count FROM `internship_reviews` WHERE `branch` = :branch";
        $handle1 = $link->prepare($query1);
        $handle1->execute(array("branch"=>$branch));
        $result1 = $handle1->fetch(PDO::FETCH_ASSOC);
        if(intval($result1["count"]) === 0){
            $to_concat = $branch . ',';
            $prim_cat = array_search("d-internship-reviews",active_link_keys);
            $query2 = "UPDATE `accounts` SET `branches` = CONCAT(`branches`,:branch) WHERE `prim_cat` = :prim_cat";
            $handle2 = $link->prepare($query2);
            $handle2->execute(array("branch"=>$to_concat,"prim_cat"=>$prim_cat));
        }

        $query3 = "INSERT INTo `internship_reviews` (`branch`,`title`,`content`) VALUES (:branch,:title,:content)";
        $handle3 = $link->prepare($query3);
        $handle3->execute(array("branch"=>$branch,"title"=>$title,"content"=>$content));
        
        return json_encode(array("status"=>"S"));
    }
    catch(Exception $e){
        return json_encode(array("status"=>"F","error"=>$e));
    }
}

echo add_internship_review();
