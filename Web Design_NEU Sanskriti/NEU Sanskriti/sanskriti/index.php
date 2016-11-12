<?php
    session_start();
    $state=5;
    $login=0;
    if(isset($_POST['login_submit']))
    {
        function fun1()
        {
            $_SESSION['upusername']=$_POST['login_username'];
        }
        if($_POST['login_username']=='' or $_POST['login_password']=='')
        {
            $state=0;
        }
        else{
            $cxn=mysqli_connect("localhost","root","","sanskriti_db") or die("Cannot connect to database");
            $u=$_POST['login_username'];
            $qc="select password from users where user_name='".$u."'";
            $out=mysqli_query($cxn,$qc);
            if(mysqli_num_rows($out)<1)
            {
                    $state=1;
            }
            $ext=mysqli_fetch_array($out);
            
            if(password_verify("'".$_POST['login_password']."'",$ext['password']))
            {
                $_SESSION['upusername']=$_POST['login_username'];
                echo "valid";
                $login=1;
            }
            else
            {
                $state=2;
            }
        }
    
    
    }
?>


<?php
    $f=0;
    $da=0;
    $da1=0;
    if(isset($_POST['submit']))
       {
        $cxn=mysqli_connect("localhost","root","","sanskriti_db") or die("Cannot connect to database");
            $qc="select * from users where mail='".$_POST['mail']."'";
            echo $qc;
            $res=mysqli_query($cxn,$qc);
            if(!$res)
            {
                die("Error");
            }
            $nr=mysqli_num_rows($res);
            if($nr>0)
            {
                $f=1;
            }
            
            else
            {
                $q="select * from users where user_name='".$_POST['username']."'";
                echo $q;
                $res1=mysqli_query($cxn,$q);
                $da1=mysqli_num_rows($res1);
                echo "$da1".$da1;
                if($da1==0)
                {
                    echo "inside";
                    $pass= password_hash("'".$_POST['password']."'",PASSWORD_BCRYPT,array('cost' => 12));
                    
                    $qc="insert into users(user_name,mail,password,phone,name,inserted_by) values('".$_POST['username']."','".$_POST['mail']."','".$pass."','".$_POST['phone']."','".$_POST['name']."','".$_POST['name']."')";
                    $out=mysqli_query($cxn,$qc);
                   /* mail($mail, $_POST['username'].' has requested '.$_POST['name'].' access to GPACDW', 'Hi Farika, New Request
                    NU-ID: '.$_POST['username']. ' 
                    Kindly visit Sanskriti to authorize user.
                    Note: Do not reply to this mail. If you are not the intended recipient, kindly delete this message.
                    ');*/
                    if(!$out)
                    {
                           $da=2;
                    }
                }
                else
                {
                    $da=1;
                }
                
            }

        }
       
?> 

<!DOCTYPE html>
<html lang="en">

<head>
  
    

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>NEU Sanskriti</title>
    
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.icon-large.min.css" rel="stylesheet">



    <!-- Css for Blue Imp Gallery -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <link rel="stylesheet" href="css/bootstrap-image-gallery.min.css">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="icon" type="image/x-icon" href="img/favicon.PNG" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"/>

    <!-- Google API for geolocation -->
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <script src="js/bootstrap-image-gallery.js"></script>
    <script src="js/demo.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
   <script >
       var app = angular.module('myApp', []);
       app.controller('myCtrl', function($scope) {
       $scope.password="";    
       $scope.passwordmsg="";
       $scope.email="";    
       $scope.emailmsg="";
       $scope.passwordchange = function() {
           var checkLetter = /[A-Z]/.test($scope.password);
           var checkNumber =  /[0-9]/.test($scope.password)
           if(checkLetter && checkNumber ){
           $scope.passwordmsg="Strong";
           }else{
               $scope.passwordmsg="Weak"; 
           }
       };

       $scope.emailchange = function() {
           var checkemail = $scope.email.endsWith("@husky.neu.edu");
          
           if(!checkemail){
           $scope.emailmsg="Invalid Email";
           }else{
               $scope.emailmsg=""; 
           }
       };
   });
   </script>    
</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top"><center><img height="40" width="40" src="img/Sanskritilogo2.png"/><font color="#0aa0f4"> Sanskriti</font></center></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Sanskriti Home</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">General Information</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">Links</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#team">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Get Involved</a>
                    </li>
                    <li>
                        <?php
                            if($login==0)
                            {
                                echo '<a href="'."#portfolioModal23".'" class="'."portfolio-link".'" data-toggle="'."modal".'">Sign In</a>';
                            }
                            else if($login==1)
                            {
                                echo '<form action="'."index".".".'php" method="'."post".'">';
                                echo '<input type="'."submit".'" value="'."Logout".'" name="'."logout_submit".'" class="'."logout_button".'">';
                                echo '</form>';    

                            }
                        ?>

                        <?php
if(isset($_POST['logout_submit']))
    {
    session_destroy();
    }
