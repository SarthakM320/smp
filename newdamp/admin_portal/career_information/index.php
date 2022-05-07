<?php

require "../../assets/utils/admin_portal/login_status.php";

$status = login_status();
if ($status === "N") {
    header("Location: ../index.php");
}

$relative_path = "../../";

$stylesheet_includes = <<<'EOD'
<link href="../../assets/css/jquery-confirm.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.2/datatables.min.css"/>
<!-- Local stylesheets -->
EOD;

$javascript_includes = <<<'EOD'
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.2/datatables.min.js"></script>
<script src="../../assets/js/jquery-confirm.min.js"></script>
<!-- Local scripts -->
<script src="../../assets/js/admin_portal/career_information.js"></script>
EOD;

$title = "Career Information";
$logout = true;
$back_link = "../home.php";
$table = "career_information";

$content_include = "../../assets/content/admin_portal/career_information.php";

include "../template.php";
