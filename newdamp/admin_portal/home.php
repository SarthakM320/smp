<?php

require "../assets/utils/admin_portal/login_status.php";

$status = login_status();
if($status === "N"){
    header("Location: index.php");
}

$relative_path = "../";

$stylesheet_includes = <<<'EOD'
<!-- Local stylesheets -->
EOD;

$javascript_includes = <<<'EOD'
<!-- Local scripts -->
EOD;

$title = "Home";
$logout = true;

$content_include = "../assets/content/admin_portal/home.php";

include "template.php";
