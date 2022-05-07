<?php

require "../db_link.php";
require "../common.php";
require "functions.php";

function edit_course_review() {
    try{
        $id = intval(trim($_POST["id"]));
        $department = strtolower(trim($_POST["department"]));
        $code = intval(trim($_POST["code"]));
        $title = trim($_POST["title"]);
        $content = trim($_POST["content"]);
        $category = intval(trim($_POST["category"]));
        $year = !empty($_POST["year"]) ? intval(trim($_POST["year"])) : NULL;
        $professors = !empty($_POST["professors"]) ? trim($_POST["professors"]) : NULL;

        $link = linktoDAMP();
        # Fetch previous details of course review
        $query1 = "SELECT category, branch FROM `course_reviews` WHERE id = :id";
        $handle1 = $link->prepare($query1);
        $handle1->execute(array("id"=>$id));
        $result1 = $handle1->fetch(PDO::FETCH_ASSOC);
        $prev_category = intval($result1["category"]);
        $branch = $result1["branch"];

        # Updating entries in accounts if category is changed
        if($prev_category !== $category){
            $prim_cat = array_search("d-course-reviews",active_link_keys);
            $branch_key = $branch . ',';

            # Inserting entry in accounts if no instance of category present
            $query2 = "SELECT COUNT(id) AS count FROM `course_reviews` WHERE `category` = :category AND `branch` = :branch";
            $handle2 = $link->prepare($query2);
            $handle2->execute(array("category"=>$category,"branch"=>$branch));
            $result2 = $handle2->fetch(PDO::FETCH_ASSOC);
            if(intval($result2["count"]) === 0){
                $query3 = "UPDATE `accounts` SET `branches` = CONCAT(`branches`,:branch) WHERE `prim_cat` = :prim_cat AND `sec_cat` = :sec_cat";
                $handle3 = $link->prepare($query3);
                $handle3->execute(array("branch"=>$branch_key,"prim_cat"=>$prim_cat,"sec_cat"=>$category));
            }

            # Deleting entry in accounts if last instance of category is deleted
            $query4 = "SELECT COUNT(id) AS count FROM `course_reviews` WHERE `category` = :category AND `branch` = :branch";
            $handle4 = $link->prepare($query4);
            $handle4->execute(array("category"=>$prev_category,"branch"=>$branch));
            $result4 = $handle4->fetch(PDO::FETCH_ASSOC);
            if(intval($result4["count"]) === 1){
                $query5 = "UPDATE `accounts` SET `branches` = REGEXP_REPLACE(`branches`,:branch,'') WHERE `prim_cat` = :prim_cat AND `sec_cat` = :sec_cat";
                $handle5 = $link->prepare($query5);
                $handle5->execute(array("branch"=>$branch_key,"prim_cat"=>$prim_cat,"sec_cat"=>$prev_category));
            }
        }
        
        # Update course review in course_reviews
        $query6 = "UPDATE `course_reviews` SET `department` = :department, `code` = :code, `year` = :year, `title` = :title, `professors` = :professors, `content` = :content, `category` = :category WHERE id = :id";
        $handle6 = $link->prepare($query6);
        $handle6->execute(array("department"=>$department,"code"=>$code,"year"=>$year,"title"=>$title,"professors"=>$professors,"content"=>$content,"category"=>$category,"id"=>$id));

        return json_encode(array("status"=>"S"));
    }
    catch(Exception $e){
        return json_encode(array("status"=>"F","error"=>$e));
    }
}

echo edit_course_review();