?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">
                    <img id="changeSize"  src="img/logo_t.png" alt="logo" width="400" height="130">
                </div>
                <div class="intro-heading">WELCOME 
                    <?php
                        if($login==0)
                        {
                            echo "ALL";
                        }
                        else if($login==1){
                            echo $_SESSION['upusername'];
                        }
                    ?>!!!!</div>
                <a href="#services" class="page-scroll btn btn-xl">Upcoming Events...</a>
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section id="services">
        <div class="container" id="upEve">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Upcoming Events</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="timeline-image">
                        <span class="fa-stack fa-4x">

                        <a href="#portfolioModal19" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                               
                            </div>
                        </div>
                        <img class="img-circle img-responsive" src="img/tarang_icon.png" alt="">
                    </a>
                            
                        </span>
                    </div>
                    <h4 class="service-heading">TARANG</h4>
                    <p class="text-muted">Get ready for some Nach Ganna.. Some glamour! Traditional designs are sure to dazzle as they take you on a journey that will leave you captivated.</p>
                </div>
                <div class="col-md-4">
                    <div class="timeline-image">
                        <span class="fa-stack fa-4x">
                            <a href="#portfolioModal20" class="portfolio-link" data-toggle="modal">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content">
                                       
                                    </div>
                                </div>
                                <img class="img-circle img-responsive" src="img/ipl2.jpg" alt="">
                            </a>                            
                        </span>
                    </div>
                    <h4 class="service-heading">Cricket Tournament</h4>
                    <p class="text-muted">We are elated to announce that we are going to have a Live screening of IPL - 2010 finals (Mumbai Indians vs Chennai Superkings)</p>
                </div>
                <div class="col-md-4">
                    <div class="timeline-image">
                        <span class="fa-stack fa-4x">
                            <a href="#portfolioModal21" class="portfolio-link" data-toggle="modal">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content">
                                       
                                    </div>
                                </div>
                                <img class="img-circle img-responsive" src="img/diversity1.png" alt="">
                            </a>                            
                        </span>
                    </div>
                    <h4 class="service-heading">Cultural Diversity Photoshoot</h4>
                    <p class="text-muted">A photoshoot celebrating the cultural diversity of the Indian graduate student population at Northeastern University</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Grid Section -->
    <section id="portfolio" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">General Information</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                            </div>
                        </div>
                        <img src="img/aboutUSA.jpg" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>About USA</h4>
                        <p class="text-muted">All you need to know about this place</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                            </div>
                        </div>
                        <img src="img/boston_mbta.jpg"  class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Public Transport</h4>
                        <p class="text-muted">Rapid Transit/Key Bus Routes Map</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                            </div>
                        </div>
                        <img src="img/food1.jpg" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Food</h4>
                        <p class="text-muted">Interesting places to Visit for food</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                            </div>
                        </div>
                        <img src="img/shop6.jpg" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Shopping</h4>
                        <p class="text-muted">Information on return policy</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                            </div>
                        </div>
                        <img src="img/curTime.jpg" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Time Zones & Currency</h4>
                        <p class="text-muted">Daylight Saving time information</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                            </div>
                        </div>
                        <img src="img/telephone.jpg" width="345px" height="249.25px" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Telephones</h4>
                        <p class="text-muted">Emergency Contacts & Toll free</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">USEFUL LINKS</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-image">
                                <a href="#portfolioModal7" class="portfolio-link" data-toggle="modal">
                                    <img class="img-circle img-responsive" src="img/events.jpg" alt="">
                                </a>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4></h4>
                                    <h4 class="subheading">Events</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Click here to view the latest happenings in Sanskriti </p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <a href="#portfolioModal8" class="portfolio-link" data-toggle="modal">
                                    <img class="img-circle img-responsive" src="img/media.jpg" alt="">
                                </a>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4></h4>
                                    <h4 class="subheading">Media</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">All events captured on camera!!</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-image">
                                <a href="#portfolioModal9" class="portfolio-link" data-toggle="modal">
                                    <img class="img-circle img-responsive" src="img/board_image.png" alt="">
                                </a>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4></h4>
                                    <h4 class="subheading">E-board</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">The team who manage it all!!</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <a href="#portfolioModal10" class="portfolio-link" data-toggle="modal">
                                    <img class="img-circle img-responsive" src="img/faq.gif" alt="">
                                </a>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4></h4>
                                    <h4 class="subheading">FAQ</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Any questions?? We have an answer to most of them!</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-image">
                                  <a href="#portfolioModal13" class="portfolio-link" data-toggle="modal">                                
                                    <img class="img-circle img-responsive" src="img/rsz_info.png" alt="">
                                </a>
                                </div>
                                 <div class="timeline-panel">
                                <div class="timeline-heading">
                                    
                                    <h4 class="subheading">More Information</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Need more info on University and Boston</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

     <!-- Team Section -->
    <section id="team" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Our Amazing Team</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="team-member">
                        <div class="media">
                        <img src="img/team/rsz_rajani.jpg" class="media__image" style="border-radius: 50%;"  alt="">
                          <div class="media__body">
                            <p><b><font color="white" size="3">Software engineer interested in front end web development</font></b><p>
                          </div>
                        </div>
                        <h4>Rajani Maurya</h4>
                        <p class="text-muted">Design Crafters</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="http://www.twitter.com" target="_blank"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="https://www.facebook.com/rajani.maurya.9?fref=ts" target="_blank"><i class="fa fa-facebook" target="_blank"></i></a>
                            </li>
                            <li><a href="https://linkedin.com/in/rajanimaurya" target="_blank"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                       <div class="media">
                        <img src="img/team/rsz_lakshmi.jpg" class="media__image" style="border-radius: 50%;"  alt="">
                          <div class="media__body">
                            <p><b><font color="white">A passionate software engineer with an interest in full stack web development</font></b><p>
                          </div>
                        </div>
                        <h4>Lakshmi Prabha Swaminathan</h4>
                        <p class="text-muted">Design Crafters</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="http://www.twitter.com" target="_blank"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="https://www.facebook.com/lakshmi.swaminathan.969?fref=ts" target="_blank"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="https://www.linkedin.com/in/lakshmiprabhaswaminathan" target="_blank"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                    <div class="media">
                        <img src="img/team/rsz_1hari.jpg" class="media__image" style="border-radius: 50%;"  alt="">
                          <div class="media__body">
                            <p><b><font color="white">An avid reader with a passion for a career in data analytics. Interested in web design</font></b><p>
                          </div>
                        </div>
                        <h4>Harikrishna Ramakrishnan</h4>
                        <p class="text-muted">Design Crafters</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="https://twitter.com/harry_krish1" target="_blank"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="http://www.facebook.com" target="_blank"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="https://www.linkedin.com/in/harikrishna-ramakrishnan-4b7b594a" target="_blank"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <p class="large text-muted">Contact us for more information.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Clients Aside -->
    <aside class="clients">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <a href="#portfolioModal14" class="portfolio-link" data-toggle="modal">
                        <img src="img/logos/rsz_insu.png" class="img-responsive img-centered" alt="">
                    </a>
                    </br>
                   <center><p><b><font size="5px">Health Insurance</font></b></p></center>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="#portfolioModal15" class="portfolio-link" data-toggle="modal">
                        <img src="img/logos/housingg.png" class="img-responsive img-centered" alt="">
                    </a>
                    </br>
                   <center><p><b><font size="5px">Housing and Accomodation</font></b></p></center>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">
                        <img src="img/logos/contactuss.png" class="img-responsive img-centered" alt="">
                    </a>
                    </br>
                   <center><p><b><font size="5px">Emergency Contact</font></b></p></center>
                </div>
            </div>
        </div>
    </aside>
    
    <!-- Contact Section -->
    <section id="contact">
        <div class="container"   ng-app="myApp" ng-controller="myCtrl">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading"><font color="black"> GET INVOLVED</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" action="index.php" id="contactForm"  method="post" >
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name *" id="name" name="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" ng-change="emailchange()" ng-model="email" class="form-control" placeholder="Your Email *" id="email" name="mail" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger">{{emailmsg}}</p>
                                    <?php
                                        if($f>0)
                                        echo "Email already exists";
                                    ?>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="Your Phone *" id="phone" name="phone" required data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Username *" id="Username" name="username" required data-validation-required-message="Please enter your Username.">
                                    <p class="help-block text-danger"></p>
                                    <?php
                                        if($da1>0)
                                        echo "Username already exists";
                                    ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" ng-change="passwordchange()" ng-model="password" class="form-control" placeholder="Your Password *" id="Password" name="password" required data-validation-required-message="Please enter your password.">
                                    <p class="help-block text-danger">{{passwordmsg}}</p>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Confirm Password *" id="Password" required data-validation-required-message="Please confirm your password.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                             <div class="clearfix"></div> 
                             <div class="col-lg-12 text-center"> 
                               <input type="submit" name="submit" class="btn btn-xl" value="submit"/>                               
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <span class="copyright">Copyright &copy; Sanskriti 2016</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-5">
                    <ul class="list-inline quicklinks">
                        <li><span class="glyphicon glyphicon-map-marker"></span><a href="#portfolioModal18" class="portfolio-link" data-toggle="modal">
                            Location</a></li>

                        <li><a href="#portfolioModal11" class="portfolio-link" data-toggle="modal">Privacy Policy</a>
                        </li>
                        <li><a href="#portfolioModal12" class="portfolio-link" data-toggle="modal">Terms of Use</a></li>
                        <li><a href="#portfolioModal17" class="portfolio-link" data-toggle="modal">Feedback</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>


    <!-- Portfolio Modal 1 -->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Facts about USA</h2>
                             <p class="subPara">This vast nation, approximately three times the size of India, and the fourth largest country in the world, is spectacular in its natural beauty, full of old world charm in the rural reaches of its small towns, and brightly seductive in the glitter of its modern metropolises.<br/>
                             <br/>
                                 American people are one of the friendliest and most informal people in the world. However, inquiry into their personal lives are not welcome unless a degree of intimacy has been established. It appears to be almost mandatory that everyone be polite and friendly. Everybody, from the supermarket clerk to the bus driver, is likely to greet you with a "Hi! How are you doing?" which, unlike in India, is not always an invitation to stop and have a friendly chat.<br/> </p>
                                 
                                 <b>Geography and Climate</b>
                                 <p class="subPara">Administratively, the United States (all 3,628,062 square miles of it) is divided into 50 states and the District of Columbia (Washington D.C.). Of these, 48 states and D.C. are adjacent. Alaska, the 49th state, lies in the upper northwest portion of the North American continent, separated from the main part of the country by Canada. The last state, Hawaii, is made up of a group of islands, off the western coast of the continental United States, in the Pacific Ocean.<br/>
                                <br/>
                                There are four distinct seasons in most parts of the U.S. Spring, Summer, Fall (Autumn), and Winter. Unlike India, there is no marked rainy season. Except for large portions of the southwest that are desert, the rest of the country gets a fair amount of precipitation throughout the year.<br/>
                                </p>
                            
                           
                              
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 2 -->
    <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Public Transport</h2>
                            <p class="item-intro text-muted">Rapid Transit/Key Bus Routes Map</p>
                            <img class="img-responsive img-centered" src="img/boston_mbta.jpg" alt="Boston MBTA Map" alt="">
                            <ul> 
                                <li>Boston has a very good public transporation system. Check the MBTA website for details.</li>
                                <li>You can download a subway map here.</li>
                                <li>You can also buy monthly/semester subway passes through the shopping cart in the My NEU portal.</li>
                            </ul>
                            <p>In some areas you must telephone for a taxi and make an appointment. You will not find them waiting in the street corners but you do find them waiting in a queue at the airport. Taxis are listed in the yellow pages under the name "Taxi" or "Taxicabs".</p>
                            <p>When you call, tell the "dispatch" operator where you are (street address) and where you want to go. The dispatch operator will tell you how long it will take for the taxi to arrive at your starting point. He or she will ask for your telephone number, so they can call you if the taxi driver cannot locate you. You should ask for the estimated cost of the ride. When you enter the taxi, the meter will read flat rate. This is the minimum charge. You will be charged the flat rate for each mile you travel.</p>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 3 -->
    <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2><img src="img/Foodbg.png" alt="Food"/></h2>
                            <p class="item-intro text-muted"></p>
                            <img class="img-responsive img-centered" src="" alt="">
                            <p><b>Interesting places to visit</b></p>                            
                            <p><img src="img/mexicanchip.jpg" alt="foodicon"/><b>Mexican</b> - Bean Buritto, Enchiladas, Bean Taco, Cheese Taco, Bean Tostadas</p>
                            <p><img src="img/recipe_noodles.png" alt="foodicon"/><b>Italian or Greek</b> - Eggplant (brinjal) sandwich, Sphagetti with tomato sauce</p>
                            <p><img src="img/salad_sizz.jpg" alt="foodicon"/><b>American Restaurants (Sizzler, Olive Garden)</b> - Best bet is salad bar & French fries</p>
                            <p><img src="img/mcd.jpg" alt="foodicon"/><b>McDonald's</b> - Mac cheese sandwich, Milk shakes, ice-cream sundaes</p>
                            <p><img src="img/pizza-hut.png" alt="foodicon"/><b>Pizza Hut</b> - vegetarianie Lover's delight, vegetarianie pizza with a choice of toppings</p>
                            <p><img src="img/burger-king.png" alt="foodicon"/><b>Burger King</b> - vegetarian cheese whooper, Garden burger</p>
                           
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 4 -->
    <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Time Zones</h2>
                            <p class="item-intro text-muted">Daylight Saving time information</p>
                            <img class="img-responsive img-centered" src="" alt="">
                            <ol class="subPara">
                                <li>Eastern Time Zone : Connecticut, Delaware, Maine, Massachusetts, New York, Georgia, Michigan etc.</li>
                                <li>Central Time Zone (lags Eastern Time Zone by one hour) : Iowa, Kentucky, Indiana, Kansas, Texas etc.</li>
                                <li>Mountain Time Zone (lags Eastern Time Zone by two hours) : Colorado, Utah, Wyoming, Arizona etc.</li>
                                <li>Pacific Time Zone (lags Eastern TZ by three hours) : California, Oregon, Washington, Nevada, Idaho etc.</li>
                            </ol>
                            <p> As the name suggests, the time is set in such a way that maximum day light could be used. e.g. During summer, the sun rises at around 4-5 o'clock. So the clock is set forward by one hour. This forces all activities to start one hour earlier so that maximum day light is used till late in the evening.</p>
                            <p>Therefore the Clock is set back by one hour on the first Sunday of November 1 (Fall Season) at 2:00 am. Clock is once again set forward by one hour on the first Sunday of April at 2:00 am. (Spring Season). The easiest way to remember this is FALL BACK, SPRING AHEAD.</p>
                            <p>By the way, Arizona is the only state which is not affected by day-light-saving. People there do not ever change the time in their clocks.</p>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 5 -->
    <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Shopping</h2>
                            <p class="item-intro text-muted">Information on return policy</p>
                            <img class="img-responsive img-centered" src="" alt="">
                            <p>The American system of sizes and measurement is different from that in India. Most of the shops in the U.S. are the equivalent of super markets in India. You can go around the shop, buy what you want and pay at the counter. The important difference you will notice is, the shops are driven by customer service. So if you don't like anything that you bought or it doesn't fit you properly you may return it within a certain period.</p>
                            <p>You should inquire about the return policy when you buy returnable goods. Ofcourse you will need to preserve the receipt of the purchase. Most of the time they won't even ask you why you want to return the goods.</p>
                            <p>When you buy shoes, the size should be 2 1/2 more than your size in India. For example, if you buy size 5 in India, you should buy size 7 1/2 in the US.(Or approximatelymate it to the nearest round figure).</p>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Using Telephones</h2>
                            <p class="item-intro text-muted">Emergency Contacts & Toll free</p>
                            <p>The first thing you might do when you come to U.S.A. is call someone. Telephone calls within U.S. are considered "local" (within the area of the caller) or "long distance" (outside the area of the caller). Local calls within a short region are free unless made from a public pay phone which is a coin operated machine. Long distance calls are charged at varying rates, depending on how you make the call (which long distance carrier/company you use), for how long you speak and the time of the day. Note that the telephone companies in the U.S. are private.</p>
                            <p>Other important facilities provided are:</p>
                            <ol>
                               <li>Yellow pages (Telephone directory) - Advertisements and Telephone numbers of businesses.</li>
                                <li>Emergency Telephone Number - Dial 911(Fire/Ambulance/Police) for any type of emergency</li>
                                <li>Directory assistance - Local telephone numbers - 411 , Long distance - 1-(Area Code)-555-1212 </li>
                                <li>Toll free - Most of the 1-800 numbers are toll free. You will not be charged for the calls you make to such numbers. Some telephone numbers have alphabets in them such as 1-800-COLLECT. </li>
                            </ol>
                            <p>Most people use answering machines which are connected to their telephones, or some kind of voice mail system. It has a standard pre-recorded greeting which is played when you call up and then after some beeps, it records your message. Initially you will feel like you were talking to a dead person, but soon you realize the importance of owning an answering machine. We bet you'll buy one too!.</p>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 7 -->
    <div class="portfolio-modal modal fade" id="portfolioModal7" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Events</h2>
                            <p class="item-intro text-muted"></p>
                
  <h3>IPL Finals</h3>
  <div>
    <p>
    <font color="black" family="Myriad Set Pro" size="4">We are elated to announce that we are going to have a Live screening of IPL - 2010 finals (Mumbai Indians vs Chennai Superkings)<br>
                                Date:   Sunday, April 25, 2010<br>
                                Time:   9:30am - 2:30pm<br>
                                Location:   West Village F, Room # 19<br>
                                So all the Cricket fans out there gear up for the finals... Watch it live with your friends... Hope to see you guys... Cheers!!!</font> 
    </p>
  </div>
  <h3>SPORTS SEASON</h3>
  <div>
    <p><font color="black" family="Myriad Set Pro" size="3">Sanskriti is glad to bring to you the sports schedule for the year 2008. Here is the list of sports we have planned to arrange for you guys:</p>
                                <ul style="list-style-type:none">
                                    <li>Cricket (Boys only - max 120 names to be accepted)</li>
                                    <li>Soccer (Boys only - max 56 names to be accepted)</li>
                                    <li>Volley Ball (max 64 names to be accepted)</li>
                                    <li>Throw-Ball (Girls only – max 64 names to be accepted)</li>
                                    <li>Badminton</li>
                                    <li>Table Tennis</li>
                                    <li>Pool</li>
                                </ul>
                                The entry fee for the events will be as follows:
                                <ul style="list-style-type:none">
                                    <li>Cricket - $ 5</li>
                                    <li>All other games - $ 5 (pay $ 5 and play any or every other game)</li>
                                </ul>
            </font></p></div>
            <h3>REGISTRATION DATE</h3>
            <div>
                <p><font color="black" family="Myriad Set Pro" size="3">
                      
                                Last date of registration for cricket is 20th May 2008. Names will be registered only upon payment of the said amount. No names will be accepted after this date. To register please contact one of the following

                                Punit Nahar - 617-697-7612
                                Prasad Kamath – 857-205-0509
                                Nirav - 857-472-8125
                                Please Note: Cricket matches will begin from 1st June. A detailed schedule will be sent out once the registration process is completed. We understand that some students are back home in India or have other plans for summer. Taking this into consideration, we have decided that other events, except Cricket, would be scheduled around the month of August. Details of the same will be mailed in due course. Payments for these events can also be made later. However, this may not be applied for Cricket registration. Registration for Cricket closes on the 20th and no names will be taken after the said date.</font></p> 
                    </div>
  </div>

