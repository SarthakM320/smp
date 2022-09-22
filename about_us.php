<?php
$servername = "localhost";
$username = "root";
// $password = "admin@smp1234";
$password = "sarthak";

// Create connection
$dbhandle = mysqli_connect($servername, $username, $password)
or die("Unable to connect to MySQL");
// echo "Connected successfully";
$sql = 'SELECT * FROM smp.cabinet ORDER BY `Sequence` ASC;';
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
    <meta property="og:title" content="About Us | SMP - IIT Bombay" />
    <meta property="og:description" content="Get to know about our IIT Bombay" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>About Us | SMP - IIT Bombay</title>
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
    <link rel="stylesheet" href="assets/css/side_bar.css?v3">

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
                                <a href="index.php"><img src="assets/img/logo/logo.svg" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10 hide-on-mobile">
                            <div class="menu-wrapper d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-lg-block">
                                    <?php include 'nav.php' ?>
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
    <div class="slider-area d-flex align-items-center" style="background-image: url('assets/img/about_us/bg.jpg');">
        <!--        <div class="slider-active">-->
        <!-- Single Slider -->
        <!--            <div class="single-slider slider-height ">-->
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7 col-md-8">
                    <div class="hero__caption">
                        <!--                                <span data-animation="fadeInLeft" data-delay=".1s">Committed to success</span>-->
                        <h1 data-animation="fadeInLeft" data-delay=".5s" >About Us</h1>
                        <p data-animation="fadeInLeft" data-delay=".9s" align="left">
                            This website has been made to introduce incoming freshers to life at IIT Bombay.
                            Explore this website and use it to make an informed choice about your college and department. The Student Mentor Program has set up this website. We have addressed almost all the important questions on this website, but it might not cover them all.
                            Please feel free to post any query on the <a href="queries.php">Query Portal</a>. Have fun!
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12-col-md-12">
                    <div class="arrow" align="center">
                        <a href="#main_body">
                            <i style="color: white; font-size: 50px" class="fa fa-angle-down" aria-hidden="true">
                            </i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--            </div>-->
        <!--        </div>-->
    </div>
    <!-- slider Area End-->

    <!-- Main Body Start -->


    <div id="main_body">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <section id="sub_body">

                    <section id="our-objective">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="section-heading">Our Objective</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="section-content">
                                        Student Mentor Programme (SMP), is a program within IIT Bombay, with the primary objective of enabling constructive and positive interaction, guidance and mentorship of junior students by senior students. We aim at providing a reliable and comprehensive support system to the student community to motivate them to excel in both academic and non-academic fields, and to make the most of their life at IIT Bombay.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="mentorship">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="section-heading">Mentorship: ISMP and DAMP</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="section-content">
                                        Mentoring is a particular form of relationship designed to provide personal and professional support to an individual. The mentor is more experienced than the mentee and makes use of that experience in a facilitative way to support the development of the mentee. The mentoring relationship provides a developmental opportunity for both parties and is of mutual benefit. In a nutshell, a student mentor's role may be perceived to be facilitative, supportive and developmental for the student community in general. The SMP has two mentorship-related wings: ISMP and DAMP.
                                        <br>
                                        <br>
                                        <p class="section-sub-heading mb-1">Institute Student Mentorship Program</p>
                                        The Institute Student Mentorship Program (ISMP) aims at developing a smooth transition to campus life for every new entrant to an academic program at IIT Bombay. It is an initiative of the SMP within the student community which primarily deals with mentorship for the first-year undergraduate students. Selected senior students, called Institute Student Mentors (ISMs), are responsible for helping a group of first-year students adjust to the new environment. They subsequently monitor their progress throughout the year. Mentors help solve students' academic and personal problems while on campus, and guide them through the first year of college life away from home.
                                        <p class="section-sub-heading mb-1">Department Academic Mentorship Program</p>
                                        DAMP or Department Academic Mentorship Program, is a student-run support program primarily for students at the sophomores level and above. Apart from mentorship for sophomores, the DAMP program hosts many sessions and has compiled various resources to guide you through all your years at the institute. All of this is handled by the DAMP Coordinators at the department level and by the Academic and DAMP Cabinet Heads at the Institute level.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="elp">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="section-heading">English Learning Program</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="section-content">
                                        The primary language for the mode of instruction at IIT Bombay is English. Knowing the English language opens opportunities at the international level and helps easier social integration in the global circle as well. Hence, it is all the more important to be able to understand the language. The English Learning Program, another vertical of the Student Mentor Program, aims to help students who wish to improve their English by facilitating learning through their initiatives, classes and activities. ELP has two different programs for helping students learn and improve their English, the British Council Program and the English Language Improvement Training.<br>
                                        <br>
                                        <p class="section-sub-heading mb-1">THE BRITISH COUNCIL PROGRAM</p>
                                        This program is specifically designed for first-year students wherein professional instructors from the British Council take English classes throughout the year. These sessions involve a plethora of interactive activities which develop primary skills associated with an overall command of the language like speaking, writing and reading. Students who need special English support for the purposes of integrating well in academics and social life on campus are identified for the program via an English test taken during the time or orientations. After the batch is selected, this program runs similar to a course, with a set curriculum conducted by experienced English instructors. It acts as an important step in ensuring a smooth transition to campus life and academics for freshmen, and similar to any course, it is most effective when a student is engaged and attending regularly.

                                        <p class="section-sub-heading mb-1">English Language Improvement Training (ELIT)</p>
                                        This is a majorly informal, student-run program for all those who wish to improve their English skills by being active in a relaxed and learning- enabling environment. It has a dynamic curriculum with classes on grammar, communication, reading, writing, listening and many more topics! ELIT is open for all students from first-year UG to final-year PHD students and runs in three editions in an academic year: Autumn, Spring and Summer. TAship positions at the beginning of each edition are opened for students who wish to participate in the program as instructors.


                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="cat">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="section-heading">Counseling and Training Cabinet (CaT)</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="section-content">
                                        Mentors of the ISMP (Institute Student Mentorship Program) and D-AMP (Department Academic Mentorship Program) who are selected after the interview process are given training on mentoring and other skills that will be required throughout the year. CaT cabinet is in charge of coordinating with all the necessary faculties and organizing these training sessions. The Cabinet is also responsible for coming up with the Fresher Handbooks, along with DAMP, ISMP and ARP mentor handbooks every year. All the Freshers are mandated to attend a workshop in their autumn semester called EQ 101 for helping them adjust to life in IIT Bombay positively, conducting which is also looked after by this cabinet. Along with this the cabinet also handles the social media presence of SMP.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="team">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="section-heading">Team</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="section-content">
                                        <p>
                                        The Student Mentor Program is a wide institute body comprising various verticals and has an extensive team. It is headed by the overall coordinators at the institute level and the cabinet heads are responsible for heading and coordinating activities of their respective verticals like DAMP, ELP and CaT. The DAMP is headed by 20 DAMP Coordinators at the departmental level and by the DAMP cabinet heads at the institute level. 144 Institute Student Mentors and 316 Department Academic Mentors make up the Mentorship team of the Student Mentor Program.
                                        <br><br>
                                        <div class="row d-flex justify-content-center">
                                            <?php
                                                for($x=0; $x<3;$x++){
                                                  echo '<div class="col-md-3">
                                                      <div class="team-div" data-toggle="modal" data-target="#member'.$x.'">
                                                          <div class="team-img">
                                                              <img src="assets/img/about_us/ismp_team/'.$details[$x]['Picture_path'].'" alt="">
                                                              <div class="team-overlay">
                                                                  <a href="#!"><i class="fa fa-info"></i></a>
                                                              </div>
                                                          </div>
                                                          <div class="team-desc">
                                                              <div class="team-name">'.$details[$x]['Name'].'</div>
                                                              <div class="team-role">'.$details[$x]['Position'].'</div>
                                                          </div>
                                                      </div>
                                                  </div>';
                                                }
                                            ?>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <?php
                                                for($x=3; $x<6;$x++){
                                                  echo '<div class="col-md-3">
                                                      <div class="team-div" data-toggle="modal" data-target="#member'.$x.'">
                                                          <div class="team-img">
                                                              <img src="assets/img/about_us/ismp_team/'.$details[$x]['Picture_path'].'" alt="">
                                                              <div class="team-overlay">
                                                                  <a href="#!"><i class="fa fa-info"></i></a>
                                                              </div>
                                                          </div>
                                                          <div class="team-desc">
                                                              <div class="team-name">'.$details[$x]['Name'].'</div>
                                                              <div class="team-role">'.$details[$x]['Position'].'</div>
                                                          </div>
                                                      </div>
                                                  </div>';
                                                }
                                            ?>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <?php
                                                for($x=6; $x<count($details);$x++){
                                                  echo '<div class="col-md-3">
                                                      <div class="team-div" data-toggle="modal" data-target="#member'.$x.'">
                                                          <div class="team-img">
                                                              <img src="assets/img/about_us/ismp_team/'.$details[$x]['Picture_path'].'" alt="">
                                                              <div class="team-overlay">
                                                                  <a href="#!"><i class="fa fa-info"></i></a>
                                                              </div>
                                                          </div>
                                                          <div class="team-desc">
                                                              <div class="team-name">'.$details[$x]['Name'].'</div>
                                                              <div class="team-role">'.$details[$x]['Position'].'</div>
                                                          </div>
                                                      </div>
                                                  </div>';
                                                }
                                            ?>
                                        </div>

                                        <br>

                                        <div class="hero__btn d-flex justify-content-center" data-animation="fadeInLeft" data-delay="1.1s">
                                            <a href="ismp_mentors.php" class="btn custom-btn"><span>ISMP Mentors 2022</span><i class="fa fa-angle-right pl-0" style="background: none"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </section>
            </div>

            <div class="col-md-4 col-sm-12">
                <div id="side">

                    <div id="side_menu">
                        <div class="side-menu-header">
                            <!--                            <img src="assets/img/notific-alt.svg" alt="">-->
                            <h4 class="text-left">Navigation</h4>
                        </div>
                        <div class="side-menu-content">
                            <ul id="side_nav">
                                <li><a class="nav-link active" href="#our-objective">Our Objective</a></li>
                                <li><a class="nav-link" href="#mentorship">Mentorship</a></li>
                                <li><a class="nav-link" href="#ismp">ISMP</a></li>
                                <li><a class="nav-link" href="#elp">ELP</a></li>
                                <li><a class="nav-link" href="#cat">CAT</a></li>
                                <li><a class="nav-link" href="#team">Team</a></li>
                            </ul>
                        </div>
                    </div>
                    <div id="news_section">
                        <div class="news-header">
                            <!--                            <img src="assets/img/notific-alt.svg" alt="">-->
                            <h4 class="text-left">Announcements</h4>
                        </div>
                        <div class="news-content">
                            <ul>
                                 
                                <!--<li><a href="documents/Scholarship-letter-for-1st-year-amended.docx" target="_blank">Letter for IT Scholarship</a></li>-->
                                  
                                 
                                   
                                <!--<li>You can check the roll numbers <a href="http://www.iitb.ac.in/newacadhome/RollList_BTech_DD_BS2020Batch.pdf" class="link" target="_blank">here</a></li>
                                <li style="font-size: 0.75em;"><sup><img src="assets/img/new.gif" alt=""></sup><a href="http://www.iitb.ac.in/newacadhome/OrientationandRegistrationScheduleUG2020.pdf" target="_blank">E-Orientation Schedule</a></li>
                                <li style="font-size: 0.75em;"><sup><img src="assets/img/new.gif" alt=""></sup><a href="http://www.iitb.ac.in/newacadhome/OfferLetter2021-22-JEE.pdf" target="_blank">Offer letter for students admitted to IITB through JOSAA</a></li>
                                <li style="font-size: 0.75em;"><sup><img src="assets/img/new.gif" alt=""></sup><a href="http://www.iitb.ac.in/newacadhome/bdesinfo.pdf" target="_blank">Important dates for students admitted to IITB through UCEED</a></li>
                                <li><a href="javascript:void(0)" target="_blank">E-Orientation Schedule</a></li>-->
                                 
                                <li style="font-size: 0.75em;"><sup><img src="assets/img/new.gif" alt=""></sup>For Important Updates regarding the UG first-year Students of IIT Bombay, visit <a href="https://www.iitb.ac.in/newacadhome/ugNewEntrants2021.jsp" class="link" target="_blank">this link</a></li>
                                <li style="font-size: 0.75em;"><sup><img src="assets/img/new.gif" alt=""></sup>All students who have frozen their seats at IIT Bombay, please join the facebook group <a href="https://m.facebook.com/groups/543202254245767/" class="link" target="_blank">here</a></li>
