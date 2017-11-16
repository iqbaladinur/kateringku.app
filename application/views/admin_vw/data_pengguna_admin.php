<!-- Page Content -->

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <h4>DATA PENGGUNA</h4>

    <div class="panel panel-default">
        <div class="panel-heading">
        <div class="row">
            <div class="col-md-9"><b>Data Pengguna</b></div>
            <div class="col-md-3">
            <form style="margin-bottom: 0px" id="cari" action="<?php echo base_url('admin/search_data_pengguna');?>" method="GET">
                <div class="input-group">
                  <input type="text" name="id_user" id="id_user" class="form-control input-sm" placeholder="username" required>
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
                <th class="text-center">User Id</th>
                <th class="text-center">Email</th>
                <th class="text-center">Level</th>
                <th class="text-center">Aksi</th>                
            </tr>
        </thead>
        <tbody>
        <?php if (empty($pengguna)) { ?>
            <tr>
                <td colspan="5" class="text-center">
                    Tidak ada pesanan masuk
                </td>
            </tr>
        <?php } else {
           $no=1;
           foreach ($pengguna as $data) {?>
               <tr>
                   <td class="text-center"><?php echo $no;?></td>
                   <td class="text-left"><?php echo $data->id_user;?></td>
                   <td class="text-left"><?php echo $data->email;?></td>
                   <td class="text-center"><?php echo $data->level;?></td>
                   <td class="text-center">
                        <a href="#" onclick="detail.call(this);" style="margin-right:5px" class="btn btn-info btn-sm">
                            <span class="glyphicon glyphicon-eye-open"></span>
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
<div class="modal fade" id="lihat-detail-pengguna" role="dialog">
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
</body>
<script type="text/javascript">
    var detail=function(){
        var currentRow=$(this).closest("tr");
        var id_user=currentRow.find("td:eq(1)").text();
        /*gettring rady for ajax*/
        var url='lihat_detail_pengguna/'+id_user;
        var sendData=$.get(url);
        sendData.done(function(data){
            $("#detail-table").empty().append(data);
            $("#lihat-detail-pengguna").modal();
        });   
    }
</script>