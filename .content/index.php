<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Logo and responsive toggle -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                	<!-- <span class="glyphicon glyphicon-fire"></span> -->
                	Binalbagan Commercial
                </a>
            </div>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li >
                        <a href="index.php">Home</a>
                    </li>
                    <li class="active">
                        <a href="">Products</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</a>
                    </li>
                    <script>var page ="?mod=products"</script>
                    <?php
                    session_start();
                    $fname = (!empty($_SESSION['custfname'])) ? $_SESSION['custfname'] : "";
                    $lname = (!empty($_SESSION['custlname'])) ? $_SESSION['custlname'] : "";
                    if(empty($_SESSION['custfname']) ||  empty($_SESSION['custlname'])){
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
                                <li><a href="index.php?mod=logout&stat=?mod=products">Sign Out</a></li>
                              </ul>
                            </li>';
                    }
                     ?>

                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>





	<!-- Feature -->
	<div class="jumbotron feature">
		<div class="container">
			<h1><span class="glyphicon glyphicon-equalizer"></span> Best Products in Town</h1>
			<p>Cheap, Affordable and High Quality Products available to our Valued Customers</p>
			<!-- <p><a class="btn btn-primary" href="#">Engage Now</a></p> -->
		</div>
	</div>


    <!-- Heading -->
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="text-center">Best Selling Products</h1>
                <p class="lead text-center">Proactively envisioned multimedia based expertise and cross-media growth strategies. Seamlessly visualize quality intellectual capital without superior collaboration and idea-sharing. Holistically pontificate installed base portals after maintainable products without collateral.</p>
            </div>
        </div>
    </div>

    <!-- Featured Products -->
  	<div class="container">
  		<h1 class="text-center">World Class Products</h1>
  		<div id="prodview" class="row">




  		</div>
      </div>
    <!-- /.container -->




	<!-- Footer -->
	<footer>
        <!-- Copyright etc -->
        <div class="small-print">
        	<div class="container">
        		<p><a href="#">Terms &amp; Conditions</a> | <a href="#">Privacy Policy</a> | <a href="#">Contact</a></p>
        		<p>Copyright &copy; BinalbaganCommercial.com 2017 </p>
        	</div>
        </div>

	</footer>


    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	  <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/content-index.js"></script>
