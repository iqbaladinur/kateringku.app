<div style="margin-top:20px;margin-bottom:30px" class="container">
	<h3>Lengkapi Data Diri Anda</h3>
	<br>
		<form id="data-diri" action="update-data-diri.html" class="form-horizontal" enctype="multipart/form-data" method="POST">
			<div class="col-md-3">
				<img style="width:128px;height:128px;border:1px solid #D3D3D3;" class="img-responsive" src="<?php echo $this->session->userdata('profile');?>">
				<br>
				<label class="label-left">Unggah Profile</label><br><br>
				<?php if(isset($upload)) echo $upload;?>
				<input name="photo" type="file">
			</div>
			<div class="col-md-9">
				<?php if(isset($error)) echo $error;?>
				 <div class="form-group">
				    <label class="label-left col-sm-offset-1 col-sm-3">Nama Pegguna</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" name="id_user" placeholder="<?php echo $this->session->userdata("id_user")?>">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="label-left col-sm-offset-1 col-sm-3">Alamat E-mail</label>
				    <div class="col-sm-8">
				      <input type="email" class="form-control" name="email" placeholder="<?php echo $this->session->userdata("email")?>">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="label-left col-sm-offset-1 col-sm-3">Nama Asli</label>
				    <div class="col-sm-8"> 
				      <input type="text" id="nama" name="nama" class="form-control" value="<?php if(isset($datadiri)) echo $datadiri[0]->nama;?>">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="label-left col-sm-offset-1 col-sm-3">Alamat Rumah (Pengiriman)</label>
				    <div class="col-sm-8"> 
				      <input type="text" id="alamat" name="alamat" class="form-control" value="<?php if(isset($datadiri)) echo $datadiri[0]->alamat;?>">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="label-left col-sm-offset-1 col-sm-3">Kode POS</label>
				    <div class="col-sm-8"> 
				      <input type="text" id="kd_post" name="kd_pos" class="form-control" value="<?php if(isset($datadiri)) echo $datadiri[0]->kd_pos;?>">
				    </div>
				  </div>
				  <div class="form-group"> 
				    <div class="text-right col-sm-12">
				      <input type="submit" class="btn btn-sm btn-style btn-success" value="Simpan Data">
				    </div>
				  </div>
			</div>
		</form>
</div>