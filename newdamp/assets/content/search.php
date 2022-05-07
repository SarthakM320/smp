<div id="table-info" style="display: none;" data-table="<?php echo $table; ?>"></div>

<?php

require "assets/utils/db_link.php";

$department = trim($_GET["department"]);
$code = intval(trim($_GET["code"]));

$result = null;
try{
    $link = linktoDAMP();
    $query = "SELECT id, branch, year, title FROM `course_reviews` WHERE `department` = :department AND `code` = :code ORDER BY branch, year ASC";
    $handle = $link->prepare($query);
    $handle->execute(array("department"=>$department,"code"=>$code));
    $result = $handle->fetchAll(PDO::FETCH_ASSOC);
}
catch(Exception $e){
    echo var_dump($e);
}

if(!$result || count($result) === 0){
    echo '<h1 class="random-title">No entries to show.</h1>';
}
else{
    $department_to_upper = strtoupper($department);
    $title = $result[0]["title"];
    echo <<<EOD
    <h1 class="random-title">{$department_to_upper} {$code} - {$title}</h1>
    EOD;

    $length = count($result);
    for($i = 0; $i < $length; $i++){
        $course_review = $result[$i];

        if($i === 0 || $course_review["branch"] !== $result[$i-1]["branch"]){
            $index = array_search($course_review["branch"],department_codes);
            $branch_name = department_names[$index];

            echo <<<EOD
            <div class="section-info">
                <div class="section-info-container">
                    <h2>{$branch_name}</h2>
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

        if($i === ($length - 1) || $course_review["branch"] !== $result[$i+1]["branch"]){
            echo <<<EOD
                </div>
            </div>
            EOD;
        }
    }  
}

