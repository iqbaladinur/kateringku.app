<?php
	defined('BASEPATH') or exit('No direct script allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
</head>
<body>
	<div class="well well-sm">
		<h3>Login</h3>	
	</div>
	<div class="container-fluid">
		<div class="col-sm-6">
			<h1 class="text-center">eat quote of the day</h1><br>
			<blockquote class="text-center">
				<p>
					You are what what you eat eats.
				</p>
				<footer>
					Michael Pollan, In Defense of Food: An Eater's Manifesto
				</footer>
				
			</blockquote>
		</div>
		<div class="col-sm-6">
			<?php echo $error;?>
			<form class="form-horizontal" action="login.html" method="post">
			  <div class="form-group">
			    <label style="text-align:left" class="control-label col-sm-3" for="email">Email</label>
			    <div class="col-sm-8">
			      <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
			    </div>
			  </div>
			  <div class="form-group">
			    <label style="text-align:left" class="control-label col-sm-3" for="pwd">Password</label>
			    <div class="col-sm-8">
			      <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter password">
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-3 col-sm-8">
			      <div class="checkbox">
			        <label><input type="checkbox" checked> Ingat saya selalu</label>
			      </div>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-3 col-sm-8">
			      <button type="submit" class="btn btn-default">Masuk Sekarang</button>
			    </div>
			  </div>
		</form>
		</div>
	</div>
</body>
</html>