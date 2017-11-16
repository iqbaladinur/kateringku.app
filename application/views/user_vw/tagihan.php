<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="theme-color" content="#2196f3">
	<title>Tagihan Pemesanan</title>
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="lib/css/style.css">
</head>
<body onload="window.print()" style="margin-bottom:50px">
	<div class="container bordered">
		<h3>
			<img class="img-responsive" alt="Brand" src="asset/img/katering.png"><br> Tagihan Pemesanan
		</h3><br>
		<h5 class="text-right">Nomor Tagihan: <b><?php echo $no_pesanan?></b></h4>
		<div class="table-responsive">
			<table class="table">
				<tr>
					<td>Atas Nama</td>
					<td>:</td>
					<td class="text-uppercase"><?php echo $nama?></td>
				</tr>
				<tr>
					<td>Alamat Lengkap</td>
					<td>:</td>
					<td><?php echo $alamat?></td>
				</tr>
				<tr>
					<td>Kode POS</td>
					<td>:</td>
					<td><?php echo $kd_pos?></td>
				</tr>
				<tr>
					<td>Tanggal Pemesanan</td>
					<td>:</td>
					<td><?php echo $tgl_pesan?></td>
				</tr>
				<tr>
					<td>Tanggal Pengambilan</td>
					<td>:</td>
					<td><?php echo $tgl_ambil?></td>
				</tr>
				<tr>
					<td>Metode Pengambilan</td>
					<td>:</td>
					<td><?php echo $metode==0?"Ambil Sendiri":"Jasa Antar Katering"?></td>
				</tr>
			</table>	
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<b>DETAIL PEMESANAN</b>
			</div>
			<div class="panel-body table-responsive">
				<table class="table">
					<tr>
						<td class="middle">Nama Menu</td>
						<td class="middle">:</td>
						<td class="middle">
							<?php
								foreach ($this->cart->contents() as $items) {
									echo $items['name']."  x  ".$items['qty']." = Rp. ".number_format($items['qty']*$items['price'], 0, '','.').',-<br>';
								} 
							?>
						</td>
					</tr>
					<tr>
						<td class="middle">Total Items</td>
						<td class="middle">:</td>
						<td class="middle"><?php echo $itemcart;?></td>
					</tr>
					<tr>
						<td class="middle">Total Tagihan</td>
						<td class="middle">:</td>
						<td class="middle">Rp. <?php echo number_format($total_harga, 0, '','.').',-';?></td>
					</tr>
				</table>
			</div>
		</div>
		<div>
			<h4>Metode Pembayaran</h4>
			<p>Pelanggan yang berbahagia, untuk saat ini kami melayani pembayaran via transfer dan pembayaran di tempat. Pesanan anda akan diproses apabila tagihan pembayaran telah dipenuhi, perlu diketahui harga sudah termasuk ongkos kirim. Anda dapat melakukan pembayaran pada rekening berikut ini:</p><br>
			<div style="padding-top:20px;margin-bottom:20px" class="col-sm-12  text-center bg-info">
				<ul class="list-unstyled">
					<li><label>Bank BRI 	: 6697-0000-0010-1672 </label></li>
					<li><label>Bank Mandiri : 6697-0000-0010-1672 </label></li>
				</ul>
			</div>
			<p>
				Apabila dalam 3 hari tagihan ini belum dipenuhi maka pemesanan akan dianggap batal.<br><br><br>
				Terimakasih,<br> 
				Manajemen Kateringku.
			</p>
		</div>
	</div>
</body>
</html>