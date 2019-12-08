<!-- //MY FILE -->
<?php
  session_start();

  //get user row from dependent username
  function getUserRow($d_username){
    $conn = new mysqli('localhost', 'root', '', 'registration_storage');
    $sql ="SELECT * FROM users WHERE username = '$d_username' ";

    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_array($result);
  }

  //get balance from dependent username
  function getBalance($d_username){
    $conn = new mysqli('localhost', 'root', '', 'registration_storage');
    $sql ="SELECT * FROM fund WHERE dependent_u_name = '$d_username' ";

    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    $balance = 0;

    for ($x = 0; $x < $numRows; $x++) {
        $row = mysqli_fetch_array($result);
        $balance += $row['amount'];
    }
    return $balance;

  }

  function getFundRows($d_username){
    $conn = new mysqli('localhost', 'root', '', 'registration_storage');
    $sql ="SELECT * FROM fund WHERE dependent_u_name = '$d_username' ";

    $result = mysqli_query($conn, $sql);
    return $result;
  }

?>

<!doctype html>
<html lang="en">

<head>

    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--====== Title ======-->
    <title><?php echo $_SESSION['first'];?> - Safe Wallet</title>

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!--====== Line Icons css ======-->
    <link rel="stylesheet" href="assets/css/LineIcons.css">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="assets/css/default.css">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <link rel="stylesheet" href="assets/css/modal.css"> -->

    <!-- <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css'> -->



    <!-- <link rel="stylesheet" href="add_funds/funds.css"> -->

</head>

<body>

    <!--====== HEADER PART START ======-->
 
    <header class="header-area">
        <div class="navgition navgition-transparent">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="#">
                                <img src="assets/images/logo.svg" alt="Logo">
                            </a>

                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarOne" aria-controls="navbarOne" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarOne">
                                <ul class="navbar-nav m-auto">
                                    <li class="nav-item active">
                                        <a class="page-scroll" href="#home">HOME</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#service">REQUESTS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#pricing">DEPENDENTS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="logout.php" style="color: red">LOGOUT</a>
                                    </li>
                                </ul>
                            </div>
                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- navgition -->

        <div id="home" class="header-hero bg_cover" style="background-image: url(assets/images/header-bg.jpg)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10">
                        <div class="header-content text-center">
                            <h3 class="header-title">Welcome <?php echo "{$_SESSION['first']}" ?></h3>
                            <p class="text">Here you can create your dependent's account, keep an eye on their spending, or add funds to you dependent's account</p>
                            <!-- Button trigger modal -->
</br>
                            <button type="button" id= "hellbtn" class="btn main-btn" data-toggle="modal" data-target="#exampleModalCenter" style="color:white; background:#0067f4;">
                                ADD DEPENDENT
                                </button>
                            <!-- <ul class="header-btn">
                                <li><a class="main-btn btn-one" rel="nofollow" href="add_dependent.html">ADD DEPENDENT</a></li>
                                    
                                   


                                
                            </ul> -->
                        </div> <!-- header content -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
            <div class="header-shape">
                <img src="assets/images/header-shape.svg" alt="shape">
            </div>
        </div> <!-- header content -->
    </header>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Add Dependent</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="form" >
      <div class="tab-content">
        <div id="signup">   
          <form action="insert_dependent.php" method="POST">
          <div class="top-row">
            <div class="field-wrap">
              <label>
                First<span class="req">*</span>
              </label>
              <input type="text" name="first" required autocomplete="off" />
            </div>
        
            <div class="field-wrap">
              <label>
                Last<span class="req">*</span>
              </label>
              <input type="text" name="last" required autocomplete="off"/>
            </div>
          </div>

          <div class="field-wrap">
              <label>
                Phone Number<span class="req">*</span>
              </label>
              <input type="phone" name="phone" required autocomplete="off"/>
            </div>

          <div class="field-wrap">
            <label>
              Username<span class="req">*</span>
            </label>
            <input type="username" name="username" required autocomplete="off"/>
          </div>

          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input type="password" name="password" required autocomplete="off"/>
          </div>

          <div class="field-wrap">
            <label>
              Re-type Password<span class="req">*</span>
            </label>
            <input type="password" name="re_password" required autocomplete="off"/>
          </div>
          <button type="submit" class="btn btn-primary"/>Get Started</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </form>
        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
