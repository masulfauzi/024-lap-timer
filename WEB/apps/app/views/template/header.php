<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistem Informasi Aset</title>
    

    <!-- Bootstrap -->
    <link href="<?php echo $this->uri->baseUri; ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo $this->uri->baseUri; ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo $this->uri->baseUri; ?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo $this->uri->baseUri; ?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo $this->uri->baseUri; ?>vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo $this->uri->baseUri; ?>vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    
    <!-- jQuery -->
    <script src="<?php echo $this->uri->baseUri; ?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo $this->uri->baseUri; ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    
    <!-- highchart -->
	<script src="<?php echo $this->uri->baseUri; ?>vendors/highchart/highcharts.js"></script>
  	<script src="<?php echo $this->uri->baseUri; ?>vendors/highchart/exporting.js"></script>
  	
  	<!-- echart -->
  	<script src="<?php echo $this->uri->baseUri; ?>js/echart/echarts-all.js"></script>
  	<script src="<?php echo $this->uri->baseUri; ?>js/echart/green.js"></script>

    <!-- Custom Theme Style -->
    <link href="<?php echo $this->uri->baseUri; ?>build/css/custom.min.css" rel="stylesheet">
    
    <!-- Autocomplete -->
    <link href="<?php echo $this->uri->baseUri; ?>vendors/easyautocomplete/easy-autocomplete.min.css" rel="stylesheet">
    
    <!-- Select2 -->
    <link href="<?php echo $this->uri->baseUri; ?>vendors/select2/select2.min.css" rel="stylesheet">
    
    <!-- CKEDITOR -->
    <script src="<?php echo $this->uri->baseUri; ?>assets/plugin/ckeditor/ckeditor.js"></script>
  </head>

  <body class="nav-md" onload="ajax();">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo $this->location('dashboard'); ?>" class="site_title"><i class="fa fa-bar-chart"></i> <span>SIM Aset</span></a>
            </div>

            <div class="clearfix"></div>

            

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
              <h3>Menu</h3>
              <ul class="nav side-menu">
	            <?php
		            $grup_menu = $this->mhome->generate_grup_menu();
			    
		        	foreach($grup_menu as $list_grup_menu)
		        	{
			    ?>
			    <li><a><i class="fa fa-home"></i> <?php echo $list_grup_menu->nama_grup_menu ?> <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
	                  
	              <?php
		              $menu = $this->mhome->generate_menu($list_grup_menu->id_grup_menu);
		              
		              foreach($menu as $list_menu)
		              {
			      ?>
			      		<li><a href="<?php echo $this->location($list_menu->controller) ?>"><?php echo $list_menu->nama_menu ?></a></li>
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
	                  <img src="https://simpeg2.unnes.ac.id/simpeg_portofolio/load_photo/<?php echo $this->session->getValue('kode_identitas') ?>" alt=""><?php echo $this->mhome->get_nama() ?>
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