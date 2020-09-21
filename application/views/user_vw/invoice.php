<head>
	<title>Proses Pesanan</title>
</head>
<div style="margin-top:20px;margin-bottom:30px" class="container">
	<h3>Proses Pemesanan</h3>
	<br>
	<div class="col-md-12">
		<?php if(isset($error)) echo $error;?>
	</div>
	<!--formnya-->
		<form id="invoice" action="prosesed.html" class="form-horizontal" method="POST" target="_blank">
			<div class="col-md-3">
				<img style="width:128px;height:128px;border:1px solid #D3D3D3;" class="img-responsive" src="<?php echo $this->session->userdata('profile');?>">
				<br>
			</div>
			<div class="col-md-9">
				  <div class="form-group">
				    <label class="label-left col-sm-offset-1 col-sm-3">Nama Asli</label>
				    <div class="col-sm-8"> 
				      <input type="text" id="nama" name="nama" class="form-control"  value="<?php if(isset($invoice)) echo $invoice[0]->nama;?>">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="label-left col-sm-offset-1 col-sm-3">Alamat Rumah (Pengiriman)</label>
				    <div class="col-sm-8"> 
				      <textarea style="height:100px" type="text" id="alamat" name="alamat" class="form-control"><?php if(isset($invoice)) echo $invoice[0]->alamat;?></textarea>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="label-left col-sm-offset-1 col-sm-3">Kode POS</label>
				    <div class="col-sm-8"> 
				      <input type="text" id="kd_post" name="kd_pos" class="form-control"  value="<?php if(isset($invoice)) echo $invoice[0]->kd_pos;?>">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="label-left col-sm-offset-1 col-sm-3">Tanggal Pengambilan</label>
				    <div class="col-sm-8"> 
				      <input type="date" id="tgl_ambil" name="tgl_ambil" class="form-control">
				      <input type="text" id="tgl_pesan" name="tgl_pesan" class="hidden form-control">
				    </div>
				      
				  </div>
				  <div class="form-group">
				    <label class="label-left col-sm-offset-1 col-sm-3">Metode Pengambilan</label>
				    <div class="col-sm-8"> 
				     <div class="radio">
					  <label><input type="radio" name="metode" value="0" checked>Ambil Sendiri</label>
					 </div>
					 <div class="radio">
					  <label><input type="radio" name="metode" value="1">Antar Katering</label>
					 </div>
				     </div>
				  </div>
			</div>
	<div class="col-md-12">
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
			<div class="panel-footer text-right">
				<input type="submit" class="btn btn-sm btn-style btn-success" value="Proses Pemesanan">			
			</div>
		</div>
	</div>
	</form>
</div>
<script type="text/javascript">
	$('#tgl_pesan').ready(function(){
		var rawdate= new Date();
		var date=rawdate.getFullYear()+"-"+rawdate.getMonth()+"-"+rawdate.getDate();
		var time=rawdate.getHours()+":"+rawdate.getMinutes()+":"+rawdate.getSeconds();
		var datetime=date+" "+time;
		$("#tgl_pesan").val(datetime);
	});
</script>
