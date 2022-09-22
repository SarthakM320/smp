<?php

include '../assets/utils/db_link.php';

$search_str = $_POST['search_str'];
if(strlen($search_str)<3) echo 'search term too small';
else{
    $link = linkToSMP();
    $sql="SELECT `title` FROM `search_engine` WHERE `title` LIKE '%$search_str%'";
    $handle=$link->prepare($sql);
    $handle->execute();
    echo json_encode($handle->fetchAll(PDO::FETCH_COLUMN));
}

?>