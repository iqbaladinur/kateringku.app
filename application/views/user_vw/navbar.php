<!-- navbar -->
	<nav id="toppage" class="navbar nav navbar-fixed-top theme-color">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle btn-sm menu-toggle" data-toggle="collapse" data-target="#myNavbar">
	       	<span class="glyphicon glyphicon-menu-hamburger"></span>
	      </button>
	      <a class="navbar-brand" href="<?php echo base_url('/home.html') ?>">
	      	 <img width="100" alt="Brand" src="<?php echo base_url('/asset/img/logo.svg')?>">
	      </a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav navbar-right">
	      	<li class="active"><a id="nav-menu" href="<?php echo base_url('/lihat-menu.html')?>">Menu Katering</a></li>
	      	<?php if ($this->session->userdata('login')==true) { ?>
	        <li><a id="nav-menu" href="<?php echo base_url('/lihat-pesanan')?>">Lihat Pesanan</a></li> 
	        <li><a id="nav-menu" href="<?php echo base_url('/upload-bukti-pembayaran.html')?>">Upload Pembayaran</a></li>
	        <?php } ?> 
	        <li><a id="nav-menu" href="<?php echo base_url('/panduan.html')?>">Panduan</a></li>
	        <li>
        		<a id="nav-menu" href="<?php echo base_url('/lihat-keranjang.html')?>"> 
        			<span class="glyphicon glyphicon-shopping-cart"></span> <span class="badge"><?php echo $itemcart;?></span>
        		</a>
	        </li>
	        <?php
	        	if ($this->session->userdata('login')==true) { ?>
	        		 <li>
			        	<div style="padding-left:10px;padding-right:10px" class="navbar-btn">
			      			<a href="<?php echo base_url('/edit_profile.html')?>">
			      				<img style="border:1px solid #D3D3D3;width:32px;height:32px" class="img-circle" src="<?php echo $this->session->userdata('profile');?>">
			      			</a>
			        	</div>
			        </li>
	        		<li>
			        	<div style="padding-left:10px;padding-right:10px" class="navbar-btn">
			        		<a style="border-radius:20px;padding-left:20px;padding-right:20px;"  class="btn btn-default btn-md" style="color:gray;" href="<?php echo base_url('/logout.html')?>"> Logout </a>
			        	</div>
			        </li>
	        	<?php }else{ ?>
	        <li>
	        	<div style="padding-left:10px;padding-right:10px" class="navbar-btn">
	        		<a style="border-radius:20px;padding-left:20px;padding-right:20px;"  class="btn btn-default btn-md" style="color:gray;" href="<?php echo base_url('/daftar.html')?>"> Daftar </a>
	        	</div>
	        </li>
	        <li>
		        <div style="padding-left:10px;padding-right:10px" class="navbar-btn">
		      		<a style="border-radius:20px;padding-left:20px;padding-right:20px;" class="btn btn-default btn-md" style="color:gray;" href="#" data-toggle="modal" data-target="#login"> Login&nbsp </a>
		      	</div>
	      	</li>
	      	<?php }?>
	      </ul>
	    </div>
	  </div>
	</nav>
  <div class="modal fade" id="login" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Login</h3>
        </div>
        <div class="modal-body">
         <form action="login.html" method="post">
		  <div class="form-group">
		    <label for="email">Alamat Email:</label>
		    <input type="email" class="form-control" id="email" name="email">
		  </div>
		  <div class="form-group">
		    <label for="pwd">Password:</label>
		    <input type="password" class="form-control" id="pwd" name="pwd">
		  </div>
		  <div class="checkbox">
		    <label><input type="checkbox"> Ingat Saya Selalu!</label>
		  </div>
		  <button type="submit" class="btn btn-default">Masuk Sekarang</button>
		</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
        </div>
      </div>
      
    </div>
  </div>
  
  