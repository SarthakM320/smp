<?php

require "../../assets/utils/admin_portal/login_status.php";
require "../../assets/utils/db_link.php";

$status = login_status();
if ($status === "N") {
    header("Location: ../index.php");
}

$branch = $_SESSION["branch"];
$id = trim($_GET["id"]);

$link = linktoDAMP();
$query = "SELECT EXISTS (SELECT id FROM `career_information` WHERE `id` = :id AND `branch` = :branch)";
$handle = $link->prepare($query);
$handle->execute(array("id"=>$id,"branch"=>$branch));
$result = $handle->fetch();
if(!$result[0]){
    header("Location: index.php");
}

$relative_path = "../../";

$stylesheet_includes = <<<'EOD'
<link href="../../assets/css/jquery-confirm.min.css" rel="stylesheet">
<!-- Local stylesheets -->
EOD;

$javascript_includes = <<<'EOD'
<script src="../../assets/js/jquery-confirm.min.js"></script>
<!-- Local scripts -->
<script src="../../assets/js/admin_portal/edit_career_information.js"></script>
EOD;

$title = "Edit Career Information";
$logout = true;
$back_link = "index.php";

$content_include = "../../assets/content/admin_portal/edit_career_information.php";

include "../template.php";