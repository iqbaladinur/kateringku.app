<?php
	defined('BASEPATH') or exit('No direct script allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Menu Katering</title>
</head>
<body style="padding-top:70px">
	<div class="container">
		<div class="pull-left">
			<h3>Menu Katering <?php echo $jenis;?></h3>
			<p>Tersedia berbagai macam pilihan nikmat yang menanti anda!</p>	
		</div>
	</div>
	<div class="container">
		<div id="menulist" class="row">
		  	<?php foreach ($menu as $menu): ?>
				  <div class="menu col-xs-6 col-sm-3">
				    <div class="thumbnail">
				      <img class="img-responsive" src="<?php echo $menu->pic;?>" alt="test">
				      <div class="caption">
				        <h4 style="height:30px"><?php echo $menu->nama;?></h4>
				        <p class="ket" style="height:100px"><?php echo $menu->keterangan;?></p>
				        <h5>Rp. <?php echo number_format($menu->harga, 0, '','.').',-';?></h5>
				        <p class="text-center">
				        	<a href="<?php echo 'tambah-cart?id='.$menu->kd_menu.'&nm='.$menu->nama.'&hrg='.$menu->harga;?>" class="btn btn-warning btn-sm btn-style">
				        		<span class="glyphicon glyphicon-shopping-cart"></span> Pesan Sekarang
				        	</a>
				        </p>
				      </div>
				    </div>
				  </div>
			<?php endforeach;?>
		</div>
	</div>	
</body>
</html>