</br></br>
                     
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 8 -->
    <div class="portfolio-modal modal fade" id="portfolioModal8" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Media</h2>
                            <p class="item-intro text-muted">All Events captured on Camera!!</p>
                            
                            <p>Click this to check <a href="#portfolioModal19" class="portfolio-link" data-toggle="modal">Tarang</a> Event</p>
                            <p>Click this to check <a href="#portfolioModal20" class="portfolio-link" data-toggle="modal">Cricket Tournament</a> Event</p>
                            <p>Click this to check <a href="#portfolioModal21" class="portfolio-link" data-toggle="modal">Cultural Diversity</a> Event</p>
                                
                                
                                
                                
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 9 -->
    <div class="portfolio-modal modal fade" id="portfolioModal9" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>SANSKRITI BOARD</h2>
                            <h4>CURRENT BOARD</h4>
                            <img src="img/Eboard.jpg" width='450' height='300' id="currentboard"><br>
<font color="BLACK" family="Myriad Set Pro" size="4">Team Members<br>
    <ol style="list-style-type: none;">
        <li>Mihir Mehta-President</li>
 <li>Prateek Gangwal - Vice President</li> 
 <li>Anisha Deevakonda - Secretary</li>
 <li>Priya Puthankar - Treasurer</li>
 <li>Gopal Patel - Event Coordinator</li>
 <li>Shubha Gupta - Cultural Secretary</li>
 <li>Rahul Kale - Student Affairs Coordinator</li>
 <li>Chandrika Mothukuri - Webmaster </li>  <br>   
        <h4>PAST BOARD</h4>
    <ol style="list-style-type: none;">
  <li>Abhijit Kulkarni - President </li>
  <li>Nivisha Naik - Vice President </li>
  <li>Ankit Padhiar - Secretary</li>
  <li>Munish Sheth - Treasurer </li>
  <li>Dhaval Rathod - Event Coordinator</li>
  <li>Anvitha Ganesh - Cultural Secretary</li>
  <li>Dhanesh Amarnani - Sports Secretary</li>
  <li>Vinay Mehta - Student Affairs Coordinator</li> 
  <li>Nisarg Mehta - Webmaster</li> 
        
        </ol>
        </font>
        
        
        </ol>
        </font>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 10 -->
    <div class="portfolio-modal modal fade" id="portfolioModal10" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>FAQ</h2>
                           
                        
                            <b>I have not yet received my I-20?</b><br>

