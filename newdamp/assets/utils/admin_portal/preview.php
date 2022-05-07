<?php
require "../markdown_convert.php";

function preview_convert() {
    try{
        $text = $_GET["text"];
        $text = htmlspecialchars($text);
        $converted_text = array("converted_text"=>markdown_convert_to_html($text));
        return json_encode($converted_text);
    }
    catch(Exception $e){
        var_dump($e);
        return "F";
    }
}

echo preview_convert();