<!-- partial -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="../script.js"></script>

                                    </div>
                                    </div>
                                </div>
                                </div>
                                <!-- ModalEND -->

    <!--====== HEADER PART ENDS ======-->

    <!--====== SERVICES PART START ======-->

    <section id="service" class="services-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6" align="center">
                    <div class="section-title" style="align-content:center">
                        <h4 class="title" style="text-align: center">Requests</h4>
                        <p class="text" style="text-align: center">Below are all your requests for funds.</p>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->



            

            <?php 

                //loop through all dependents
                $conn = new mysqli('localhost', 'root', '', 'registration_storage');
                $sql ="SELECT * FROM request WHERE parent_u_name = '$_SESSION[username]' ";

                $result = mysqli_query($conn, $sql);
                $numRows = mysqli_num_rows($result);
                

                for ($x = 0; $x < $numRows; $x++) {

                    $row = mysqli_fetch_array($result);
                    $user_row = getUserRow($row['dependent_u_name']);
                    

            ?>

            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="single-pricing mt-40">
                        <div class="pricing text-center" style="z-index: 99;">
                            <h5 class="sub-title" style="z-index: 99;"><?php echo $user_row['first']. " ". $user_row['last'];?></h5>
                        </br>
                            <h5 class="sub-title" style="z-index: 99;"> $<?php echo $row['amount'];?></h5>
                        </br>
                            <h5 class="sub-title" style="z-index: 99;">Allowed Stores: <?php echo $row['stores'];?></h5>
                        </div>
                        <div class="pricing-list">
                            
                        </div>
                        <div class="pricing-btn text-center">
                            <a class="main-btn" href="add_funds.php?request_id=<?php echo $row['id'];?>">APPROVE</a>
                        </div>

                        <div align="center">
                            <a class="main-btn" href="decline_add_funds.php?request_id=<?php echo $row['id'];?>">DECLINE</a>
                        </div>

                    </div> <!-- single pricing -->
                </div>
            </div> <!-- row -->

            <?php
                }
            ?>

        </div>
    </section>
    <!--====== SERVICES PART ENDS ======-->

    <!--====== PRICING PART START ======-->

    <section id="pricing" class="pricing-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-10">
                        <h4 class="title">My Dependents</h4>
                        </br>
                        <!-- <p class="text">Helping you teach your children financial literacy by setting budgets for them</p> -->
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->

            <?php 

                //loop through all dependents
                $conn = new mysqli('localhost', 'root', '', 'registration_storage');
                $sql ="SELECT * FROM dependents WHERE parent_u_name = '$_SESSION[username]' ";

                $result = mysqli_query($conn, $sql);
                $numRows = mysqli_num_rows($result);
                //see if there are any contests under this user
                if($numRows > 0){
                    echo "<p class=\"text\" align=\"center\">You have <b>". $numRows. "</b> dependent(s). To add a new dependent, click the button above! </br></a>.</p>";
                }
                else{
                    echo "<p class=\"text\" align=\"center\">You have no dependents registered.</br></a>.</p>";
                }

                for ($x = 0; $x < $numRows; $x++) {

                    $row = mysqli_fetch_array($result);
                    $user_row = getUserRow($row['username']);
                    

            ?>


            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="single-pricing mt-40">
                        <div class="pricing-header text-center">
                            <h5 class="sub-title"><?php echo $user_row['first']. " ". $user_row['last']; ?></h5>
                            <span class="price"> <?php echo "$".getBalance($row['username']); ?></span>
                        </div>
                        <div class="pricing-list">
                            <ul>
                                <?php
                                    $fund_rows = getFundRows($row['username']);
                                    $num_fund_rows = mysqli_num_rows($fund_rows);

                                    for($i = 0; $i < $num_fund_rows; $i++){
                                        $cur_fund = mysqli_fetch_array($fund_rows);
                                        echo '<li><i class="lni-check-mark-circle" style="z-index: 99;"></i>'. $cur_fund['fund_name'] .': $'. $cur_fund['amount'] .'</li>';
                                    }
                                ?>
                                <!-- <li><i class="lni-check-mark-circle" style="z-index: 99;"></i> Carefully crafted components</li>
                                <li><i class="lni-check-mark-circle" style="z-index: 99;"></i> Amazing page examples</li>
                                <li><i class="lni-check-mark-circle" style="z-index: 99;"></i> Super friendly support team</li>
                                <li><i class="lni-check-mark-circle" style="z-index: 999;"></i> Awesome Support</li> -->
                            </ul>
                        </div>
                        <div class="pricing-btn text-center">
                            <a class="main-btn" href="parent_dependent.php?dependent_u_name=<?php echo $user_row['username'];?>">MANAGE</a>
                        </div>
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>
                        </br>

                        <div class="buttom-shape">
                            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 350 112.35"><defs><style>.color-1{fill:#2bdbdc;isolation:isolate;}.cls-1{opacity:0.1;}.cls-2{opacity:0.2;}.cls-3{opacity:0.4;}.cls-4{opacity:0.6;}</style></defs><title>bottom-part1</title><g id="bottom-part"><g id="Group_747" data-name="Group 747"><path id="Path_294" data-name="Path 294" class="cls-1 color-1" d="M0,24.21c120-55.74,214.32,2.57,267,0S349.18,7.4,349.18,7.4V82.35H0Z" transform="translate(0 0)"/><path id="Path_297" data-name="Path 297" class="cls-2 color-1" d="M350,34.21c-120-55.74-214.32,2.57-267,0S.82,17.4.82,17.4V92.35H350Z" transform="translate(0 0)"/><path id="Path_296" data-name="Path 296" class="cls-3 color-1" d="M0,44.21c120-55.74,214.32,2.57,267,0S349.18,27.4,349.18,27.4v74.95H0Z" transform="translate(0 0)"/><path id="Path_295" data-name="Path 295" class="cls-4 color-1" d="M349.17,54.21c-120-55.74-214.32,2.57-267,0S0,37.4,0,37.4v74.95H349.17Z" transform="translate(0 0)"/></g></g></svg>
                        </div>
                    </div> <!-- single pricing -->
                </div>

                
                
                
            </div> <!-- row -->

            <?php


                }
            ?>
        </div> <!-- conteiner -->
    </section>

    <!--====== PRICING PART ENDS ======-->
    


    <a class="back-to-top" href="#"><i class="lni-chevron-up" style="padding-top: 10px"></i></a>

    <!--====== FOOTER PART START ======-->

    <footer id="footer" class="footer-area">
        <div class="footer-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-logo-support d-md-flex align-items-end justify-content-between">
                            <div class="footer-logo d-flex align-items-end">
                                <a class="mt-30" href="index.html"><img src="assets/images/logo.svg" alt="Logo"></a>

                                <ul class="social mt-30 text">
                                    <li><a href="#"><i class="lni-facebook-filled"></i></a></li>
                                    <li><a href="#"><i class="lni-twitter-original"></i></a></li>
                                    <li><a href="#"><i class="lni-instagram-original"></i></a></li>
                                    <li><a href="#"><i class="lni-linkedin-original"></i></a></li>
                                </ul>
                            </div> <!-- footer logo -->
                            
                        </div> <!-- footer logo support -->
                    </div>
                </div> <!-- row -->
                <div class="row">
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="footer-link text">
                            <h3 class="footer-title title">Company</h6>
                            <ul class= "copyright">
                                <li class="text">About</li>
                                <li class="text">Contact</li>

                            </ul>
                        </div> <!-- footer link -->
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-5">
                        <div class="footer-link text">
                            <h3 class="footer-title text">Contact Us</h6>
                            <ul class="copyright">
                                <li class="text">(123) 456-7890</li>
                                <li class="text">100 Stadium Dr.</li>
                                <li class="text">Chapel Hill, NC 27514</li>
                            </ul>
                        </div> <!-- footer link -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- footer widget -->
        
        <div class="footer-copyright">
            
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright text-center">
                            <p class="text">Template Crafted by Big Baller Analytics</p>
                        </div>
                    </div>
                </div> <!-- row -->
             <!-- container -->
        </div> <!-- footer copyright -->
    </footer>

    <!--====== FOOTER PART ENDS ======-->

    <!--====== BACK TO TOP PART START ======-->

    <a class="back-to-top" href="#"><i class="lni-chevron-up"></i></a>

    <!--====== BACK TO TOP PART ENDS ======-->









    <!--====== jquery js ======-->
    <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>

    <!--====== Bootstrap js ======-->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/popper.min.js"></script>

    <!--====== Ajax Contact js ======-->
    <script src="assets/js/ajax-contact.js"></script>

    <!--====== Scrolling Nav js ======-->
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/scrolling-nav.js"></script>

    <!--====== Validator js ======-->
    <script src="assets/js/validator.min.js"></script>

    <!--====== Magnific Popup js ======-->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>

    <!--====== Main js ======-->
    <script src="assets/js/main.js"></script>

</body>

</html>
