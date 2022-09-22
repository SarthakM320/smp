<?php

require "../db_link.php";
require "../common.php";
require "functions.php";

function add_course_review() {
    try{
        session_start();
        $branch = $_SESSION["branch"];
        $department = strtolower(trim($_POST["department"]));
        $code = intval(trim($_POST["code"]));
        $title = trim($_POST["title"]);
        $content = trim($_POST["content"]);
        $category = intval(trim($_POST["category"]));
        $year = !empty($_POST["year"]) ? intval(trim($_POST["year"])) : NULL;
        $professors = !empty($_POST["professors"]) ? trim($_POST["professors"]) : NULL;

        # Inserting entry in accounts if no instance of category present
        $link = linktoDAMP();
        $query1 = "SELECT COUNT(id) AS count FROM `course_reviews` WHERE `category` = :category AND `branch` = :branch";
        $handle1 = $link->prepare($query1);
        $handle1->execute(array("category"=>$category,"branch"=>$branch));
        $result1 = $handle1->fetch(PDO::FETCH_ASSOC);
        if(intval($result1["count"]) === 0){
            $branch_key = $branch . ',';
            $prim_cat = array_search("d-course-reviews",active_link_keys);
            $query2 = "UPDATE `accounts` SET `branches` = CONCAT(`branches`,:branch) WHERE `prim_cat` = :prim_cat AND `sec_cat` = :sec_cat";
            $handle2 = $link->prepare($query2);
            $handle2->execute(array("branch"=>$branch_key,"prim_cat"=>$prim_cat,"sec_cat"=>$category));
        }
        
        # Inserting course in course_reviews
        $query3 = "INSERT INTo `course_reviews` (`branch`,`department`,`code`,`year`,`title`,`professors`,`content`,`category`) VALUES (:branch,:department,:code,:year,:title,:professors,:content,:category)";
        $handle3 = $link->prepare($query3);
        $handle3->execute(array("branch"=>$branch,"department"=>$department,"code"=>$code,"year"=>$year,"title"=>$title,"professors"=>$professors,"content"=>$content,"category"=>$category));

        return json_encode(array("status"=>"S"));
    }
    catch(Exception $e){
        return json_encode(array("status"=>"F","error"=>$e));
    }
}

echo add_course_review();
