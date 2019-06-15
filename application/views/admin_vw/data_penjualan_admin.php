<!-- Page Content -->

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <h4>DATA PENJUALAN</h4>

    <div class="panel panel-default">
        <div class="panel-heading">
        <div class="row">
            <div class="col-md-7"><b>Data Penjualan</b></div>
            <div class="col-md-2 pull-right">
              <input onclick="show_penjualan_form()" type="button" class="input-sm" name="" value="Masukan Pejualan">
            </div>
            <div class="col-md-3">
            <form style="margin-bottom: 0px" id="cari" action="<?php echo base_url('admin/search_data_penjualan');?>" method="GET">
                <div class="input-group">
                  <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control input-sm" placeholder="Tanggal" required>
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-secondary btn-sm" type="button">Cari</button>
                  </span>
                </div>
            </form>
            </div>
        </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Id</th>
                <th class="text-center">No. Pesanan</th>
                <th class="text-center">Tgl Pencatatan</th>
                <th class="text-center">Modal</th>
                <th class="text-center">Keuntungan</th>
                <th class="text-center">Aksi</th>                
            </tr>
        </thead>
        <tbody>
        <?php if (empty($penjualan)) { ?>
            <tr>
                <td colspan="7" class="text-center">
                    Tidak ada Penjualan
                </td>
            </tr>
        <?php } else {
           $no=1;
           foreach ($penjualan as $data) {?>
               <tr>
                   <td class="text-center"><?php echo $no;?></td>
                   <td class="text-center"><?php echo $data->no;?></td>
                   <td class="text-left"><?php echo $data->no_pesanan;?></td>
                   <td class="text-center"><?php echo $data->tgl_masukan;?></td>
                   <td class="text-right">Rp. <?php echo number_format($data->modal, 0, '','.').',-';?></td>
                   <td class="text-right">Rp. <?php echo number_format($data->keuntungan, 0, '','.').',-';?></td>
                   <td class="text-center">
                        <a href="#" onclick="update.call(this);" style="margin-right:5px" class="btn btn-info btn-sm">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>  
                        <a href="#" onclick="hapus.call(this);" class="btn btn-danger btn-sm">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                   </td>
               </tr>
        <?php $no++; }} ?>  
        </tbody>
        </table>
        </div>
    <div class="panel-footer text-center">
        <small>
            <?php echo empty($link)? "Page 1(30)" : $link ; ?>
        </small>
    </div>
    </div>
        </div>
    </div>
        <!-- /#page-content-wrapper -->
</div>
    <!-- /#wrapper -->
<div class="modal fade" id="update_data_penjualan" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div style="background-color:#00796B; color: white" class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Perbaharui Data Penjualan</h3>
        </div>
        <div class="modal-body">
        <div id="detail-table" class="table-responsive">
           <form action="<?php echo base_url('admin/update_data_penjualan');?>" method="GET">
                <div class="form-group">
                  <label for="usr">No. Pesanan</label>
                  <input type="text" name="id" id="id" class="hidden">
                  <input type="text" class="form-control" id="no" name="no">
                </div>
                <div class="form-group">
                  <label for="sel1">Tgl Pencatatan</label>
                  <input type="date" name="tgl_masukan" id="tgl_masukan" class="form-control">
                </div>
                <div class="form-group">
                  <label for="sel1">Modal</label>
                  <input type="number" name="modal" id="modal" class="form-control">
                </div>
                <div class="form-group">
                  <label for="sel1">Keuntungan</label>
                  <input type="number" name="keuntungan" id="keuntungan" class="form-control">
                </div>
                
       </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info">update</button>
          </form> 
          <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
        </div>
      </div>      
    </div>
</div>
<div class="modal fade" id="tambah_data_penjualan" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div style="background-color:#00796B; color: white" class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Masukan Data Penjualan</h3>
        </div>
        <div class="modal-body">
        <div id="detail-table" class="table-responsive">
           <form action="<?php echo base_url('admin/tambah_data_penjualan');?>" method="GET">
                <div class="form-group">
                  <label for="usr">No. Pesanan</label>
                  <input type="text" class="form-control" id="no" name="no" required>
                </div>
                <div class="form-group">
                  <label for="sel1">Tgl Pencatatan</label>
                  <input type="date" name="tgl_masukan" id="tgl_masukan" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="sel1">Modal</label>
                  <input type="number" name="modal" id="modal" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="sel1">Keuntungan</label>
                  <input type="number" name="keuntungan" id="keuntungan" class="form-control" required>
                </div>
                
       </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info">Masukan</button>
          </form> 
          <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
        </div>
      </div>      
    </div>
</div>
</body>
<script type="text/javascript">
    var hapus=function(){
        var del = confirm("Anda yakin ingin meghapus data ini?");
        if (del) {
            var currentRow=$(this).closest("tr");
            var no_pesanan=currentRow.find("td:eq(2)").text();
            var url='delete_data_penjualan/'+no_pesanan;
            var sendData=$.get(url);
            sendData.done(function(data){
                if (data) {
                    alert('Data dihapus!');
                    location.reload();
                }else{
                    alert('Error! hapus data gagal');
                }
            });
        }   
    }
    var update=function(){
        var currentRow=$(this).closest("tr");
        var id=currentRow.find("td:eq(1)").text();
        var no_pesanan=currentRow.find("td:eq(2)").text();
        var tgl_masukan=currentRow.find("td:eq(3)").text();
        var modal=currentRow.find("td:eq(4)").text();
        var keuntungan=currentRow.find("td:eq(5)").text();
        $("#id").val(id);
        $("#no").val(no_pesanan);
        $("#tgl_masukan").val(tgl_masukan);
        $("#modal").val(modal.replace(/\D/g, ''));
        $("#keuntungan").val(keuntungan.replace(/\D/g, ''));
        $("#update_data_penjualan").modal();
    }
    function show_penjualan_form(){
        $("#tambah_data_penjualan").modal();
    }
</script>