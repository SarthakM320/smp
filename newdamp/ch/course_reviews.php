<?php

$relative_path = "../";

$stylesheet_includes = <<<'EOD'
<!-- Local stylesheets -->
<link href="../assets/css/jquery-confirm.min.css" rel="stylesheet">
EOD;

$javascript_includes = <<<'EOD'
<!-- Local scripts -->
<script src="../assets/js/jquery-confirm.min.js"></script>
<script src="../assets/js/department/get_info.js"></script>
EOD;

$title = "Course Reviews";
$active_link = "d-course-reviews";
$department_code = "ch";
$table = "course_reviews";

$content_include = "../assets/content/department/course_reviews.php";

include "../template.php";