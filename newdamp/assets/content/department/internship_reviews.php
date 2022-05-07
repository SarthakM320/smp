<div id="table-info" style="display: none;" data-table="<?php echo $table; ?>"></div>

<?php

$result = null;
try{
    $link = linktoDAMP();
    $query = "SELECT id, title FROM `internship_reviews` WHERE `branch` = :branch";
    $handle = $link->prepare($query);
    $handle->execute(array("branch"=>$department_code));
    $result = $handle->fetchAll(PDO::FETCH_ASSOC);
}
catch(Exception $e){
    echo var_dump($e);
}

if(!$result || count($result) === 0){
    echo '<h2 style="text-align: center; margin: 200px 0;">No entries to show.</h2>';
}
else{
    $length = count($result);
    echo <<<EOD
    <div class="section-info">
        <div class="section-info-container">
    EOD;

    for($i = 0; $i < $length; $i++){
        $internship_review = $result[$i];

        echo <<<EOD
        <div class="leaf" id="{$internship_review["id"]}">
            <div class="leaf-title">
                <h5>{$internship_review["title"]}</h5>
                <i class="bx bx-plus"></i>
            </div>
            <div class="leaf-drop-content" style="display: none;" data-seeked="0">
                <i class="bx bx-minus"></i>
            </div>
        </div>
        EOD;
    }

    echo <<<EOD
        </div>
    </div>
    EOD;
}

?>