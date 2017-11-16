<?php
	defined('BASEPATH') or exit('No direct script allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lihat Pesanan</title>
	<style type="text/css">
		thead{
			background-color: #2196f3;
		}
		th{
			text-align: center;
			font-weight: lighter;
		}
		td{
			font-weight: lighter;
			font-size: 10pt;
		}
		.kosong{
			height: 310px;
			line-height: 310px;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<h3>Riwayat Pesanan</h3>
		<div class="table-responsive">
		 <table class="table table-condensed table-bordered bordered">
		    <thead>
		      <tr>
		        <th>No</th>
		        <th>No Tagihan</th>
		        <th>Menu</th>
		        <th>Qty</th>
		        <th>Harga</th>
		        <th>Tgl Pemesanan</th>
		        <th>Tgl Pengambilan</th>
		        <th>Metode Pengambilan</th>
		        <th>Status Pesanan</th>
		        <th>Status Pembayaran</th>
		      </tr>
		    </thead>
		    <tbody>
		      <?php
		      	if (empty($data)) { ?>
		      		<tr class="kosong">
		      			<td colspan="10" class="text-center">Tidak ada riwayat pemesanan.</td>
		      		</tr>
		      	<?php }else{
					$no=1;
		      	foreach ($data as $data) { ?>
		      	<tr>
		      		<td class="text-center"><?php echo $no;?></td>
		      		<td><?php echo $data->no_pesanan;?></td>
		      		<td><?php echo $data->nama;?></td>
		      		<td class="text-center"><?php echo $data->qty;?></td>
		      		<td class="text-right"><?php echo "Rp. ".number_format($data->harga_total, 0, '','.').',-';?></td>
		      		<td class="text-center"><?php echo $data->tgl_pesan;?></td>
		      		<td class="text-center"><?php echo $data->tgl_ambil;?></td>
		      		<td class="text-center"><?php echo $data->metode_pengambilan==0?"Ambil sendiri":"Jasa antar";?></td>
		      		<td class="text-center"><?php echo $data->status_pesanan==0?"Pengerjaan":"Selesai";?></td>
		      		<td class="text-center"><?php echo $data->status_pembayaran==0?"Belum":"Lunas";?></td>
		      	</tr>
		      <?php $no++; } 
		      	}?>
		    </tbody>
		</table>
		<?php echo $paging;?>
		</div>
	</div>
</body>
</html>