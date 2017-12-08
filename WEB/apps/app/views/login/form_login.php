<html>
	<head>
		<title><?php echo $title; ?></title>
		<link href="<?php echo $this->uri->baseUri; ?>assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">	
	    <script src="<?php echo $this->uri->baseUri; ?>assets/js/jquery-1.10.2.min.js"></script>
	    <script src="<?php echo $this->uri->baseUri; ?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
	    
	</head>
	<body>
		<div class="container">
		    <div class="row">
		    	<div class="col-md-4 col-md-offset-4">	
			    	<?php
				    if($error)
				    {
					?>
					<div class="alert alert-danger alert-dismissable" style="margin-top: 50px;">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
		                <strong>Error!</strong> <?php echo $error; ?>
		            </div>
					<?php
				    }	
				    ?>
			    			    	
		    		<div class="panel panel-default" style="margin-top: 50px;">
					  	
					  	<div class="panel-heading">
					    	<h3 class="panel-title">Login</h3>
					 	</div>
					  	<div class="panel-body">
					    	<form accept-charset="UTF-8" role="form" method="post" action="">
						    	<input type="hidden" name="token" value="<?php echo $token; ?>" 
			                    <fieldset>
						    	  	<div class="form-group">
						    		    <input class="form-control" placeholder="Username Sikadu" name="username" type="text">
						    		</div>
						    		<div class="form-group">
						    			<input class="form-control" placeholder="Password" name="password" type="password" value="">
						    		</div>
						    		
						    		<input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
						    	</fieldset>
					      	</form>
					      	
					    </div>
					    
					</div>
				</div>
			</div>
		</div>
	</body>
</html>