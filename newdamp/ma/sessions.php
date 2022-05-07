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

$title = "Sessions";
$active_link = "d-sessions";
$department_code = "ma";
$table = "sessions";

$content_include = "../assets/content/department/sessions.php";

include "../template.php";