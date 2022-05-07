<div id="table-info" style="display: none;" data-table="<?php echo $table; ?>"></div>

<?php

require "../assets/utils/admin_portal/functions.php";

$result = null;
try{
    $link = linktoDAMP();
    $query = "SELECT id, department, code, year, title, category FROM `course_reviews` WHERE `branch` = :branch ORDER BY category, code, year ASC";
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
    $categories = course_reviews_categories;
    $ids = secondary_links[array_search($active_link,active_link_keys)];

    $length = count($result);
    for($i = 0; $i < $length; $i++){
        $course_review = $result[$i];
        $department_to_upper = strtoupper($course_review["department"]);

        if($i === 0 || $course_review["category"] !== $result[$i-1]["category"]){
            echo <<<EOD
            <div class="section-info" id="{$ids[$course_review["category"]]}">
                <div class="section-info-container">
                    <h2>{$categories[$course_review["category"]]}</h2>
            EOD;
        }

        if($i === 0 || $course_review["code"] !== $result[$i-1]["code"]){
            echo <<<EOD
            <div class="root">
                <div class="root-title">
                    <h4>{$department_to_upper} {$course_review["code"]} - {$course_review["title"]}</h4>
                    <i class="bx bx-plus"></i>
                </div>

                <div class="root-drop-content" style="display: none;">
            EOD;
        }

        $year = $course_review["year"] ? $course_review["year"] : "Year not available";
        echo <<<EOD
        <div class="leaf" id="{$course_review["id"]}">
            <div class="leaf-title">
                <h5>{$year}</h5>
                <i class="bx bx-plus"></i>
            </div>
            <div class="leaf-drop-content" style="display: none;" data-seeked="0">
                <i class="bx bx-minus"></i>
            </div>
        </div>
        EOD;

        if($i === ($length - 1) || $course_review["code"] !== $result[$i+1]["code"]){
            echo <<<EOD
                </div>
            </div>
            EOD;
        }

        if($i === ($length - 1) || $course_review["category"] !== $result[$i+1]["category"]){
            echo <<<EOD
                </div>
            </div>
            EOD;
        }
    }  
}

?>

<!--
<div class="section-info" id="first-year">
    <div class="section-info-container">
        <h2>First Year</h2>
        
        <div class="root">
            <div class="root-title">
                <h4>CE 102 - Engineering Mechanics</h4>
                <i class="bx bx-plus"></i>
            </div>

            <div class="root-drop-content" style="display: none;">
                <div class="leaf" id="2">
                    <div class="leaf-title">
                        <h5>2016</h5>
                        <i class="bx bx-plus"></i>
                    </div>
                    <div class="leaf-drop-content" style="display: none;" data-seeked="0">
                        <i class="bx bx-minus"></i>
                    </div>
                </div>
                <div class="leaf" id="4">
                    <div class="leaf-title">
                        <h5>2017</h5>
                        <i class="bx bx-plus"></i>
                    </div>
                    <div class="leaf-drop-content" style="display: none;" data-seeked="0">
                        <i class="bx bx-minus"></i>
                    </div>
                </div>
                <div class="leaf" id="6">
                    <div class="leaf-title">
                        <h5>2018</h5>
                        <i class="bx bx-plus"></i>
                    </div>
                    <div class="leaf-drop-content" style="display: none;" data-seeked="0">
                        <i class="bx bx-minus"></i>
                    </div>
                </div>
                <div class="leaf" id="30">
                    <div class="leaf-title">
                        <h5>2019</h5>
                        <i class="bx bx-plus"></i>
                    </div>
                    <div class="leaf-drop-content" style="display: none;" data-seeked="0">
                        <i class="bx bx-minus"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
-->