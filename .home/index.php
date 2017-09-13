<!-- Navigation -->
<nav id="siteNav" class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <!-- Logo and responsive toggle -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">
        <!-- <span class="glyphicon glyphicon-fire"></span> -->
        Binalbagan Commercial
      </a>
    </div>
    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="navbar">
      <ul class="nav navbar-nav navbar-right">
        <li class="active">
          <a href="">Home</a>
        </li>
        <li>
          <a href="index.php?mod=products">Products</a>
        </li>
        <!-- CART USE MODAL TO SHOW PRODUCTS -->
        <li>
          <a href="#" >My Cart</a>
        </li>
        <script>var page =""</script>
        <?php
        session_start();
        $fname = (!empty($_SESSION['custfname'])) ? $_SESSION['custfname'] : "";
        $lname = (!empty($_SESSION['custlname'])) ? $_SESSION['custlname'] : "";
        if(empty($_SESSION['userfname']) ||  empty($_SESSION['userlname'])){

          echo '<li>
            <a href="#" onclick="return openLogin(page)">Login / Sign up</a>
          </li>';

        }else{
          $lname = substr($lname,0,10);
          $fname = substr($fname,0,10);
          echo '<li class="dropdown">'.
                  '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$lname.", ".$fname.'<span class="caret"></span></a>'.
                  '<ul class="dropdown-menu" aria-labelledby="about-us">
                    <li><a href="#">My Account</a></li>
                    <!-- SIGN OUT  -->
                    <li><a href="index.php?mod=logout">Sign Out</a></li>
                  </ul>
                </li>';
        }
         ?>
      </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
</nav>

<!-- Header -->
<header>
  <div class="header-content">
    <div class="header-content-inner">
      <h1>BINALBAGAN COMMERCIAL</h1>
      <p>Cheap, Affordable and High Quality Products available for our Valued Customers</p>
      <a href="#" onclick="return openRegister();" class="btn btn-primary btn-lg">Register Now</a>
    </div>
  </div>
</header>

<!-- Intro Section -->
<section class="intro">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-lg-offset-2">
        <span class="glyphicon glyphicon-apple" style="font-size: 60px"></span>
        <h2 class="section-heading">Completely synergize resource taxing relationships</h2>
        <p class="text-light">Professionally cultivate one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service for state of the art customer service.</p>
      </div>
    </div>
  </div>
</section>

<!-- Content 1 -->
<section class="content">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <img class="img-responsive img-circle center-block" src="images/microphone.jpg" alt="">
      </div>
      <div class="col-sm-6">
        <h2 class="section-header">Best in Class</h2>
        <p class="lead text-muted">Holisticly predominate extensible testing procedures for reliable supply chains. Dynamically innovate resource-leveling customer service for state of the art customer service.</p>
        <a href="#" class="btn btn-primary btn-lg">Shop Now</a>
      </div>

    </div>
  </div>
</section>

<!-- Content 2 -->
<section class="content content-2">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <h2 class="section-header">Superior Quality</h2>
        <p class="lead text-light">Holisticly predominate extensible testing procedures for reliable supply chains. Dynamically innovate resource-leveling customer service for state of the art customer service.</p>
        <!-- <a href="#" class="btn btn-default btn-lg">Test It</a> -->
      </div>
      <div class="col-sm-6">
        <img class="img-responsive img-circle center-block" src="images/iphone.jpg" alt="">
      </div>

    </div>
  </div>
</section>

<!-- Content 3 -->
<section class="content content-3">
  <div class="container">
    <h2 class="section-header"><span class="glyphicon glyphicon-pushpin text-primary"></span><br> Sanity Check</h2>
    <p class="lead text-muted">Holisticly predominate extensible testing procedures for reliable supply chains. Dynamically innovate resource-leveling customer service for state of the art customer service.</p>
    <a href="#" class="btn btn-primary btn-lg">Check Now</a>
  </div>
</div>
</section>

<!-- Footer -->
<footer class="page-footer">

<!-- Contact Us -->
<div class="contact">
  <div class="container">
    <h2 class="section-heading">Contact Us</h2>
    <p><span class="glyphicon glyphicon-earphone"></span><br> +1(23) 456 7890</p>
    <p><span class="glyphicon glyphicon-envelope"></span><br> info@example.com</p>
  </div>
</div>

<!-- Copyright etc -->
<div class="small-print">
  <div class="container">
    <p>Copyright &copy; Example.com 2015</p>
  </div>
</div>

</footer>
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.min.js"></script>

<!-- Custom Javascript -->
<script src="js/custom-home.js"></script>
<script src="js/home-index.js"></script>