For queries regarding I - 20 s and when you would receive them, write to your respective departments or call up the ISSI. <br>

<b>How good is my department?</b><br>

It depends on your field of specialization. Some fields have more opportunities than other fields as well. You must get in touch with people in the same field, to learn more about it. <br><br>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 11 -->
    <div class="portfolio-modal modal fade" id="portfolioModal11" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Privacy Policy</h2>
                            <p class="item-intro text-muted"></p>
                            <p>A privacy policy is a statement or a legal document (in privacy law) that discloses some or all of the ways a party gathers, uses, discloses, and manages a customer or client's data. It fulfills a legal requirement to protect a customer or client's privacy. Personal information can be anything that can be used to identify an individual, not limited to but including name, address, date of birth, marital status, contact information, ID issue and expiry date, financial records, credit information, medical history, where one travels, and intentions to acquire goods and services.[1] In the case of a business it is often a statement that declares a party's policy on how it collects, stores, and releases personal information it collects. It informs the client what specific information is collected, and whether it is kept confidential, shared with partners, or sold to other firms or enterprises.</p>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Portfolio Modal 12 -->
    <div class="portfolio-modal modal fade" id="portfolioModal12" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Terms Of Use</h2>
                            <p class="item-intro text-muted"></p>
                            <p>Terms of use(also known as terms of service and terms and conditions, commonly abbreviated as ToS or TOS and TOU) are rules, that one must agree to abide by in order to use a service. Terms of service can also be merely a disclaimer, especially regarding the use of websites.</p>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Portfolio Modal 13 -->
    <div class="portfolio-modal modal fade" id="portfolioModal13" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr" >
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container" >
                <div class="row" >
                    <div class="col-lg-8 col-lg-offset-2" >
                        <div class="modal-body" >
                            <h2>Find More Information here</h2>
                          
   
        <div class="row" width="100%" >
                <div id="tabs" width="800px" style="background: none repeat scroll 0% 0% #CBEBFD;"  >
    <ul class="nav nav-tabs" id="myTab" style="background: none repeat scroll 0% 0% #3BB3F6;">
        <li class="active"><a href="#tabs-1" style="background: none repeat scroll 0% 0% #EF5350;">Northeastern Info</a>
        </li>
        <li><a href="#tabs-2" style="background: none repeat scroll 0% 0% #F06292;">Student Info</a>
        </li>
        <li><a href="#tabs-3" style="background: none repeat scroll 0% 0% #CE93D8;">Send Money-India</a>
        </li>
        <li><a href="#tabs-4" style="background: none repeat scroll 0% 0% #FFB74D;">Travel Info</a>
        </li>
        <li><a href="#tabs-5" style="background: none repeat scroll 0% 0% #66BB6A;">Etiquette</a>
        </li>
    </ul>
    <div id="tabs-1">
        <p style="text-align: justify;"><b>Northeastern's Administrative offices</b><br>
