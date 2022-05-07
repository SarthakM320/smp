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

$title = "Career Information";
$active_link = "d-career-information";
$department_code = "me";
$table = "career_information";

$content_include = "../assets/content/department/career_information.php";

include "../template.php";