<li style="font-size: 0.75em;"><sup><img src="assets/img/new.gif" alt=""></sup>To stay tuned for further updates follow us on <a href="https://www.instagram.com/smp.iitb/" class="link" target="_blank">Instagram</a></li>
			    	            <li style="font-size: 0.75em;">Contact information for prospective women students: <a href="mailto:jeew.helpdesk@iitb.ac.in">jeew.helpdesk@iitb.ac.in</a></li>
                                <li style="font-size: 0.75em;"><sup><img src="assets/img/new.gif" alt=""></sup>The branch change policy would be the same in IIT Bombay as it has been for the previous years. Visit <a href="https://www.iitb.ac.in/newacadhome/RulesforChangeofBranch201312March.pdf" class="link">Branch Change</a> to know more about the same.</li>
                                <li style="font-size: 0.75em;"><sup><img src="assets/img/new.gif" alt=""></sup><a href="https://josaa.nic.in/webinfo/File/GetFile//?FileId=2&LangId=P">Schedule of events of JOSAA-2021</a></li>
                                <li><a href="faq.php">FAQs and Query Portal</a></li>
<!--                                <li><a href="http://www.iitb.ac.in/newacadhome/JEE2019OfferLetter.pdf" >Offer letter for UCEED new entrants</a></li>-->
<!--                                <li><a href="http://www.iitb.ac.in/newacadhome/JEE2019OfferLetter.pdf" >Offer letter for JEE new entrants</a></li>-->
<!--                                <li><span>The last date to pay the fees is 22nd July 2019 as stated in the <a class="link" href="http://www.iitb.ac.in/newacadhome/JEE2019OfferLetter.pdf">offer letter</a>.</span></li>-->
<!--                                <li><span><sup><img src="assets/img/new.gif" alt=""></sup>All the new entrants must compulsorily bring with them a hardcopy of the offer letter at the time of reporting at IITB. For if not followed, the student will be denied entry into the campus.</span></li>-->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Main Body End -->
</main>