The Bursar's Office (now called the Customer Service Center). They share offices with the Registrar in 120 Hayden Hall (building 53 on the map listed above); 617-373-2270. This is where you go if you've got questions about your account, or if you need to clear financial blocks. This is also where you get your student ID.
The Cashier's Office, 248 Richards (building 42), 617-373-2366. T Passes and other minor payments.
Payroll Office, 225 Richards, 617-373-2280. This office is useful to those of you who will be receiving a stipend. Go here to submit W-4 forms (federal and state income tax withholding), pick up stipend checks, and sign up for direct deposit. <br>
<b>Fees</b><br>
Go through the documents that you got from the university or look on the department's website to find the cost per credit. Additionally , miscellaneous charges such as recreation fees, student activity fees and a ONE TIME International Student Fee of $200<br>
<b>Northeastern ID</b><br>
Visit the Registrar's/Customer Service office located at the 1st floor (here 1st floor is equivalent to ground floor in India) in Hayden Hall to obtain a NU - ID. Take along your passport and I-20.<br>
<b>NU Link</b><br>
You can also search and register for jobs in the student employment link in MYNEU.</p>
    </div>
    <div id="tabs-2">
        <p style="text-align: justify;"><b>Books</b><br>
Consult your immediate seniors in your respective departments to find out what books to bring. If no one from your department has replied to you then go to your department website and try and get the course webpage. You will find out which book was used the last time the course was offered. In all probability, the same will be used this time around. If you know the professor's name, it will make it easier to search the department webpage. Else, you can click on the "Employee Directory" link on the university website www.neu.edu. <br>
<b>Financial Aid</b><br>
No one can tell you if you will or will not get it. It is possible as much as it is not possible. You will hear this a lot for aid scene here "Be at the right place at the right time". I'll add that you got to be the "right person" for that position too. Every one who comes here is all pumped up and try and hit in all directions for aid. So be aware that you are facing a very good competition when it comes to financial aid. Give a lot of introspection as to what you think are your SPECIAL ABILITIES and market yourself on those. - As quoted by Nitish Gupta.
There are different types to aid in NU. The basic one is a NUTA. It stands for Northeastern University Tuition Assistance. It pays your tuition in return for 10 hours of work per week. You can work 10 hours per week off - campus to support your living expenses. 10 Hours will not give you a lot of money but you get your tuition paid!!!
</p>
    </div>
    <div id="tabs-3">
        <p style="text-align:justify;">Money transfer to/from India<br>
