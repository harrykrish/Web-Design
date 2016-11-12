<?php
    $f=0;
    $da=0;
    $da1=0;
    if(isset($_POST['submit']))
       {
        $cxn=mysqli_connect("localhost","root","","sanskriti_db") or die("Cannot connect to database");

            //$cxn=mysqli_connect("localhost","root","root","alzheimer_solution") or die("Cannot connect to database");
            $qc="select * from users where mail='".$_POST['mail']."'";
            echo $qc;
            $res=mysqli_query($cxn,$qc);
            if(!$res)
            {
                die("Error");
                //echo "Error";
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
                    //$ph = "+".$_POST['code'].$_POST['ph1'].$_POST['ph2'].$_POST['ph3'];
                    //echo $ph;
                    
                    $qc="insert into users(user_name,mail,password,phone,name,inserted_by) values('".$_POST['username']."','".$_POST['mail']."','".$pass."','".$_POST['phone']."','".$_POST['name']."','".$_POST['name']."')";
                    /*$qc="insert into physician(physician_name,clinic_address,mail,phone,password)
                    values('".$_POST['username']."','".$_POST['add']."','".$_POST['mail']."',".$_POST['acc'].",
                    '"+".".$_POST['code']."."-(".".$_POST['ph1'].".")-".".$_POST['ph2']."."-".".$_POST['ph3']."',
                    '".$pass."')";*/
                    //echo $qc;
                    //echo password_hash('password',PASSWORD_DEFAULT);
                    $out=mysqli_query($cxn,$qc);
                   /* mail($mail, $_POST['username'].' has requested '.$_POST['name'].' access to GPACDW', 'Hi Farika,

New Request
NU-ID: '.$_POST['username']. ' 
Kindly visit Sanskriti to authorize user.

Thanks,
GPAC System

Note: Do not reply to this mail. If you are not the intended recipient, kindly delete this message.
'
                    );*/
                    if(!$out)
                    {
                           $da=2;
                    }
                    else
                    echo "In";
                   //header("Location:index.php");
                }
                else
                {
                    $da=1;
                }
                
            }
            
            //echo $qc;
            
        }
?>


    
    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading"><font color="black"> GET INVOLVED</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" id="contactForm" action="login.php" method="post" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name *" id="name" name="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Your Email *" id="mail" name="mail" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                    <?php
                        if($f>0)
                            echo "mail-id already exists";
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
                                    <input type="password" class="form-control" placeholder="Your Password *" id="Password" name="password" required data-validation-required-message="Please enter your password.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Confirm Password *" id="Password" required data-validation-required-message="Please confirm your password.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                             <div class="clearfix"></div> 
                             <div class="col-lg-12 text-center"> 
                                <!-- <div id="success"></div> -->
                                <input type="submit" name="submit" value="submit" class="btn btn-xl">
 
               <?php if($da==1) {echo "Some error";}?>



                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->


</body>

</html>
