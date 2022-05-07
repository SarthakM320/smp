<div id="table-info" style="display: none;" data-table="<?php echo $table; ?>"></div>

<?php

require "../assets/utils/admin_portal/functions.php";

$result = null;
try{
    $link = linktoDAMP();
    $query = "SELECT id, title, category1, category2 FROM `sessions` WHERE `branch` = :branch ORDER BY category1, category2 ASC";
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
    $categories1 = sessions_categories1;
    $categories2 = sessions_categories2;
    $ids = secondary_links[array_search($active_link,active_link_keys)];

    $length = count($result);
    for($i = 0; $i < $length; $i++){
        $session = $result[$i];

        if($i === 0 || $session["category1"] !== $result[$i-1]["category1"]){
            echo <<<EOD
            <div class="section-info" id="{$ids[$session["category1"]]}">
                <div class="section-info-container">
                    <h2>{$categories1[$session["category1"]]}</h2>
            EOD;
        }

        if($i === 0 || $session["category2"] !== $result[$i-1]["category2"]){
            echo <<<EOD
            <div class="root">
                <div class="root-title">
                    <h4>{$categories2[$session["category1"]][$session["category2"]]}</h4>
                    <i class="bx bx-plus"></i>
                </div>

                <div class="root-drop-content" style="display: none;">
            EOD;
        }

        echo <<<EOD
        <div class="leaf" id="{$session["id"]}">
            <div class="leaf-title">
                <h5>{$session["title"]}</h5>
                <i class="bx bx-plus"></i>
            </div>
            <div class="leaf-drop-content" style="display: none;" data-seeked="0">
                <i class="bx bx-minus"></i>
            </div>
        </div>
        EOD;

        if($i === ($length - 1) || $session["category2"] !== $result[$i+1]["category2"]){
            echo <<<EOD
                </div>
            </div>
            EOD;
        }

        if($i === ($length - 1) || $session["category1"] !== $result[$i+1]["category1"]){
            echo <<<EOD
                </div>
            </div>
            EOD;
        }
    }  
}

?>