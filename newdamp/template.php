<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Global stylesheets -->
    <!--========== BOX ICONS ==========-->
    <link href="<?php echo $relative_path ?>assets/css/preloader.css" rel="stylesheet" type="text/css">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <link href="<?php echo $relative_path ?>assets/css/sidebar.css" rel="stylesheet">
    <link href="<?php echo $relative_path ?>assets/css/index.css" rel="stylesheet">

    <?php echo $stylesheet_includes ?>

    <title><?php echo $title; ?></title>

    <script src="<?php echo $relative_path ?>assets/js/modernizr-custom.js"></script>
</head>

<body>
    <div id="path-info" style="display: none;" data-path="<?php echo $relative_path; ?>"></div>

    <!--========== HEADER ==========-->
    <header class="header">
        <div class="header__container">
            <i class="bx bxs-disc" class="header__img"></i>
            <!--<img src="<?php echo $relative_path ?>assets/img/logo.svg" alt="" class="header__img">-->

            <a href="#" class="header__logo">DAMP</a>

            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>

        </div>
    </header>

    <!--========== NAV ==========-->
    <div class="nav" id="navbar">
        <nav class="nav__container">
            <div>
                <a href="<?php echo $relative_path ?>" class="nav__link nav__logo">
                    <i class='bx bxs-disc nav__icon' ></i>
                    <span class="nav__logo-name">DAMP</span>
                </a>

                <div class="nav__search">
                    <i class='bx bx-search nav__search-icon'></i>
                    <input id="search" name="search" type="search" placeholder="Quick Search..." class="nav__search-input" autocomplete="off">
                    <div class="nav__search-suggestions"></div>
                </div>

                <div class="nav__list">
                    <div class="nav__items">
                        <h3 class="nav__subtitle">General</h3>

                        <a href="<?php echo $relative_path ?>" class="nav__link <?php echo ($active_link === "home") ? "active" : ""; ?>">
                            <i class='bx bx-home nav__icon'></i>
                            <span class="nav__name">Home</span>
                        </a>

                        <a href="#" class="nav__link <?php echo ($active_link === "about-us") ? "active" : ""; ?>">
                            <i class='bx bx-user nav__icon'></i>
                            <span class="nav__name">About Us</span>
                        </a>

                        <div class="nav__dropdown">
                            <a href="#" class="nav__link">
                                <i class='bx bx-building nav__icon'></i>
                                <span class="nav__name">Departments</span>
                                <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                            </a>

                            <div class="nav__dropdown-collapse">
                                <div class="nav__dropdown-content">
                                    <a href="<?php echo $relative_path ?>ae" class="nav__dropdown-item">Aerospace Engineering</a>
                                    <a href="<?php echo $relative_path ?>cl" class="nav__dropdown-item">Chemical Engineering</a>
                                    <a href="<?php echo $relative_path ?>ch" class="nav__dropdown-item">Chemistry</a>
                                    <a href="<?php echo $relative_path ?>ce" class="nav__dropdown-item">Civil Engineering</a>
                                    <a href="<?php echo $relative_path ?>cs" class="nav__dropdown-item">Computer Science & Engineering</a>
                                    <a href="<?php echo $relative_path ?>hs" class="nav__dropdown-item">Economics</a>
                                    <a href="<?php echo $relative_path ?>ee" class="nav__dropdown-item">Electrical Engineering</a>
                                    <a href="<?php echo $relative_path ?>ep" class="nav__dropdown-item">Engineering Physics</a>
                                    <a href="<?php echo $relative_path ?>en" class="nav__dropdown-item">Energy Science & Engineering</a>
                                    <a href="<?php echo $relative_path ?>es" class="nav__dropdown-item">Environmental Sciences</a>
                                    <a href="<?php echo $relative_path ?>ma" class="nav__dropdown-item">Mathematics</a>
                                    <a href="<?php echo $relative_path ?>me" class="nav__dropdown-item">Mechanical Engineering</a>
                                    <a href="<?php echo $relative_path ?>mm" class="nav__dropdown-item">MEMS</a>
                                </div>
                            </div>

                        </div>

                        <div class="nav__dropdown">
                            <a href="#" class="nav__link">
                                <i class='bx bx-cog nav__icon' ></i>
                                <span class="nav__name">Resources</span>
                                <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                            </a>

                            <div class="nav__dropdown-collapse">
                                <div class="nav__dropdown-content">
                                    <a href="#" class="nav__dropdown-item">UGAC</a>
                                    <a href="#" class="nav__dropdown-item">Insight Articles</a>
                                    <a href="#" class="nav__dropdown-item">Bandhu</a>
                                    <a href="#" class="nav__dropdown-item">Creddit</a>
                                </div>
                            </div>

                        </div>

                    </div>

                    <?php

                    require $relative_path . "assets/utils/common.php";

                    $index = null;
                    $cs = null;
                    // If no department code given, set index to 'false'
                    if(!isset($department_code)){
                        $index = false;
                    }
                    else{
                        // Search for department code in all department codes and store the index if present
                        $index = array_search($department_code,department_codes);
                        // Function for accessing constants in strings
                        $cs = "constant";
                    }

                    if($index !== false){
                        // Give 'active' class to active links
                        $d_home_class = ($active_link === "d-home") ? "active" : "";
                        $d_about_us_class = ($active_link === "d-about-us") ? "active" : "";
                        $d_faq_class = ($active_link === "d-faq") ? "active" : "";

                        echo <<<EOD
                        <div class="nav__items">
                            <h3 class="nav__subtitle">{$cs('department_names')[$index]}</h3>

                            <a href="{$relative_path}{$department_code}" class="nav__link {$d_home_class}">
                                <i class='bx bx-home nav__icon' ></i>
                                <span class="nav__name">Home</span>
                            </a>

                            <a href="{$relative_path}{$department_code}/about_us.php" class="nav__link {$d_about_us_class}">
                                <i class='bx bx-user nav__icon' ></i>
                                <span class="nav__name">About Us</span>
                            </a>

                            <a href="{$relative_path}{$department_code}/faq.php" class="nav__link {$d_faq_class}">
                                <i class='bx bx-question-mark nav__icon' ></i>
                                <span class="nav__name">FAQ</span>
                            </a>
                        EOD;

                        require $relative_path . "assets/utils/db_link.php";
                        
                        // Key for fetching non-zero entry pages for department (e.g. ae,)
                        $key = "%" . $department_code . ",%";
                        
                        // Fetch non-zero entry pages and sections for the department
                        $link = linktoDAMP();
                        $query = "SELECT prim_cat, sec_cat FROM `accounts` WHERE branches LIKE :branch ORDER BY prim_cat, sec_cat ASC";
                        $handle = $link->prepare($query);
                        $handle->execute(array("branch"=>$key));
                        $result = $handle->fetchAll(PDO::FETCH_ASSOC);

                        // Display links of all pages and their sections which have non-zero entries
                        $length = count($result);
                        for($i = 0; $i < $length; $i++){
                            $link = $result[$i];
                            $primary_category = $link["prim_cat"];
                            $secondary_category = $link["sec_cat"];
                            $d_link_class = ($active_link === active_link_keys[$primary_category]) ? "active" : "";

                            if($link["sec_cat"] === null){
                                echo <<<EOD
                                <a href="{$relative_path}{$department_code}/{$cs('primary_links')[$primary_category]}" class="nav__link {$d_link_class}">
                                    <i class='bx bx-{$cs('icons')[$primary_category]} nav__icon'></i>
                                    <span class="nav__name">{$cs('primary_categories')[$primary_category]}</span>
                                </a>
                                EOD;

                                continue;
                            }

                            if($i === 0 || $link["prim_cat"] !== $result[$i-1]["prim_cat"]){
                                echo <<<EOD
                                <div class="nav__dropdown">
                                    <a href="{$relative_path}{$department_code}/{$cs('primary_links')[$primary_category]}" class="nav__link {$d_link_class}">
                                        <i class='bx bx-{$cs('icons')[$primary_category]} nav__icon' ></i>
                                        <span class="nav__name">{$cs('primary_categories')[$primary_category]}</span>
                                        <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                    </a>

                                    <div class="nav__dropdown-collapse">
                                        <div class="nav__dropdown-content">
                                EOD;
                            }

                            echo <<<EOD
                            <a href="{$relative_path}{$department_code}/{$cs('primary_links')[$primary_category]}#{$cs('secondary_links')[$primary_category][$secondary_category]}" class="nav__dropdown-item">{$cs('secondary_categories')[$primary_category][$secondary_category]}</a>
                            EOD;

                            if($i === ($length - 1) || $link["prim_cat"] !== $result[$i+1]["prim_cat"]){
                                echo <<<EOD
                                        </div>
                                    </div>

                                </div>
                                EOD;
                            }
                        }

                        /* Old code of menu
                        $dropdown_started = false;
                        $dropdown_finished = false;
                        $primary_category_running = null;
                        $last_section_dropdown = false;
                        foreach($result as $section){
                            $primary_category = $section["prim_cat"];
                            $secondary_category = $section["sec_cat"];
                            $d_link_class = ($active_link === active_link_keys[$primary_category]) ? "active" : "";

                            if($dropdown_started && $primary_category_running !== $primary_category && $primary_category_running !== null){
                                $dropdown_finished = true;
                                $dropdown_started = false;
                            }

                            if($dropdown_finished){
                                echo <<<EOD
                                        </div>
                                    </div>

                                </div>
                                EOD;

                                $dropdown_finished = false;
                            }

                            if($secondary_category === null){
                                $primary_category_running = $primary_category;
                                $last_section_dropdown = false;

                                echo <<<EOD
                                <a href="{$relative_path}{$cs('primary_links')[$primary_category]}" class="nav__link {$d_link_class}">
                                    <i class='bx bx-{$cs('icons')[$primary_category]} nav__icon'></i>
                                    <span class="nav__name">{$cs('primary_categories')[$primary_category]}</span>
                                </a>
                                EOD;
                            }
                            else{
                                $last_section_dropdown = true;

                                if(!$dropdown_started){
                                    $primary_category_running = $primary_category;

                                    echo <<<EOD
                                    <div class="nav__dropdown">
                                        <a href="{$relative_path}{$department_code}/{$cs('primary_links')[$primary_category]}" class="nav__link {$d_link_class}">
                                            <i class='bx bx-{$cs('icons')[$primary_category]} nav__icon' ></i>
                                            <span class="nav__name">{$cs('primary_categories')[$primary_category]}</span>
                                            <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                        </a>

                                        <div class="nav__dropdown-collapse">
                                            <div class="nav__dropdown-content">
                                    EOD;

                                    $dropdown_started = true;
                                }

                                echo <<<EOD
                                <a href="{$relative_path}{$department_code}/{$cs('primary_links')[$primary_category]}#{$cs('secondary_links')[$primary_category][$secondary_category]}" class="nav__dropdown-item">{$cs('secondary_categories')[$primary_category][$secondary_category]}</a>
                                EOD;
                            }
                        }

                        if(last_section_dropdown){
                            echo <<<EOD
                                    </div>
                                </div>

                            </div>
                            EOD;
                        }*/

                        echo <<<EOD
                        </div>
                        EOD;
                    }

                    ?>

                </div>
            </div>
        </nav>
    </div>

    <?php

    $link_index = array_search($active_link,active_link_keys);
    if($link_index !== false && $active_link !== "d-internship-reviews" && $active_link !== "d-faq"){
        $length = count($result);

        /* Page Navigation */
        for($i = 0; $i < $length; $i++){
            $link = $result[$i];
            $primary_category = intval($link["prim_cat"]);
            $secondary_category = $link["sec_cat"];

            if($primary_category === $link_index){
                if($link["prim_cat"] !== $result[$i-1]["prim_cat"]){
                    echo <<<EOD
                    <div class="page-nav">
                        <i class="activator bx bx-align-left" id="activator"></i>
                        <nav>
                            <ul>
                    EOD;
                }

                echo <<<EOD
                <li>
                    <a href="#{$cs('secondary_links')[$primary_category][$secondary_category]}"><i class='bx bx-{$cs('secondary_icons')[$primary_category][$secondary_category]}'></i></a>
                    <span>{$cs('secondary_categories')[$primary_category][$secondary_category]}</span>
                </li>
                EOD;

                if($link["prim_cat"] !== $result[$i+1]["prim_cat"]){
                    echo <<<EOD
                            </ul>
                        </nav>
                    </div>
                    EOD;
                }
            }
        }

        /* Mobile Page Navigation */
        for($i = 0; $i < $length; $i++){
            $link = $result[$i];
            $primary_category = intval($link["prim_cat"]);
            $secondary_category = $link["sec_cat"];

            if($primary_category === $link_index){
                if($link["prim_cat"] !== $result[$i-1]["prim_cat"]){
                    echo <<<EOD
                    <nav class="mobile-page-nav">
                    EOD;
                }

                echo <<<EOD
                <a href="#{$cs('secondary_links')[$primary_category][$secondary_category]}"><i class='bx bx-{$cs('secondary_icons')[$primary_category][$secondary_category]}'></i><br>{$cs('secondary_categories')[$primary_category][$secondary_category]}</a>
                EOD;

                if($link["prim_cat"] !== $result[$i+1]["prim_cat"]){
                    echo <<<EOD
                    </nav>
                    EOD;
                }
            }
        }

    }
        
    ?>

    <div class="middle">
        <!-- Introduction -->
        <div class="intro">
            <div class="heading">
                <div class="background"></div>
                <div class="title">
                    <?php
                    if(isset($intro_title)){
                        echo $intro_title;
                    }
                    else{
                        echo department_names[$index];
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main">
            <?php include $content_include; ?>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="contact">
                <div class="contact-card">
                    <i class="bx bx-mail-send"></i>
                    <div class="popup">Contact Us</div>
                </div>
                <div class="contact-card">
                    <i class="bx bxl-facebook"></i>
                    <div class="popup">Follow Us</div>
                </div>
                <div class="contact-card">
                    <i class="bx bx-question-mark"></i>
                    <div class="popup">Queries</div>
                </div>
            </div>

            <div class="copyright">
                ©2021-22 All rights reserved | SMP Team 2022-23
            </div>
        </div>
        
    </div>

<!-- Global scripts -->
<script src="<?php echo $relative_path ?>assets/js/vendor/jquery-3.6.0.min.js"></script>
<script src="<?php echo $relative_path ?>assets/js/preloader.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/CSSRulePlugin.min.js'></script>
<script src="<?php echo $relative_path ?>assets/js/sidebar.js"></script>
<script src="<?php echo $relative_path ?>assets/js/index.js"></script>

<?php echo $javascript_includes ?>
</body>
</html>