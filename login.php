<?php include 'parts/header.php'; ?>

    <div class="container">
	    <div class="row">
		   	    </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
	            
                <div class="login-panel panel panel-default">
	                  <div style="padding: 15px 5px 5px 5px;"><p align="center"><img id="logo" width="90%" src="images/logo.png"></p></div>
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <fieldset>            
			                    <div class="form-group">
				                    <input class="form-control" placeholder="Username" type="text" name="username" value="<?php echo $submitted_username; ?>" /> 
			                    </div>
			                    <div class="form-group">
			                    	<input  class="form-control" placeholder="Password" type="password" name="password" value="" /> 
			                    </div>
			                    <input type="submit" class="btn btn-lg btn-primary btn-block" value="Login" /> 
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'parts/footer.php'; ?>    