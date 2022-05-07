<?php

$relative_path = '../';

$stylesheet_includes = <<<'EOD'
<!-- Local stylesheets -->
EOD;

$javascript_includes = <<<'EOD'
<!-- Local scripts -->
EOD;

$title = <<<'EOD'
Mechanical
EOD;

$active_link = "d-home";
$department_code = "me";
$content_include = "../assets/content/department/me/index.php";

include "../template.php";