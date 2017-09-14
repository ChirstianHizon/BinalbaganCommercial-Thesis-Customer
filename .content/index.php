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
                <a class="navbar-brand" href="index.php">
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
                        <a href="index.php?mod=products">Products</a>
                    </li>
                    <li>
                        <a href="#" onclick="return openMyCart();"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</a>
                    </li>
                    <script>var page ="?mod=products"</script>
                    <?php
                    session_start();
                    $fname = (!empty($_SESSION['custfname'])) ? $_SESSION['custfname'] : "";
                    $lname = (!empty($_SESSION['custlname'])) ? $_SESSION['custlname'] : "";

                    $loginstat = (!empty($_SESSION['custlogin'])) ? $_SESSION['custlogin'] : false;
                    if(!$loginstat){
                      echo '<li>
                        <a href="#" onclick="return openLogin(page)">Login / Sign up</a>
                      </li>';

                    }else{
                      $lname = substr($lname,0,10);
                      $fname = substr($fname,0,10);
                      echo '<li class="dropdown">'.
                              '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$lname.", ".$fname.'<span class="caret"></span></a>'.
                              '<ul class="dropdown-menu" aria-labelledby="about-us">
                                <li><a href="index.php?mod=account">My Account</a></li>
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


    <?php
      $mod = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';
      switch ($mod) {
        case 'products':
          require_once 'product.php';
          break;
        case 'account':
          require_once 'account.php';
          break;
      }

     ?>