These are a few options that you can consider while transferring money to India<br>
<ol>
<li style="text-align:justify;">http://www.timesofmoney.com is basically a Times of India website. So it is reliable. The transfer time is usually 10 days and there are no transaction fees and better rates are offered if you are sending $1000 or more.</li>
<li style="text-align:justify;">You can open a Citibank NRO/NRE account and maintain ZERO balance for 20 yrs. For just sending money to India, you can open a simple NRO account. The CITI people try to squeeze you into maintaining a minimum balance of $250/$500 but it is not mandatory. Its upto an individual to negotiate and they will be more than willing to let you maintain ZERO balance, after all they want your business. Also, check their website for further details.</li>
<li style="text-align:justify;">You can also send checks to India. Try to get an official check from your bank. It will cost you a minimum amount(e.g. around $6 for $1000), or you can also send a normal check. For an official check it will take the Indian bank about 10 days to encash it and for normal check it takes about one month to get the money deposited in Indian bank account. Exchange rates of RBI will be applicable on this transaction. There are options of opening a NRI account with Citibank or ICICI, but that will also make money subject to same exchange rates, just that transaction will be much faster.</li></ol></p>
    </div>
            
                <div id="tabs-4">
        <p style="text-align: justify;">
          <b> Travelling abroad on a F1 visa</b> <br>
Always remember to visit the ISSI before you make any trip abroad and get your I-20 signed if more than 6 months have elapsed since you last travelled . Visit the ISSI website for details regarding necessary documents.<br>
<b>TRAVEL ADVISORY FOR F-1 STUDENTS ENGAGED IN POST-COMPLETION OPTIONAL PRACTICAL TRAINING (OPT)</b><br>
The U.S. Department of Homeland Security (DHS) has issued a new interpretation of the regulations pertaining to travel of F-1 visa holders engaged in post-completion Optional Practical Training (OPT). Please read the information below carefully if you are an F-1 student planning to travel outside the U.S. while engaging in post-completion OPT. The International Student & Scholar Institute (ISSI) advises F-1 students on post-completion OPT to adhere to the following guidelines:
If your OPT is APPROVED:<br>
If your OPT application has been approved and you depart the U.S. before you obtain a job or a job offer, you will not be allowed to re-enter the U.S.
If you receive your Employment Authorization Document (EAD) card and wish to travel before or during your approved OPT, be sure to carry proof of employment or a job offer letter along with your EAD card and other immigration documents. You need not have started your employment before you leave, provided you have already secured a job or a job offer.<br>
</p>
    </div>
            
                            <div id="tabs-5">
        <p style="text-align: justify;">
         <b> The Anti Universe phenomenon</b><br>
When you come to the U.S. you will notice the opposite everywhere. This is just to make you get a hang of it. The cars are driven on the right hand side instead of left hand side of the road. So you should look left first while crossing roads :-). You may have to insert the key upside down and rotate it in the opposite direction to unlock. You will also notice that switches work in opposite direction i.e. UP is ON and DOWN is OFF :-).<br>
The date is written with the month first, then day, followed by the year. As one of our American friends pointed out jokingly, "its logical, if you see that India is exactly opposite in location on the globe, to U.S.!!!"<br>
<b>Office and the Work Environment</b><br>
Before you start your first day of work or co-op , get a hang of the work environment in the USA. Read on for some typical environments you may find.<br>
Project Leaders are very understanding and friendly and do not unduly pressurize you to perform. They will definitely give you some time to come up to speed on their work environment.
There is a lot of individualistic approach. Every person's inputs are given a lot of importance. Independent views are respected. Before discarding any of your ideas, they will give you a good enough reason for doing so.<br>
For the smallest of decisions they will sometimes hold a meeting and get the entire team's inputs/comments/suggestions before proceeding. One feels important when this is done. But sometimes it can get boring.<br>
</p>
    </div>
</div>
</br></br>
<div id="tabid"></div>
    <script>
  
    $("#tabs").tabs({
    activate: function (event, ui) {
        var active = $('#tabs').tabs('option', 'active');
        $("#tabid").html('the tab id is ' + $("#tabs ul>li a").eq(active).attr("href"));
    }
}
);
</script>
    </div>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 14 -->
    <div class="portfolio-modal modal fade" id="portfolioModal14" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Health Insurance</h2>
                            <p class="item-intro text-muted"></p>
                            <img class="img-responsive img-centered" src="" alt="">
                            <h3>Medical Insurance</h3>
                            <p style="text-align: justify;">In the U.S., it is MANDATORY to have health Insurance. For the initial days say a month, get a plan from India. <br>
                            In the U.S. you can take
                                
                                    <li>NU Health Insurance (NUSHIP) - Though expensive, it is an excellent                                             plan, and provides full support. People who have a tendency to fall sick                                          must take this.</li>
                                    <li>Other third party insurances such as the ICSWEB (Plan B). That is the                                            most widely used insurance policy among Indian graduate students. The                                             best part about ICS is that you can pay your premium in installments                                             of 3 months. That really helps in the settling down phase.</li>
                                    <li>Another insurance website is http://www.travelinsure.com which is                                               cheaper than ICS Web.</li>
                            As soon as one arrives in US he/she is required to get a Social Security number immediately. It is a very simple procedure.<br>

DO NOT buy any two year health insurance plan from India. A one month plan is fine. Ask the company as to how they settle payments, whether you have to call a person in India . Most of them are partners with International agencies for operations in the U.S. Give them a scenario where someone who has their policy falls sick and has to see a doctor and ask them to explain the whole process from there. That will give you a better idea of each policy.<br>

Some of these companies also give Travel/luggage insurance coupled with one month health insurance. Some policies are tailor made for first time student travelers to U.S.A, so choose your insurance wisely.<br>

Once you get access to your my-neu account, DO NOT FORGET to waive the NU-SHIP fee from your tuition amount if you are taking some other policy.</p>
                            <h4>MEDICAL INSURANCE</h4>
                            <p style="text-align: justify;">In the U.S., it is very important to have a coverage of medical insurance as medical treatment is extremely expensive. In order to be covered under any kind of health insurance, you have to possess a SSN.<br>

If you need to take medicines containing habit forming drugs, it is wise to have a prescription for them prepared in advance by your physician, or at least an explanatory letter/medical report from him. Also ask your doctor to furnish you with the generic names of any medicines that you or family members need or are currently using as brand names for medicines may be different in the U.S.<br>

It is always a good idea to carry past diagnoses and treatment records for any children that may be traveling with you. American doctors always question new patients about their medical histories before treating them any further. <br>

Several medicines that are commonly available in India qualify as prescription drugs in the U.S. and cannot be obtained over the counter in a pharmacy (drugstore). Pharmacies do not, generally, accept prescriptions written outside the U.S. Carry at least a month's supply of medication for any on-going medical problem. This will allow enough time for your health insurance to become active and for you to find a new physician. <br>

All medication that you carry should be clearly labeled and have a valid prescription accompanying it. Since several medicines available in India are banned in the U.S., carrying a prescription will guard you against any suspicion of smuggling. This applies especially to homeopathic medicines (which, by the way, are very rarely available in the U.S.) that are often mistaken for illegal drugs at customs.</p>
                            <h4>ILLNESS</h4>
                            <p style="text-align: justify;">God forbid, but if something happens to you, here is what you should know: <br>

