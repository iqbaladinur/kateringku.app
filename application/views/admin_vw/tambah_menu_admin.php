<div class="modal fade" id="tambah_menu" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div style="background-color:#00796B; color: white" class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Tambah Menu</h3>
        </div>
        <div class="modal-body">
        <form action="<?php echo base_url('admin/tambah_menu');?>" enctype="multipart/form-data" method="POST">
        	<div class="form-group">
        		<label>Nama Menu</label>
        		<input type="text" name="nama_menu" class="form-control input-sm" required>
        	</div>
        	<div class="form-group">
        		<label>Harga</label>
        		<input type="number" name="harga_menu" class="form-control input-sm" required>
        	</div>
        	<div class="form-group">
        		<label>Keterangan Menu (<=100 karakter)</label>
        		<textarea name="ket_menu" class="form-control input-sm" required placeholder="Keterangan Menu"></textarea>
        	</div>
        	<div class="form-group">
        		<label>Picture</label>
        		<input type="file" name="picture" class="form-control input-sm" required>
        	</div>     
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info">Tambah</button>
        </form>
          <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
        </div>
      </div>      
    </div>
</div>
<script type="text/javascript">
	function show_menu_form(){
        $("#tambah_menu").modal();   
    }   
    
</script>