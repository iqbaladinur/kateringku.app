<!-- Page Content -->

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <h4>PESANAN MASUK</h4>

    <div class="panel panel-default">
        <div class="panel-heading">
        <div class="row">
            <div class="col-md-9"><b>Data Pesanan Masuk</b></div>
            <div class="col-md-3">
            <form style="margin-bottom: 0px" id="cari" action="<?php echo base_url('admin/search_pesanan_masuk');?>" method="GET">
                <div class="input-group">
                  <input type="text" name="no_pesanan" id="no_pesanan" class="form-control input-sm" placeholder="Nomor Pesanan" required>
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
                <th class="text-center">No. Pesanan</th>
                <th class="text-center">Pelanggan</th>
                <th class="text-center">Tgl Pesan</th>
                <th class="text-center">Tgl Ambil</th>
                <th class="text-center">Proses</th>
                <th class="text-center">Pembayaran</th>
                <th class="text-center">Aksi</th>                
            </tr>
        </thead>
        <tbody>
        <?php if (empty($pesanan)) { ?>
            <tr>
                <td colspan="7" class="text-center">
                    Tidak ada pesanan masuk
                </td>
            </tr>
        <?php } else {
           $no=1;
           foreach ($pesanan as $data) {?>
               <tr class="<?php echo $data->status_pembayaran==0?'danger':'success';?>">
                   <td class="text-center"><?php echo $no;?></td>
                   <td class="text-left"><?php echo $data->no_pesanan;?></td>
                   <td class="text-center"><?php echo $data->id_user;?></td>
                   <td class="text-center"><?php echo $data->tgl_pesan;?></td>
                   <td class="text-center"><?php echo $data->tgl_ambil;?></td>
                   <td class="text-left"><?php echo $data->status_pesanan==0?'Pengerjaan':'Selesai';?></td>
                   <td class="text-center"><?php echo $data->status_pembayaran==0?'Belum':'Lunas';?></td>
                   <td class="text-center">
                        <a href="#" onclick="detail.call(this);" style="margin-right:5px" class="btn btn-info btn-sm">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </a>
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
<div class="modal fade" id="lihat-detail-pesanan" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div style="background-color:#00796B; color: white" class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Detail</h3>
        </div>
        <div class="modal-body">
        <div id="detail-table" class="table-responsive">
            
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
        </div>
      </div>      
    </div>
</div>
<div class="modal fade" id="update_status_pesanan" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div style="background-color:#00796B; color: white" class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Perbaharui Status Pesanan</h3>
        </div>
        <div class="modal-body">
        <div id="detail-table" class="table-responsive">
           <form action="<?php echo base_url('admin/update_status_pesanan');?>">
                <div class="form-group">
                  <label for="usr">No. Pesanan</label>
                  <input type="text" class="form-control" id="no" name="no">
                </div>
                <div class="form-group">
                  <label for="sel1">Ubah Status Pembayaran</label>
                  <select class="form-control" id="stat_bayar" name="stat_bayar">
                    <option value="0">Belum</option>
                    <option value="1">Lunas</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="sel1">Ubah Status Pengerjaan</label>
                  <select class="form-control" id="stat_kerja" name="stat_kerja">
                    <option value="0">Pengerjaan</option>
                    <option value="1">Selesai</option>
                  </select>
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
</body>
<script type="text/javascript">
    var detail=function(){
        var currentRow=$(this).closest("tr");
        var no_pesanan=currentRow.find("td:eq(1)").text();
        var id_user=currentRow.find("td:eq(2)").text();
        var tgl_pesan=currentRow.find("td:eq(3)").text();
        var tgl_ambil=currentRow.find("td:eq(4)").text();
        var metode_ambil=currentRow.find("td:eq(5)").text();
        var status_bayar=currentRow.find("td:eq(6)").text();      
        /*gettring rady for ajax*/
        var url='lihat_detail_pesanan/'+no_pesanan;
        var sendData=$.get(url, {id_user:id_user});
        sendData.done(function(data){
            $("#detail-table").empty().append(data);
            $("#lihat-detail-pesanan").modal();
        });   
    }
    var hapus=function(){
        var del = confirm("Anda yakin ingin meghapus data ini?");
        if (del) {
            var currentRow=$(this).closest("tr");
            var no_pesanan=currentRow.find("td:eq(1)").text();
            var url='delete_pesanan/'+no_pesanan;
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
        var no_pesanan=currentRow.find("td:eq(1)").text();
        $("#no").val(no_pesanan);
        $("#update_status_pesanan").modal();
    }
</script>