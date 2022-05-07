<?php

require "../assets/utils/admin_portal/login_status.php";

$status = login_status();
if($status === "Y"){
    header("Location: home.php");
}

$relative_path = "../";

$stylesheet_includes = <<<'EOD'
<!-- Local stylesheets -->
EOD;

$javascript_includes = <<<'EOD'
<!-- Local scripts -->
<script src="../assets/js/admin_portal/index.js"></script>
EOD;

$title = "Admin Portal";
$content_include = "../assets/content/admin_portal/index.php";

include "template.php";
