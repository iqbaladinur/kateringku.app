<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login::Administrator</title>
</head>
<body class="login-bg">
	<div class="container">
		<div id="login-admin" class="col-md-3">
			<h4 class="text-left text-uppercase">Login Admin</h4>
			<?php if(!empty($error)) echo $error;?>
		<form action="<?php echo base_url('login/auth');?>" method="post">
		  <div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
					<input type="text" name="id_user" class="form-control" placeholder="Username" autofocus required>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-eye-close"></span></span>
					<input type="password" name="password" class="form-control" placeholder="Password" required>
				</div>	
			</div>
			<button type="submit" name="submit" class="btn btn-default btn-block">Masuk</button>
		</form>
		</div>
	</div>
</body>
</html>