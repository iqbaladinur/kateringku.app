<?php
	defined('BASEPATH') or exit('No direct script allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Homepage:Kateringku App</title>
</head>
<body>
	<!-- carousel-->
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
	  <!-- Indicators -->
	  <ol class="carousel-indicators">
	    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	    <li data-target="#myCarousel" data-slide-to="1"></li>
	    <li data-target="#myCarousel" data-slide-to="2"></li>
	    <li data-target="#myCarousel" data-slide-to="3"></li>
	  </ol>

	  <!-- Wrapper for slides -->
	  <div class="carousel-inner" role="listbox">
	    <div class="item active">
	      <img class="img-responsive caraousel-img" loading="lazy" src="https://images.unsplash.com/photo-1571951735163-9557695592ce?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" alt="1">
	      <div class="carousel-caption">
	        <h3>Mudah</h3>
	        <p>Lorem ipsum booghore gapsum estrada palakuonium</p>
	      </div>
	    </div>

	    <div class="item">
	      <img class="img-responsive caraousel-img" loading="lazy" src="https://images.unsplash.com/photo-1572656631137-7935297eff55?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" alt="2">
	      <div class="carousel-caption">
	        <h3>Senang</h3>
	        <p>Lorem ipsum booghore gapsum estrada palakuonium</p>
	      </div>
	    </div>

	    <div class="item">
	      <img class="img-responsive caraousel-img" loading="lazy" src="https://images.unsplash.com/photo-1504754524776-8f4f37790ca0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" alt="3">
	      <div class="carousel-caption">
	        <h3>Nikmat</h3>
	        <p>Lorem ipsum booghore gapsum estrada palakuonium</p>
	      </div>
	    </div>

	    <div class="item">
	      <img class="img-responsive caraousel-img" loading="lazy" src="<?php echo base_url('asset/img/pic4.jpg')?>" alt="4"><div class="carousel-caption">
	        <h3>Higenis</h3>
	        <p>Lorem ipsum booghore gapsum estrada palakuonium</p>
	      </div>
	    </div>
	  </div>

	  <!-- Left and right controls -->
	  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
	</div>
	<!-- menu bar -->
	<div class="container">
		<div class="pull-left">
			<h3>Paket Katering</h3>
			<p>Pesan berdasarkan paket, mudah dan lebih hemat.</p>	
		</div>
	</div>
	<div class="container">
		<!--menu contains-->
		<div class="row">
		  <div class="menu col-xs-6 col-sm-3">
		    <a href="paket-pagi.html">
		      <img class="img-responsive paket" loading="lazy" src="<?php echo base_url('asset/menu-paket/pagi.png')?>" alt="pagi">
		    </a>
		  </div>
		  <div class="menu col-xs-6 col-sm-3">
		    <a href="paket-siang.html">
		      <img class="img-responsive paket" loading="lazy" src="<?php echo base_url('asset/menu-paket/siang.png')?>" alt="siang">
		    </a>
		  </div>
		  <div class="menu col-xs-6 col-sm-3">
		    <a href="paket-malam.html">
		      <img class="img-responsive paket" loading="lazy" src="<?php echo base_url('asset/menu-paket/malam.png')?>" alt="malam">
		    </a>
		  </div>
		  <div class="menu col-xs-6 col-sm-3">
		    <a href="paket-ekonomis.html">
		      <img class="img-responsive paket" loading="lazy" src="<?php echo base_url('asset/menu-paket/ekonomis.png')?>" alt="ekonomis">
		    </a>
		  </div>
		</div>
    </div>
    <!-- menu bar -->
	<div class="container">
		<div class="pull-left">
			<h3>Menu Katering</h3>
			<p>Pesan sekarang juga!.</p>	
		</div>
		<div style="padding-bottom:10px" class="pull-right">
			<a href="lihat-menu.html" class="btn btn-warning btn-sm btn-style">Lihat Semua</a>
		</div>
	</div>
	<div class="container">
		<!--menu contains-->
		<div id="content" class="row">
			<?php foreach ($menu as $menu): ?>
				  <div class="menu col-xs-6 col-sm-3">
				    <div class="thumbnail">
				      <img class="img-responsive" src="<?php echo $menu->pic;?>" alt="test">
				      <div  class="caption">
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
<script type="text/javascript">
	$( document ).ready(function() {
    	if ($(window).width()<=320) {
    		$(".menu").toggleClass("col-xs-6");
    	}	
	});
</script>
</html>