The Medical Benefit Card which is sent by the Medical Insurance Company is an important card and should be acquired at the earliest. This card entitles you to coverage under certain medical categories only. There are two acceptable ways of payment for the Doctor's services which depends on the Doctor. The Doctor's receptionist is the best person to ask payment related questions. Some Doctors ask you to pay them (by cash, check, credit card etc.) immediately after the service. The receptionist will then give you a formal bill, which you must send (by postal mail) to the Medical Insurance Company alongwith the claim form. The Insurance Co. will then send you a check after verifying your claim. Other Doctors will note down the details of your Medical Insurance Company from your card. They will then send the bill to the Insurance Company and receive the payment directly. You need not pay the Doctor. But in both the above modes, remember that there are certain charges which the Insurance Company will not pay and which they don't cover. So find out the details from the Insurance Co. about your respective coverage/medical problem etc. <br>

For certain kinds of medical problems where you have to visit the Doctor repeatedly, only a fixed number of visits per year are paid by the Insurance Company and not all.</p>
                            
                            <h4>HOW TO DECIDE ON THE DOCTOR TO VISIT</h4>
                            <p style="text-align: justify;">Ask your colleagues or other Indian friends. Otherwise check up the yellow pages (phone directory). Look under the "Physicians" heading. Telephone the Doctor and fix up an appointment. Only in cases of emergency, do the Doctors see you immediately, otherwise it is always by appointment.<br>

You can claim the expenses for any prescribed medicine that you have to buy from the Drug (medical) Store.<br>

NOTE:<br>

Pain in the lower back and strain between the shoulder blades and a stiff neck are very common due to the kind of spring mattresses and soft foam pillows available in the U.S. and one just needs to get used to it.
Beware of Dental problems since they are usually not fully covered under the Insurance Scheme.</p>
                            
                            
                                    
                            </ol>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 15 -->
    <div class="portfolio-modal modal fade" id="portfolioModal15" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Temporary Accomodation</h2>
                            <p class="item-intro text-muted"></p>
                            <img class="img-responsive img-centered" src="" alt="">
                            <p>Students coming to Northeastern in Fall term typically move into their apartments  on September 1 (start of a lease term). If you plan to arrive early, 
                                you might need to stay temporarily at an apartment for a few days. 
                                Please fill out a excel sheet below to find any students currently offering 
                                temporary accomodations. Their contact details are also present so that you can 
                                reach them. </p>
                                                   
                             <?php 
  if($login==1) {                          
echo "<p><b>";
echo '<font size="'."4".'">';
echo '<a href="'."https://docs.google.com/spreadsheets/d/1VKCwGl9bj1EdvboPT1DRJyiLmLDXIB72It5G9BkGizE/edit?usp=sharing".'">TEMPORARY ACCOMODATION FORM</a></font>';
echo"</b></p>";
}

else{
    echo "<p><b>";
    echo '<font size="'."4".'">';
    echo "You are not authorized to view the form. Please sign in to access the form.</font>";
    echo"</b></p>";
}


