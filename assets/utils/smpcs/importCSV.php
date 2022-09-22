<?php
include '../db_link.php';

function getUniqueCodes($len){
    $ucs=[];
    for ($a=0; $a<$len; $a++){
        $check=1;
        $uc=null;
        while($check==1){
            $uc=(string)(rand(100000,999999));
            if(!in_array($uc,$ucs)){
                array_push($ucs,$uc);
                $check=0;
            }
        }
    }
    return $ucs;
}

function importCSV(){
    try {
        $link = linkToSMP();
        if(isset($_FILES["csv"]))
        {
            $name = $_FILES['csv']['name'];
            $tmp_name = $_FILES['csv']['tmp_name'];
            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            $error = $_FILES["csv"]["error"];
            if($error>0){
                return "error_while_uploading";
            }
            if($ext!="csv")
            {
                return "invalid_format";
            }
            if (!($fp = fopen($tmp_name, 'r'))) {
                return "F";
            }
            $names=fgetcsv($fp);
            array_shift($names);
            $sql="TRUNCATE TABLE `reviews`;";
            $handle=$link->prepare($sql);
            if($handle->execute()){
                $uc_ind=0;
                $ucs=getUniqueCodes(count($names));
                for($i=0; $i<count($names); $i++){
                    $line=fgetcsv($fp);
                    array_shift($line);
                    $peer_ids=[];
                    for($j=0; $j<count($names); $j++){
                        $peer_id=$line[$j];
                        if(trim($peer_id)!='') array_push($peer_ids,($j+1));
                    }
                    $peer_ids=implode(",",$peer_ids);
                    $sql="INSERT INTo `reviews` (`name`, `peer_ids`, `code`) VALUES (:name,:peer_ids,:code)";
                    $handle=$link->prepare($sql);
                    if($handle->execute(array('name'=>$names[$i],'peer_ids'=>$peer_ids,'code'=>$ucs[$uc_ind]))) {
                        $uc_ind++;
                        continue;
                    }
                    else return "not_imported";
                }
            }
            else{
                fclose($fp);
                return "F";
            }
            fclose($fp);
            return "S";
        }
        else{
            return "F";
        }
    }
    catch(Exception $e){
        var_dump($e);
        return "F";
    }
}
echo importCSV();
?>
