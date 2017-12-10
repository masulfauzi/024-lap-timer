<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>024 Lap Timer System</title>
    

    <!-- Bootstrap -->
    <link href="<?php echo $this->uri->baseUri; ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo $this->uri->baseUri; ?>assets/css/font-awesome.min.css" rel="stylesheet">    
    <!-- jQuery -->
    <script src="<?php echo $this->uri->baseUri; ?>assets/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo $this->uri->baseUri; ?>assets/js/bootstrap.min.js"></script>
    <!-- Bootbox -->
    <script src="<?php echo $this->uri->baseUri; ?>assets/js/bootbox.min.js"></script>
    <!-- Custom Theme Style -->
    <link href="<?php echo $this->uri->baseUri; ?>assets/css/custom.min.css" rel="stylesheet">
    
    
  </head>

  <body class="nav-md" onload="ajax();">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo $this->location('dashboard'); ?>" class="site_title"><i class="fa fa-flag-checkered"></i> <span>024 Timer</span></a>
            </div>

            <div class="clearfix"></div>

            

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
              <h3>Menu</h3>
              <ul class="nav side-menu">
	            <?php
		            $grup_menu = $this->home->generate_grup_menu();
			    
		        	foreach($grup_menu as $list_grup_menu)
		        	{
			    ?>
			    <li><a><i class="<?php echo $list_grup_menu->class ?>"></i> <?php echo $list_grup_menu->nama_grup_menu ?> <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
	                  
	              <?php
		              $menu = $this->home->generate_menu($list_grup_menu->id_grup_menu);
		              
		              foreach($menu as $list_menu)
		              {
			      ?>
			      		<li><a href="<?php echo $this->location($list_menu->controller) ?>"><span class="<?php echo $list_menu->class ?>"></span><?php echo $list_menu->nama_menu ?></a></li>
			      <?php
		              }
		          ?>
	                  
                    
                    
                  </ul>
                </li>
			    <?php
		        	}
		        ?>
                
                
                
                
                
              </ul>
            </div>
              

            </div>
            <!-- /sidebar menu -->

            
          </div>
        </div>

        <!-- top navigation -->
	      <div class="top_nav">
	
	        <div class="nav_menu">
	          <nav class="" role="navigation">
	            <div class="nav toggle">
	              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
	            </div>
	
	            <ul class="nav navbar-nav navbar-right">
	              <li class="">
	                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
	                  <img src="" alt="">User
	                  <span class=" fa fa-angle-down"></span>
	                </a>
	                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
	                  
	                  <li><a href="<?php echo $this->location('login/logout') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
	                  </li>
	                </ul>
	              </li>
	
	              
	
	            </ul>
	          </nav>
	        </div>
	
	      </div>
	      <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">