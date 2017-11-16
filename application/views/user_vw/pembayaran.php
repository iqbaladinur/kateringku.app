<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Upload Bukti Pembayaran</title>
</head>
<body style="padding-top:70px ">
	<div class="container">
		<div class="col-md-offset-3 col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4>Upload Bukti Pembayaran</h4>
				</div>
				<div class="panel-body">
				<p class="text-justify">
					Apabila anda telah melakukan pembayaran sesuai dengan tagihan ketika cekout pesanan, maka anda dapat meng-unggah bukti pembayaran tersebut pada halaman ini, agar pesanan dapat segera diproses.
				</p>
				<p class="text-justify">
					Jangan lupa untuk menyertakan nomor pesanan yang tertera pada pojok kanan atas tagihan anda.
				</p>
					<form action="upload-tiket.html" enctype="multipart/form-data" method="POST">
					<?php if(!is_null($this->input->get("error"))){?>
						<div class='alert alert-danger'>
				 	         <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				 	         <?php echo $this->input->get("error");?>
				 		</div>
				 	<?php }?>
				 	<?php if(!is_null($this->input->get("success"))){?>
						<div class='alert alert-success'>
				 	         <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				 	         <?php echo $this->input->get("success");?>
				 		</div>
				 	<?php }?>
						<div class="form-group">
						  <label for="photo">Bukti Foto Pembayaran</label>
						  <input name="photo" type="file">
						</div>
						<div class="form-group">
						  <label for="no_pesanan">No. Pesanan</label>
						  <input type="text" class="form-control" id="no_pesanan" name="no_pesanan" required placeholder="Ex:xVbshhsmak...">
						</div>
						  <input type="submit" class="btn btn-info btn-sm" value="Upload Bukti Pembayaran">
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>