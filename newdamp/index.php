<?php

$relative_path = './';

$stylesheet_includes = <<<'EOD'
<!-- Local stylesheets -->
EOD;

$javascript_includes = <<<'EOD'
<!-- Local scripts -->
EOD;

$title = <<<'EOD'
DAMP
EOD;

$active_link = "home";
$intro_title = "Centralized DAMP Blog";
$content_include = "./assets/content/index.php";

include "template.php";
