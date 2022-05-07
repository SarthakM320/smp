<?php

$relative_path = "./";

$stylesheet_includes = <<<'EOD'
<!-- Local stylesheets -->
EOD;

$javascript_includes = <<<'EOD'
<!-- Local scripts -->
<script src="assets/js/department/get_info.js"></script>
EOD;

$title = <<<'EOD'
Search Engine
EOD;

$intro_title = "Search Engine";
$content_include = "./assets/content/search.php";
$table = "course_reviews";

include "template.php";
