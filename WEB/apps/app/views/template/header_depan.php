<head>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44603825-1', 'ub.ac.id');
  ga('send', 'pageview');

</script>
	<link REL="SHORTCUT ICON" HREF="<?php echo $this->uri->baseUri; ?>favicon.ico">
    <meta charset="utf-8">
    <title>Beranda | Sistem Informasi Aspirasi Publik</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="<?php echo $this->uri->baseUri; ?>assets/css/ecomplaint-style.css" rel="stylesheet">
    
    <script src="<?php echo $this->uri->baseUri; ?>assets/plugin/ckeditor/ckeditor.js"></script>
    
	<!-- 
	<style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    -->
    <link href="<?php echo $this->uri->baseUri; ?>assets/css/bootstrap-responsive.css" rel="stylesheet">
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="<?php echo $this->uri->baseUri; ?>assets/js/jquery-1.6.2.min.js"></script>-->
    <script src="<?php echo $this->uri->baseUri; ?>assets/js/jquery.js"></script>
  </head> <body>
 	
    <div id="topnav" style="position: fixed;z-index: 2;top: 0;width: 100%;">
    	<div class="wrap">
        	<div class="dropdown">
        	<ul class="nav">
			<li><a href="<?php echo $this->uri->baseUri; ?>" class=""><span>SIAP</span></a></li>
							<li class="active"><a href="<?php echo $this->uri->baseUri; ?>">Beranda</a></li>
				<!--<li class="dropdown-toggle"><a href="<?php echo $this->uri->baseUri; ?>/borang">Borang Keluhan</a></li>-->
				<li class="dropdown">
	              <a data-toggle="dropdown" class="dropdown-toggle" href="#">Form Aspirasi <b class="caret"></b></a>
	              <ul class="">
	                <li><a href="<?php echo $this->location('form/warga_unnes'); ?>">Form Warga Unnes</a></li>
	                <li><a href="<?php echo $this->location('form/umum'); ?>">Form Umum</a></li>
	              </ul>
	            </li>
				<li><a href="<?php echo $this->uri->baseUri; ?>#">Statistik</a></li>
				<?php
				if(($this->session->getValue('logged_in')) && ($this->session->getValue('id_privileges') < 3))
				{	
				?>
				<li><a href="<?php echo $this->location('login'); ?>#">Halaman Administrasi</a></li>
				<?php
				}
				?>
				
				<?php if($this->session->getValue('logged_in')) { ?>
			    <li><a href="<?php echo $this->location('login/logout'); ?>">Logout</a></li> 
			    <?php }
				    else
				    {
				?>
				<li><a href="<?php echo $this->location('login'); ?>">Login</a></li> 
				<?php
					}
				?>         
              <div class="clear"></div>
            </ul>
            </div>
        </div>
    </div>
    <div class="sp-01"></div>