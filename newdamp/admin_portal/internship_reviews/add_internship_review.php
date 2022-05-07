<?php

require "../../assets/utils/admin_portal/login_status.php";

$status = login_status();
if ($status === "N") {
    header("Location: ../index.php");
}

$relative_path = "../../";

$stylesheet_includes = <<<'EOD'
<link href="../../assets/css/jquery-confirm.min.css" rel="stylesheet">
<!-- Local stylesheets -->
EOD;

$javascript_includes = <<<'EOD'
<script src="../../assets/js/jquery-confirm.min.js"></script>
<!-- Local scripts -->
<script src="../../assets/js/admin_portal/add_internship_review.js"></script>
EOD;

$title = "Add Internship Review";
$logout = true;
$back_link = "index.php";

$content_include = "../../assets/content/admin_portal/add_internship_review.php";

include "../template.php";