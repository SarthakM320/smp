<?php
$servername = "localhost";
$username = "root";
// $password = "admin@smp1234";
$password = "sarthak";


// Create connection
$dbhandle = mysqli_connect($servername, $username, $password)
or die("Unable to connect to MySQL");
// echo "Connected successfully";
$sql = 'SELECT * FROM smp.ismp ORDER BY `Name` ASC;';
// $selected = mysqli_select_db($dbhandle, "smp")
// $result = $dbhandle -> query($sql);
// or die("Could not select examples");

$retval = mysqli_query( $dbhandle, $sql);
if(! $retval ) {
      die('Could not get data: ' . mysqli_error());
   }    // mysql_close($conn);
 // while ($row = mysqli_fetch_assoc($retval)) {
 //   $str = print_r ($row, true);
 //   echo $str;
 //   echo $row['First Name'];
 // }

 $details = $retval -> fetch_all(MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <meta charset="utf-8">
    <meta property="fb:app_id" content="168000230712068" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://smp.gymkhana.iitb.ac.in/assets/img/thumbnail.jpg" />
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="1200">
    <meta property="og:url" content="http://smp.gymkhana.iitb.ac.in" />
    <meta property="og:title" content="ISMP Team 2021 | SMP - IIT Bombay" />
    <meta property="og:description" content="Get to know about our IIT Bombay" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ISMP Team 2021 | SMP - IIT Bombay</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="/AmeyGohil">
    <meta keywords="iitb, iit bombay, smp, student mentorship programme, smp iit bombay, iit bombay fees, phd, placements, iit bombay world ranking, iit bombay courses, iit bombay hostel, iit bombay cut off, iit bombay fest, iit bombay admission, iit bombay package, admission, cutoff, iit bombay b tech, iit bombay computer science, engineering, iit bombay department, hostel fees, infrastructure, iit, iit bombay library, iit bombay academics, iit bombay official website, website, alumni, lectures, elit iit bombay, iit bombay freshers, iit bombay faculty, iit bombay registration, ishaan gupta iitb, iit bombay counselling schedule, iit bombay dress code, asha dhaka iitb, iit bombay electrical, aerospace iit bombay, iit bombay clubs, gymkhana iit bombay, fun at iit bombay, iit bombay physics, iit bombay food, iit bombay freshers party 2018, iit bombay freshers 2018, iit bombay campus, life at iit bombay, iit bombay notable alumni, iit bombay recruitment, iit delhi freshers 2018, iit bombay faculty recruitment, iit bombay faculty electrical, iit bombay faculty mechanical, iit bombay faculty chemistry, iit bombay mtech, iit bombay faculty computer science, iit bombay registration online, iit bombay lakshya, college to corporate iit bombay registration, iit bombay admission, iitbombayx lakshya, iit bombay certificate download, iit bombay online certificate courses, iit bombay soft skills, ishaan gupta iit bombay case, ishaan gupta iiserb, ishaan gupta iiser bhopal, iit bombay vendor registration, iit bombay petroleum engineering, iitb gpo, iit bombay student login, iit bombay undergraduate courses, iti bombay, iit guwahati dress code, iit madras dress code, iit bombay hostel rules, iit bombay hostel accommodation, all about iit bombay, iit kharagpur dress code, iit madras, iit courses, iit ranking, iit kanpur, iit meaning, iit chicago, iit acceptance rate, iit full form, iit college fees, indian institute of technology madras, iit roorkee, iit delhi placements, iit kharagpur, iit, iit jee exam, iit india, top iit colleges in india, iit delhi, illinois institute of technology ranking, iit men's basketball, iit namibia, iit kharagpur career, iit career center, iit careers chicago, iit career fair, kharagpur airport, indian institute of technology kharagpur, kharagpur pin code, iit website, iit jee acceptance rate, jee advanced, total seats in iit 2018, how to get admission in iit, iit jee wiki, is iit jee toughest in the world, indian institute acceptance rate, iit acceptance rate 2018, indian institutes of technology subsidiaries, total iit college in india, indian institute of technology delhi, iit colleges in india rank wise 2018, indian institute of technology delhi notable alumni, iit delhi address, iit delhi recruitment, iit delhi phd admission 2018, iit faculty recruitment, iit madras electrical engineering, iit madras physics, iit madras cutoff, iit faculty salary, iit faculty handbook, iit madras india, iit madras courses, iit madras address, iit madras chennai, iit madras chemistry, iit phd admission, iit madras campus, iit graduate admission, iit admission requirements, iit admission procedure, iit admission for nri, resonance, cbse results 2017, quora, quoraora, quora wiki, gate schedule 2019, gate anime, gate design, ies, iit madras recruitment, iit madras phd, iit madras gate, iit madras notable alumni, iit madras mtech, iit madras admission, iit madras faculty recruitment, iit madras phd admission, jee 2018 counselling, iit jee, iit advanced 2017 result, jee java, allen, neet, how to prepare for iit jee in 1 year, iit preparation books, how to clear concepts for iit jee, fundamentals of physics, askiitians, iit bombay, iit jee colleges, nit colleges in india, iit in india, top engineering colleges in india, indian institute of technology acceptance rate, iit ranking in world, gate exam, gate exam eligibility, gate exam gate colleges, gat 2019">
    <link rel="image_src" href="https://smp.gymkhana.iitb.ac.in/assets/img/thumbnail.jpg">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- Bootstrap CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Carousel CSS here -->

    <!-- Other Libraries CSS here -->
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <!-- Icon CSS here -->
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <!-- Other Libraries CSS here -->
    <!-- Icon CSS here -->
    <!--    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">-->
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <!-- Other Libraries CSS here -->
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/toastr.min.css">
    <!-- Custom CSS here -->
    <link rel="stylesheet" href="assets/css/style.css?v2">
    <link rel="stylesheet" href="assets/css/custom.css?v2">
    <link rel="stylesheet" href="assets/css/queries.css">

</head>

<body class="body-bg" style="position: relative;" data-spy="scroll" data-target="#side_menu" data-offset=92>
<!-- Preloader Start -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
                <img src="assets/img/logo/logo.svg" alt="">
            </div>
        </div>
    </div>
</div>

<header>
    <!-- Header Start -->
    <div class="header-area">
        <div class="main-header ">
            <div class="header-bottom sticky-bar header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo">
                                <a href="index.html"><img src="assets/img/logo/logo.svg" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10 hide-on-mobile">
                            <div class="menu-wrapper d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="about_us.php">About Us <i class="fa fa-caret-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="about_us.php#our-objective">Our Objective</a></li>
                                                    <li><a href="about_us.php#mentorship">Mentorship</a></li>
                                                    <li><a href="about_us.php#ismp">ISMP</a></li>
                                                    <li><a href="about_us.php#elp">English Learning Program</a></li>
<li><a href="about_us.php#cat">CAT</a></li>
<li><a href="about_us.php#team">Team</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="general_info.html">General Information <i class="fa fa-caret-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="general_info.html#things-to-bring">Things to bring</a></li>
                                                    <li><a href="general_info.html#campus-checklist">Campus Checklist</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="campus_life.html">Campus Life <i class="fa fa-caret-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="campus_life.html#introduction">Introduction</a></li>
                                                    <li><a href="campus_life.html#in-and-around-the-campus">In & Around the Campus</a></li>
                                                    <li><a href="campus_life.html#hostel-culture">Hostel Culture</a></li>
                                                    <li><a href="campus_life.html#lingo">Lingo</a></li>
                                                    <li><a href="campus_life.html#internet-usage-in-iitb">Internet Usage in IITB</a></li>
                                                    <li><a href="campus_life.html#support-available">Support Available</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="extra_curricular.html">Extracurricular activities <i class="fa fa-caret-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="extra_curricular.html#gymkhana">Gymkhana</a></li>
                                                    <li><a href="extra_curricular.html#culturals">Culturals</a></li>
                                                    <li><a href="extra_curricular.html#media">Media @IIT Bombay</a></li>
                                                    <li><a href="extra_curricular.html#sports">Sports</a></li>
                                                    <li><a href="extra_curricular.html#technical-affairs">Technical Affairs</a></li>
                                                    <li><a href="extra_curricular.html#ibs">IBs</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="academics.html">Academics <i class="fa fa-caret-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="academics.html#introduction">Introduction</a></li>
                                                    <li><a href="academics.html#curriculum">Curriculum</a></li>
                                                    <li><a href="academics.html#departments">Departments</a></li>
                                                    <li><a href="academics.html#branch-change">Branch Change</a></li>
                                                    <li><a href="academics.html#sem-ex">Semester - Exchange</a></li>
                                                    <li><a href="academics.html#cpi-calculation">CPI Calculation</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="for_parents.html">For Parents <i class="fa fa-caret-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="for_parents.html#letter-to-parents">Letter to Parents</a></li>
                                                    <li><a href="for_parents.html#hindi-parents-letter">अभिभावक को पत्र</a></li>
                                                    <li><a href="for_parents.html#fee-structure">Fee Structure</a></li>
                                                    <li><a href="for_parents.html#scholarships-available">Scholarships Available</a></li>
                                                    <li><a href="for_parents.html#accommodations-available">Accommodations available</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="women.html">Women <i class="fa fa-caret-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="women.html#gender-cell">Gender Cell</a></li>
                                                    <li><a href="women.html#helpline">Helpline</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="faq.html">Query <i class="fa fa-caret-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="faq.html">FAQs</a></li>
                                                    <li><a href="queries.html">Ask a Question</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mobile_menu d-block hide-on-desktop"></div>
                        </div>
                        <!-- Mobile Menu -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>

<main>
    <!-- slider Area Start-->

    <div class="slider-area d-flex align-items-center" style="background-color:#ececec">
        <div class="container-fluid">
            <div class="form_body">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="section-heading">ISMP Team 2022-23</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-content">

                            <div class="row d-flex justify-content-center">
                              <?php
                              for ($x = 0; $x < count($details); $x++) {

                                  echo '<div class="col-md-2">';
                                      echo '<div class="ismp-team-div" data-toggle="modal" data-target="#mentor'.$x.'">';
                                          echo '<div class="ismp-team-img">';
                                              echo '<img src="assets/img/about_us/ismp_team/'.$details[$x]['Picture_path'].'" alt="">';
                                              echo '<div class="ismp-team-overlay">';
                                                  echo '<a href="#!"><i class="fa fa-info"></i></a>';
                                              echo '</div>';
                                          echo '</div>';
                                          echo '<div class="ismp-team-desc">';
                                              echo '<div class="ismp-team-name">'. $details[$x]['Name'] .'</div>';
                                              echo '<div class="ismp-team-role">'.$details[$x]['Department'].'</div>';
                                          echo '</div>';
                                      echo '</div>';
                                  echo '</div>';
                                }
                              ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    for ($x = 0; $x < count($details); $x++) {
      echo '<div class="modal fade" id="mentor'.$x.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-4">
                            <div class="ismp-team-modal-img-div">
                                <div class="ismp-team-modal-img">
                                    <img src="assets/img/about_us/ismp_team/'.$details[$x]['Picture_path'].'" alt="">
                                    <div class="ismp-team-modal-overlay">
                                        <a href="'.$details[$x]['Facebook_handle'].'" target="_blank"><i class="fa fa-facebook-f"></i></a>
                                    </div>
                                </div>
                                <div class="ismp-team-modal-desc">
                                    <div class="ismp-team-modal-name">'.$details[$x]['Name'].'</div>
                                    <div class="ismp-team-modal-role">'.$details[$x]['Department'].'</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="ismp-team-modal-about-div">
                                <div class="ismp-team-modal-about">
                                    '.$details[$x]['Biography'].'</div>
                                <div class="ismp-team-modal-contact">
                                    <div>
                                        <i class="fa fa-envelope"></i>
                                        <a href="mailto:'.$details[$x]['Email'].'">'.$details[$x]['Email'].'</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    }
    ?>
</main>

<!-- Modals start here -->


<!-- Modals end here -->

<footer>
    <div class="desktop top">
        <div class="container-fluid">
            <div class="row no-gutters">
                <div class="d-flex align-items-center justify-content-center w-100 col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <div class="ftco-animate d-flex justify-content-center align-items-center w-100 fadeInUp">
                        <ul>
                            <li>
                                <div class="icon tran3s round-border p-color-bg"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                                <h6>Contact Us</h6>
                                <p>
                                    <a href="mailto:smpcs2022@gmail.com">smpcs2022@gmail.com</a>
                                </p>
                            </li>
                            <li>
                                <div class="icon tran3s round-border p-color-bg"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                                <h6>Follow Us</h6>
                                <p>
                                    <a href="https://www.facebook.com/smpiitb">facebook.com/smpiitb</a>
                                </p>
                            </li>
                            <li>
                                <div class="icon tran3s round-border p-color-bg"><i class="fa fa-question" aria-hidden="true"></i></div>
                                <h6>For Queries</h6>
                                <p>
                                    <a href="queries.html">Visit this link</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <div class="ftco-animate d-flex justify-content-center fadeInUp h-100 align-items-center">
                        <div class="text-center">
                            <div class="img">
                                <a href="./">
                                    <img src="assets/img/logo/logo.svg" alt="">
                                </a>
                            </div>
                            <div class="quote">
                                <h4><i><span style="font-weight: bold">“ Learning, Growing, Becoming. ”</span></i><br>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="desktop bottom">
        <div class="container-fluid">
            <p>©2022-23 All rights reserved | <a href="about_us.php#team">SMP Team 2022-23</a></p>
        </div>
    </div>
    <div class="mobile top">
        <div class="container-fluid">
            <div class="footer-icons">
                <div class="icon tran3s round-border p-color-bg"><a href="mailto:smpcs2022@gmail.com"><i class="fa fa-envelope" aria-hidden="true"></i></a></div>
                <div class="icon tran3s round-border p-color-bg"><a href="https://www.facebook.com/smpiitb"><i class="fa fa-facebook" aria-hidden="true"></i></a></div>
                <div class="icon tran3s round-border p-color-bg"><a href="queries.html"><i class="fa fa-question" aria-hidden="true"></i></a></div>
            </div>
            <div class="footer-logo">
                <div class="img">
                    <a href="./">
                        <img src="assets/img/logo/logo.svg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile bottom">
        <div class="container-fluid">
            <p>©2022-23 All rights reserved | <a href="about_us.php#team">SMP Team 2022-23</a></p>
        </div>
    </div>
</footer>

<!-- Scroll Up -->
<div id="back-top" style="display: none">
    <a title="Go to Top" href="#"><i><img src="assets/img/up.svg" alt=""></i></a>
</div>

<!-- JS here -->

<script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="./assets/js/vendor/jquery-3.5.1.min.js"></script>
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<!-- Jquery Mobile Menu -->
<script src="./assets/js/jquery.slicknav.min.js"></script>


<!-- respond , html5shiv , counter , waypoint -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
<!--    <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>

<!-- toastr js -->
<script src="./assets/js/toastr.min.js"></script>

<!-- Jquery Plugins, main Jquery -->
<script src="./assets/js/plugins.js"></script>
<script src="./assets/js/main.js"></script>
<!--
Linux Command to rename images
n=0; ls -tr | while read i; do n=$((n+1)); mv -- "$i" ./mentor"$(printf '%03d' "$n")".jpeg; done
-->
</body>
</html>