?>   
                            
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 16 -->
    <div class="portfolio-modal modal fade" id="portfolioModal16" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Shopping</h2>
                            <p class="item-intro text-muted">Information on return policy</p>
                            <img class="img-responsive img-centered" src="" alt="">
                            <p>The American system of sizes and measurement is different from that in India. Most of the shops in the U.S. are the equivalent of super markets in India. You can go around the shop, buy what you want and pay at the counter. The important difference you will notice is, the shops are driven by customer service. So if you don't like anything that you bought or it doesn't fit you properly you may return it within a certain period.</p>
                            <p>You should inquire about the return policy when you buy returnable goods. Ofcourse you will need to preserve the receipt of the purchase. Most of the time they won't even ask you why you want to return the goods.</p>
                            <p>When you buy shoes, the size should be 2 1/2 more than your size in India. For example, if you buy size 5 in India, you should buy size 7 1/2 in the US.(Or approximatelymate it to the nearest round figure).</p>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 17 -->
    <div class="portfolio-modal modal fade" id="portfolioModal17" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Feedback form</h2>
                            <p class="item-intro text-muted"></p>
                            <img class="img-responsive img-centered" src="" alt="">
                            <p>Your valuable suggestions are always welcome to improve our organization</p>
                            <iframe src="https://docs.google.com/forms/d/1EWi_QtmIB-iyt34Qs-_7GLlJDttT3LYJZqgK2WQyQmQ/viewform?embedded=true" width="760" height="1450" style="border: 4px 	#0000FF solid;"  marginheight="0" marginwidth="0">Loading...</iframe>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 18 -->
    <div class="portfolio-modal modal fade" id="portfolioModal18" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h3><b>Your Current Location</b></h3>
                            <div id="mapholder" style="width:700px;height:500px;"></div>
                            <br/>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 19 -->
    <div class="portfolio-modal modal fade" id="portfolioModal19" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">      
                            <h2>Tarang</h2>
                            <p>SUNDAY, MARCH 10, 2013 AT 6:00PM TO 9:00PM
                                BLACKMAN THEATER 342 HUNTINGTON AVENUE, BOSTON, MA, BOSTON</p>

                                <p>Join the members of Sankriti, Northeastern’s Indian Graduate Student                                             Association, in bringing their country’s vibrant history to life before your                                    eyes. The unique customs 
                                and values from within India’s beautifully diverse regions will 
                                be expressed through an array of imaginative and energetic talent. A brilliant display of fashion, local customs, and dance will follow. For tickets, visit the ISSI website: 
                                www.northeastern.edu/issi under “Life at NU”</p>
                                                            <form class="form-inline">
                                <div class="form-group">
                                    <button id="video-gallery-button" type="button" class="btn btn-success btn-lg">
                                        <i class="glyphicon glyphicon-film"></i>
                                        Launch Video Gallery
                                    </button>
                                </div>
                                <div class="form-group">
                                    <button id="image-gallery-button" type="button" class="btn btn-primary btn-lg">
                                        <i class="glyphicon glyphicon-picture"></i>
                                        Launch Image Gallery
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <br/>
                <div id="links" style="display:none"></div>
                <br/>
            </div>
            <div id="blueimp-gallery" class="blueimp-gallery">
                <div class="slides"></div>
                <h3 class="title"></h3>
                <a class="prev">‹</a>
                <a class="next">›</a>
                <a class="close">×</a>
                <a class="play-pause"></a>
                <ol class="indicator"></ol>
                <div class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" aria-hidden="true">&times;</button>
                                <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body next"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left prev">
                                    <i class="glyphicon glyphicon-chevron-left"></i>Previous
                                </button>
                                <button type="button" class="btn btn-primary next">
                                Next
                                    <i class="glyphicon glyphicon-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="links" style="display:none">
                <a href="img/tarang/img1-large.jpg" title="Tarang Photo" data-gallery>
                <img src="img/tarang/img1-large.jpg" alt="Tarang Photo">
                </a>
                <a href="img/tarang/img2-large.jpg" title="Tarang Photo" data-gallery>
                <img src="img/tarang/img2-large.jpg" alt="Tarang Photo">
                </a>
                <a href="img/tarang/img3-large.jpg" title="Tarang Photo" data-gallery>
                <img src="img/tarang/img3-large.jpg" alt="Tarang Photo">
                </a>
                <a href="img/tarang/img4-large.jpg" title="Tarang Photo" data-gallery>
                <img src="img/tarang/img4-large.jpg" alt="Tarang Photo">
                </a>
                <a href="img/tarang/img5-large.jpg" title="Tarang Photo" data-gallery>
                <img src="img/tarang/img5-large.jpg" alt="Tarang Photo">
                </a>
                <a href="img/tarang/img6-large.jpg" title="Tarang Photo" data-gallery>
                <img src="img/tarang/img6-large.jpg" alt="Tarang Photo">
                </a>
                <a href="img/tarang/img7-large.jpg" title="Tarang Photo" data-gallery>
                <img src="img/tarang/img7-large.jpg" alt="Tarang Photo">
                </a>
                <a href="img/tarang/img8-large.jpg" title="Tarang Photo" data-gallery>
                <img src="img/tarang/img8-large.jpg" alt="Tarang Photo">
                </a>
                <a href="img/tarang/img9-large.jpg" title="Tarang Photo" data-gallery>
                <img src="img/tarang/img9-large.jpg" alt="Tarang Photo">
                </a>
                <a href="img/tarang/img10-large.jpg" title="Tarang Photo" data-gallery>
                <img src="img/tarang/img10-large.jpg" alt="Tarang Photo">
                </a>
            </div>
        </div>

        </div>
    </div>


    <!-- Portfolio Modal 20 -->
    <div class="portfolio-modal modal fade" id="portfolioModal20" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <h2>Cricket Tournament</h2>
                <p>Last date of registration for cricket is 20th May 2008. Names will be registered only upon payment of the said amount. No names will be accepted after this date. To register please contact one of the following

                                Punit Nahar - 617-697-7612
                                Prasad Kamath – 857-205-0509
                                Nirav - 857-472-8125
                                Please Note: Cricket matches will begin from 1st June. A detailed schedule will be sent out once the registration process is completed. We understand that some students are back home in India or have other plans for summer. Taking this into consideration, we have decided that other events, except Cricket, would be scheduled around the month of August. Details of the same will be mailed in due course. Payments for these events can also be made later. However, this may not be applied for Cricket registration. Registration for Cricket closes on the 20th and no names will be taken after the said date.</p>
        </div>
    </div>
    </div>

    <!-- Portfolio Modal 21 -->
    <div class="portfolio-modal modal fade" id="portfolioModal21" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <h2>Cultural Diversity</h2>
                <p>Last date of registration for cricket is 20th May 2008. Names will be registered only upon payment of the said amount. No names will be accepted after this date. To register please contact one of the following

                                Punit Nahar - 617-697-7612
                                Prasad Kamath – 857-205-0509
                                Nirav - 857-472-8125
                                Please Note: Cricket matches will begin from 1st June. A detailed schedule will be sent out once the registration process is completed. We understand that some students are back home in India or have other plans for summer. Taking this into consideration, we have decided that other events, except Cricket, would be scheduled around the month of August. Details of the same will be mailed in due course. Payments for these events can also be made later. However, this may not be applied for Cricket registration. Registration for Cricket closes on the 20th and no names will be taken after the said date.</p>      
        </div>
    </div>
</div>
    <!-- Portfolio Modal 23 -->
    <div class="portfolio-modal modal fade" id="portfolioModal23" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                
                            <h3>Login</h3>
                            <div id="form_login" style="margin-left:350px">
                            <form name="login" action="index.php" id="loginForm"  method="post" >
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Your Username *" id="name" name="login_username" required data-validation-required-message="Please enter your name.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Your Password *" id="password" name="login_password" required data-validation-required-message="Please enter your email address.">
                                        <p class="help-block text-danger"></p>
                                      <div class="clearfix"></div> 
                                 <div class="col-lg-12 text-center"> 
                                    <br/>
                                   <input type="submit" name="login_submit" class="btn btn-xl" value="submit"/>                               
                                </div>
                            </div>
                    </form>
                                
                            <br/>
                            <br/>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                </div>
                        </div>
                    </div>
                </div>
            
        



    <script type="text/javascript">
        var body = document.getElementsByTagName("body")[0];
        var script = document.createElement('script');
        script.type = "text/javascript";
        script.src = "http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js";
        body.appendChild(script);

        var myCenter=new google.maps.LatLng(42.338372, -71.088729);

        function initialize()
        {
        var mapProp = {
          center: myCenter,
          zoom:5,
          mapTypeId: google.maps.MapTypeId.ROADMAP
          };

        var map = new google.maps.Map(document.getElementById("mapholder"),mapProp);

        var marker = new google.maps.Marker({
          position: myCenter,
          title:'Click to zoom'
          });

        marker.setMap(map);

        google.maps.event.addListener(marker,'click',function() {
          map.setZoom(9);
          map.setCenter(marker.getPosition());
          });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

    <script type="text/javascript">
        $('#image-gallery-button').on('click', function (event) {
            event.preventDefault()
            blueimp.Gallery($('#links a'), $('#blueimp-gallery').data())
          })

        $('#video-gallery-button').on('click', function (event) {
        event.preventDefault()
        blueimp.Gallery([
          {
            title: 'Journey of Tarang',
            href: 'img/Video/Journey.mp4',
            type: 'video/mp4',
            poster: 'img/tarang/journey.jpg'
          },
          {
            title: 'Fashion Show',
            href: 'img/Video/Fashion.mp4',
            type: 'video/mp4',
            poster: 'img/tarang/fashion.jpg'
          },
          {
            title: 'Garba  Dance',
            href: 'img/Video/Garba.mp4',
            type: 'video/mp4',
            poster: 'img/tarang/garba.jpg'
          }
        ], $('#blueimp-gallery').data())
      })
    </script>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/agency.js"></script>

</body>

</html>
