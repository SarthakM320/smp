<?php
require "../db_link.php";
require "../common.php";
include "../markdown_convert.php";

function get_info() {
    try{
        $id = intval(trim($_GET["id"]));
        $table = trim($_GET["table"]);

        if(!in_array($table,table_names)){
            return json_encode(array("status"=>"F","error"=>"No such table exists."));
        }

        $link = linktoDAMP();
        $query = "SELECT content FROM `{$table}` WHERE id = :id";
        $handle = $link->prepare($query);
        $handle->execute(array("id"=>$id));
        $result = $handle->fetch(PDO::FETCH_ASSOC);
        if(count($result) === 0){
            return json_encode(array("status"=>"F","error"=>"No entry with given ID exists."));
        }
        
        $result["content"] = markdown_convert_to_html($result["content"]);
        return json_encode(array("status"=>"S","result"=>$result));
    }
    catch(Exception $e){
        return json_encode(array("status"=>"F","error"=>$e));
    }
}

echo get_info();