<?php

include 'assets/utils/db_link.php';

function fetch_existing_ids(){
    $link = linkToSMP();
    $sql="SELECT `element_id` FROM `search_engine`";
    $handle=$link->prepare($sql);
    $handle->execute();
    return $handle->fetchAll(PDO::FETCH_COLUMN);
}

function generate_random_id($length){
    $id = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet);
    for ($i=0; $i < $length; $i++) {
        $id .= $codeAlphabet[random_int(0, $max-1)];
    }

    return $id;
}

function create_new_index($index_url,$element_search_title,$element_id){
    $link = linkToSMP();
    $sql="INSERT INTO `search_engine` (`element_id`, `url`, `title`) VALUES ('$element_id','$index_url','$element_search_title')";
    $handle=$link->prepare($sql);
    $handle->execute();
}

function update_index($index_url,$element_search_title,$element_id){
    $link = linkToSMP();
    $sql="UPDATE `search_engine` SET `element_id`='$element_id',`title`='$element_search_title' WHERE `url`='$index_url'";
    $handle=$link->prepare($sql);
    $handle->execute();
}

function check_if_url_already_indexed($index_url,$element_search_title): bool
{
    $link = linkToSMP();
    $sql="SELECT `url` FROM `search_engine` WHERE `url`='$index_url'";
    $handle=$link->prepare($sql);
    $handle->execute();
    $result = $handle->fetchAll(PDO::FETCH_COLUMN);
    if(count($result)) return true;
    return false;
}
function delete_extra_urls($urls)
{
    $link = linkToSMP();
    $url_string = implode("','",$urls);
    $sql="DELETE FROM `search_engine` WHERE `url` NOT IN ('$url_string')";
    $handle=$link->prepare($sql);
    $handle->execute();
//    $result = $handle->fetchAll(PDO::FETCH_COLUMN);
}


$folder = 'test';
$base_link = 'http://smp.iitb.ac.in/';
$base_path = '';

$directory = new RecursiveDirectoryIterator($folder);
//foreach (new RecursiveIteratorIterator($di) as $filename => $file) {
//    echo $filename . ' - ' . $file->getSize() . ' bytes <br/>';
//}
//$di = new RecursiveDirectoryIterator('./new/');

$iterator = new \RecursiveIteratorIterator($directory);
$file_paths = array();
$file_urls = array();
foreach ($iterator as $info) {
    if (strrev(substr(strrev($info->getPathname()),0,5)) == ".html") {
        $file_urls[] = $base_link.$info->getPathname();
        $file_paths[] = $base_path.$info->getPathname();
    }
}
$urls = [];
for ($i = 0 ; $i < count($file_paths); $i++){
    $curr_file = $file_paths[$i];
    $curr_file_url = $file_urls[$i];
    $doc = new DOMDocument();
    $doc->preserveWhiteSpace = false;
    $doc->formatOutput = true;
    $doc->loadHTMLFile($curr_file);
    $finder = new DomXPath($doc);

    $elements = $finder->query("//*[contains(@class, 'search')]");

    if (!is_null($elements)) {
        foreach ($elements as $element) {
            $element_search_title = $element->getAttribute('data-search-title');
            if($element_search_title!="") {
                $element_id = $element->getAttribute('id');
                if ($element_id == "") {
                    $element_id = generate_random_id(10);
                    $existing_ids = fetch_existing_ids();
                    while (array_search($element_id, $existing_ids)) $element_id = getRandomToken(20);
                    $index_url = $curr_file_url . '#' . $element_id;
                    $element->setAttribute('id', $element_id);
                    create_new_index($index_url, $element_search_title, $element_id);
                    array_push($urls, $index_url);
                } else {
                    $index_url = $curr_file_url . '#' . $element_id;
                    if (check_if_url_already_indexed($index_url, $element_search_title)) {
                        update_index($index_url, $element_search_title, $element_id);
                        array_push($urls, $index_url);
                    } else {
                        create_new_index($index_url, $element_search_title, $element_id);
                        array_push($urls, $index_url);
                    }
                }
            }
        }
    }
    $doc->saveHTMLFile($curr_file);
}
delete_extra_urls($urls);

?>