<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Global stylesheets -->
    <link href="<?php echo $relative_path; ?>assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <?php echo $stylesheet_includes ?>

    <title><?php echo $title; ?></title>
</head>

<body>
    <div class="container-fluid">
        <div class="row mb-3 p-4 fs-1" style="background: linear-gradient(to right,#8080ff,#3333ff);">
            <div class="col-auto">
                DAMP Admin Portal
                <?php 
                session_start();
                if(isset($_SESSION["branch"])){
                    include $relative_path . "assets/utils/common.php";
                    $index = array_search($_SESSION["branch"],department_codes);
                    echo " - " . department_names[$index];
                }
                ?>
            </div>
            <div class="col-auto ms-auto">
                <?php

                if(isset($back_link)){
                    echo <<<EOD
                    <a class="btn btn-warning me-2" href="{$back_link}" role="button">Back</a>
                    EOD;
                }

                if(isset($logout)){
                    echo <<<EOD
                    <a href="{$relative_path}assets/utils/admin_portal/logout.php" class="btn btn-warning" role="button">Logout</a>
                    EOD;
                }

                ?>
            </div>
        </div>
        
        <?php include $content_include; ?>
    </div>

<!-- Global scripts -->
<script src="<?php echo $relative_path; ?>assets/js/vendor/jquery-3.6.0.min.js"></script>
<script src="<?php echo $relative_path; ?>assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<?php echo $javascript_includes ?>
</body>
</html>
