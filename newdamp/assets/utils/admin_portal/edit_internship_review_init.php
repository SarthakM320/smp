<?php

require "../db_link.php";

function edit_internship_review_init() {
    try{
        session_start();
        $branch = $_SESSION["branch"];

        $link = linktoDAMP();
        $id = intval(trim($_GET["id"]));
        $query ="SELECT * FROM `internship_reviews` WHERE `id` = :id";
        $handle = $link->prepare($query);
        $handle->execute(array("id"=>$id));
        $result = $handle->fetch(PDO::FETCH_ASSOC);
        return json_encode(array("status"=>"S","internship_review"=>$result));
    }
    catch(Exception $e){
        return json_encode(array("status"=>"F","error"=>$e));
    }
}

echo edit_internship_review_init();