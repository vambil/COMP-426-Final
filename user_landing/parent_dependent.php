<?php
    session_start();
    
    // echo $dependent_username;
    function getUserRow($d_username){
        $conn = new mysqli('localhost', 'root', '', 'registration_storage');
        $sql ="SELECT * FROM users WHERE username = '$d_username' ";
    
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_array($result);
    }

      function getDependentRow($d_username){
        $conn = new mysqli('localhost', 'root', '', 'registration_storage');
        $sql ="SELECT * FROM dependents WHERE username = '$d_username' ";
    
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

      function storesStringToDisplay($stores){
        $stores = substr($stores, 1, strlen($stores)-2);
        $keywords = preg_split("/[)][,][(]/", $stores);
        $out = '';
        
        for ($e = 0; $e < count($keywords); $e += 1) {
            $out .= $keywords[$e];
            if ($e < count($keywords) - 1) {
                $out .= ", ";
            }
        }
        
        if ($out == '') {
            $out = 'Any store';
        }
        
        return $out;
    }
    function inputToStoresString($stores){
        $stores = '(' . $stores . ')';
        $keywords = preg_split("/[;]+[\s]*/", $stores);
        $out = '';
    
        for ($e = 0; $e < count($keywords); $e += 1) {
            $out .= $keywords[$e];
            if ($e < count($keywords) - 1) {
                $out .= "),(";
            }
        }
        
        return $out;
    }
    function expensesStringToDisplay($expenses){
        $expenses = substr($expenses, 1, strlen($expenses)-2);
        
        $keywords = preg_split("/[,]/", $expenses);
        $out = '';
        
        for ($e = 0; $e < count($keywords); $e += 1) {
            $out .= $keywords[$e];
            if ($e < count($keywords) - 1) {
                $out .= ": $";
            }
        }
        
        $keywords = preg_split("/[)][(]/", $out);
        $out = '';
        
        for ($e = 0; $e < count($keywords); $e += 1) {
            $out .= $keywords[$e];
            if ($e < count($keywords) - 1) {
                $out .= ", ";
            }
        }
        
        return $out;
    }

      $dependent_username = $_GET['dependent_u_name'];

      $dependent_row = getDependentRow($dependent_username);
      $user_row = getUserRow($dependent_username);
      
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
    <title><?php echo $user_row['first']; ?> - Safe Wallet</title>

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="assets/css/default.css">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!--====== HEADER PART START ======-->
    

    <header class="header-area">
        <div class="navgition navgition-transparent">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="parent.php">
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
                                        <a class="page-scroll" href="#service">OVERVIEW</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#pricing">FUNDS</a>
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
                            <h3 class="header-title"><?php echo $user_row['first']; ?>'s Profile</h3>
                            <p class="text">A detailed view of the budget</p>
                            </br>
                            <ul class="header-btn">
                                <li><a class="main-btn btn-one" rel="nofollow" href="add_to_dependent.php?dependent_u_name=<?php echo $dependent_row['username']; ?>">ADD FUNDS</a></li> 
                                <li><a class="main-btn btn-one" rel="nofollow" href="store_restrictions.php?dependent_u_name=<?php echo $dependent_row['username']; ?>">EDIT STORE RESTRICTIONS</a></li>

                            </ul>
                            </br>
                            
                            
                        </div>
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
            <div class="header-shape">
                <img src="assets/images/header-shape.svg" alt="shape">
            </div>
        </div> <!-- header content -->

    </header>

    <!--====== HEADER PART ENDS ======-->

    <!--====== SERVICES PART START ======-->

    <section id="service" class="services-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title pb-10">
                        <h4 class="title" style="text-align: center">$<?php echo getBalance($user_row['username']); ?></h4>
                        <p class="sub-title" style="text-align: center">Total Balance</p>
                    </div> <!-- section title -->
                </div>
            </div>
            </br>
            </br>
            <div class="row">
                <div class="col-lg-6" align="center">
                    <label><b>Banned Stores</b></label>
                    <p><?php echo storesStringToDisplay($dependent_row['banned_stores']);?></p>
                </div>
                </br>
                </br>
                <div class="col-lg-6" align="center">
                    <label><b>Allowed Stores</b></label>
                    <p><?php echo storesStringToDisplay($dependent_row['approved_stores']);?></p>
                </div>
            </div>  
            </br>
            <div class="row">
                <h5 class="title"> Expense History<h5>
            </div>
            </br>
            

            <?php
                $conn = new mysqli('localhost', 'root', '', 'registration_storage');
                $sql ="SELECT * FROM fund WHERE dependent_u_name = '$dependent_row[username]' ";

                $result = mysqli_query($conn, $sql);
                $numRows = mysqli_num_rows($result);
                

                for ($x = 0; $x < $numRows; $x++) {

                    $fund_row = mysqli_fetch_array($result);
                    // $user_row = getDependentRow($row['dependent_u_name']);
                    
            ?>

            <div class="col-lg-6">
                <p class="text"> <?php echo "<b>". $fund_row['fund_name']. "</b>: ". expensesStringToDisplay($fund_row['expenses']); ?> </p>
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
                        <h4 class="title">My Funds</h4>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->

            <?php 

                //loop through all dependents
                $conn = new mysqli('localhost', 'root', '', 'registration_storage');
                $sql ="SELECT * FROM fund WHERE dependent_u_name = '$user_row[username]' ";

                $result = mysqli_query($conn, $sql);
                $numRows = mysqli_num_rows($result);
                

                for ($x = 0; $x < $numRows; $x++) {

                    $row = mysqli_fetch_array($result);
                    // $user_row = getDependentRow($row['dependent_u_name']);
                    

            ?>

            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="single-pricing mt-40">
                        <div class="pricing-header text-center">
                            <h5 class="sub-title"><?php echo $row['fund_name'];?></h5>
                            <span class="price" style="z-index: 999"> $<?php echo $row['amount'];?></span>
                        </div>
                        </br>
                        <div align="center" style="z-index: 990;">
                            <div>
                                <h5 class="sub-title"> Allowed Stores<h5>
                                <p class="text"> <?php echo storesStringToDisplay($row['stores']);?> </p>
                            </div>
                            
                        </br>
                        </br>
                            </br>
                            </br>
                            </br>
                            </br>
                            
                        </div>
                        <!-- <div class="pricing-btn text-center">
                            <a class="main-btn" href="#">ADD FUNDS</a>
                        </div> -->
                        
                        <div class="buttom-shape" style="z-index: 98">
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

    <a class="back-to-top" href="#"><i class="lni-chevron-up" style="padding-top: 10px"></i></a>

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
