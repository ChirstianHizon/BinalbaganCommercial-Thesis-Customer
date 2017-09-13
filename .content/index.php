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
                    $fname = (!empty($_SESSION['userfname'])) ? $_SESSION['userfname'] : "";
                    $lname = (!empty($_SESSION['userlname'])) ? $_SESSION['userlname'] : "";
                    if(empty($_SESSION['userfname']) ||  empty($_SESSION['userlname'])){
                      echo '<li>
                        <a href="#" onclick="return openLogin(page)">Login / Sign up</a>
                      </li>';

                    }else{
                      $lname = substr($lname,0,10);
                      $fname = substr($fname,0,10);
                      echo '<li class="dropdown">'.
                              '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$_SESSION['userfname'].", ".$fname.'<span class="caret"></span></a>'.
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
  		<div class="row">

  			<!-- Product 1 -->
  			<div class="col-sm-6 col-md-3">
  				<div class="thumbnail featured-product">
  					<a href="#">
  						<img src="images/pepper.jpg" alt="">
  					</a>
  					<div class="caption">
  						<h3>Premium Niche</h3>
  						<p>This is a very Short Description</p>
  						<p class="price">$10.45</p>

  						<!-- Input Group -->
  						<div class="input-group">
  							<input type="number" class="form-control" value="1">
  							<span class="input-group-btn">
  								<button class="btn btn-primary" type="button">
  									<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
  									Add to Cart
  								</button>
  							</span>
  						</div>
  					</div>
  				</div>
  			</div>

  			<!-- Product 2 -->
  			<div class="col-sm-6 col-md-3">
  				<div class="thumbnail featured-product">
  					<a href="#">
  						<img src="images/jars.jpg" alt="">
  					</a>
  					<div class="caption">
  						<h3>Handy Holistic</h3>
  						<p>Nori grape silver beet broccoli kombu beet greens fava bean potato quandong celery. Bunya nuts black-eyed pea prairie turnip leek lentil turnip greens parsnip.</p>
  						<!-- <p class="price"><s>$24.99</s> $18.99</p> -->

  						<!-- Input Group -->
  						<div class="input-group">
  							<input type="number" class="form-control" value="1">
  							<span class="input-group-btn">
  								<button class="btn btn-primary" type="button">
  									<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
  									Add to Cart
  								</button>
  							</span>
  						</div>
  					</div>
  				</div>
  			</div>

  			<!-- Product 3 -->
  			<div class="col-sm-6 col-md-3">
  				<div class="thumbnail featured-product">
  					<a href="#">
  						<img src="images/pot.jpg" alt="">
  					</a>
  					<div class="caption">
  						<h3>Seamless Strategic</h3>
  						<p>Nori grape silver beet broccoli kombu beet greens fava bean potato quandong celery. Bunya nuts black-eyed pea prairie turnip leek lentil turnip greens parsnip.</p>
  						<p class="price">$11.50</p>

  						<!-- Input Group -->
  						<div class="input-group">
  							<input type="number" class="form-control" value="1">
  							<span class="input-group-btn">
  								<button class="btn btn-primary" type="button">
  									<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
  									Add to Cart
  								</button>
  							</span>
  						</div>
  					</div>
  				</div>
  			</div>

  			<!-- Product 4 -->
  			<div class="col-sm-6 col-md-3">
  				<div class="thumbnail featured-product">
  					<a href="#">
  						<img src="images/teapot.jpg" alt="">
  					</a>
  					<div class="caption">
  						<h3>Maintained Strip</h3>
  						<p>Nori grape silver beet broccoli kombu beet greens fava bean potato quandong celery. Bunya nuts black-eyed pea prairie turnip leek lentil turnip greens parsnip.</p>
  						<p class="price">$45.50</p>

  						<!-- Input Group -->
  						<div class="input-group">
  							<input type="number" class="form-control" value="1">
  							<span class="input-group-btn">
  								<button class="btn btn-primary" type="button">
  									<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
  									Add to Cart
  								</button>
  							</span>
  						</div>
  					</div>
  				</div>
  			</div>

        <!-- Product 4 -->
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail featured-product">
            <a href="#">
              <img src="images/teapot.jpg" alt="">
            </a>
            <div class="caption">
              <h3>Maintained Strip</h3>
              <p>Nori grape silver beet broccoli kombu beet greens fava bean potato quandong celery. Bunya nuts black-eyed pea prairie turnip leek lentil turnip greens parsnip.</p>
              <p class="price">$45.50</p>

              <!-- Input Group -->
              <div class="input-group">
                <input type="number" class="form-control" value="1">
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="button">
                    <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                    Add to Cart
                  </button>
                </span>
              </div>
            </div>
          </div>
        </div>


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
