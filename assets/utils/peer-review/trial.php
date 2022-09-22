<?php

include '../db_link.php';

$link = linkToSMP();
$given_peer_ids = array(1,2,3);
$in = implode(',', array_fill(0, count($given_peer_ids), '?'));
$sql1 = "SELECT id, name FROM `reviews` WHERE id NOT IN ($in)";
$handle1 = $link->prepare($sql1);
$handle1->execute(array('$in'=>$in)); 
$result1 = $handle1->fetchAll(PDO::FETCH_ASSOC);
print_r($result1);