<!-- Modals start here -->
<?php
  for($x=0; $x<count($details);$x++){
    echo '<div class="modal fade" id="member'.$x.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-4">
                            <div class="team-modal-img-div">
                                <div class="team-modal-img">
                                    <img src="assets/img/about_us/ismp_team/'.$details[$x]['Picture_path'].'" alt="">
                                    <div class="team-modal-overlay">
                                        <a href="'.$details[$x]['Facebook_handle'].'" target="_blank"><i class="fa fa-facebook-f"></i></a>
                                    </div>
                                </div>
                                <div class="team-modal-desc">
                                    <div class="team-modal-name">'.$details[$x]['Name'].'</div>
                                    <div class="team-modal-role">'.$details[$x]['Department'].'</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="team-modal-about-div">
                                <div class="team-modal-about">
                                    '.$details[$x]['Biography'].'</div>
                                <div class="team-modal-contact">
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
<!-- Modals end here -->

<?php include 'footer.php' ?>

<!-- Scroll Up -->
<div id="back-top" style="display: none">
    <a title="Go to Top" href="#"><i><img src="assets/img/up.svg" alt=""></i></a>
</div>

<i id="close_btn"></i>
<i id="announcement-btn" style="display: none"><img src="assets/img/notific.svg" alt=""></i>
<i id="nav-btn" style="display: none"><img src="assets/img/nav.svg" alt=""></i>


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

</body>
</html>
