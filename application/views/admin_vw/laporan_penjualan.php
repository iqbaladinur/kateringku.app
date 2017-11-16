<!-- Page Content -->
<?php $bln=$this->input->get('bln');
  if (is_null($bln)) {
    $bln=date("m");
  }
?>
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <h4>LAPORAN PENJUALAN</h4>

    <div class="panel panel-default">
        <div class="panel-heading">
        <div class="row">
            <div class="col-md-5"><b>Data Laporan Penjualan</b></div>
            <div class="col-md-2">
             <form style="margin-bottom: 0px" id="cari" action="<?php echo base_url('admin/lihat_laporan_penjualan');?>" method="GET">
                    <select id="bln" name="bln" class="form-control input-sm" placeholder="bulan">
                      <option> Bulan</option>
                      <option <?php echo $bln=="01"?"selected":"";?> value='01'>Januari</option>
                      <option <?php echo $bln=="02"?"selected":"";?> value='02'>Februari</option>
                      <option <?php echo $bln=="03"?"selected":"";?> value='03'>Maret</option>
                      <option <?php echo $bln=="04"?"selected":"";?> value='04'>April</option>
                      <option <?php echo $bln=="05"?"selected":"";?> value='05'>Mei</option>
                      <option <?php echo $bln=="06"?"selected":"";?> value='06'>Juni</option>
                      <option <?php echo $bln=="07"?"selected":"";?> value='07'>Juli</option>
                      <option <?php echo $bln=="08"?"selected":"";?> value='08'>Agustus</option>
                      <option <?php echo $bln=="09"?"selected":"";?> value='09'>September</option>
                      <option <?php echo $bln=="10"?"selected":"";?> value='10'>Oktober</option>
                      <option <?php echo $bln=="11"?"selected":"";?> value='11'>November</option>
                      <option <?php echo $bln=="12"?"selected":"";?> value='12'>Desember</option>
                    </select>
            </div>
            <div class="col-md-2">
                    <select id="tahun" name="tahun" class="form-control input-sm">
                    <option value="">Tahun</option>
                    <script type="text/javascript">
                      function getParameterByName(name, url) {
                          if (!url) {
                            url = window.location.href;
                          }
                          name = name.replace(/[\[\]]/g, "\\$&");
                          var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                              results = regex.exec(url);
                          if (!results) return null;
                          if (!results[2]) return '';
                          return decodeURIComponent(results[2].replace(/\+/g, " "));
                      }
                      var year= new Date();
                      var thisyear=getParameterByName('tahun');
                      if (thisyear==null) {
                        thisyear=year.getFullYear();
                      }
                      var startyear=2000;
                      for (var i = 0; i <= 30; i++) {
                        if (Number(startyear+i)==thisyear) {
                             document.write("<option selected value='"+ Number(startyear+i) +"'>"+ Number(startyear+i) +"</option>");   
                        }else{
                             document.write("<option value='"+ Number(startyear+i) +"'>"+ Number(startyear+i) +"</option>"); 
                        }       
                      }
                    </script>
                    </select>
            </div>
            <div class="col-md-3 text-right">
                <button type="submit" class="btn btn-default btn-sm" type="button">Lihat Penjualan</button>
              </form>
              <a id="cetak" class="btn btn-default btn-sm">Cetak</a>
            </div>
        </div>
        </div>
        <div class="table-responsive">
        <table id="data-export" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Id</th>
                <th class="text-center">No. Pesanan</th>
                <th class="text-center">Tgl Pencatatan</th>
                <th class="text-center">Modal</th>
                <th class="text-center">Keuntungan</th>              
            </tr>
        </thead>
        <tbody>
        <?php if (empty($penjualan)) { ?>
            <tr>
                <td colspan="6" class="text-center">
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
               </tr>
        <?php $no++; }} ?> 
               <tr>
                 <th colspan="5">Total Transaksi</th>
                 <td class="text-center" colspan="1"><?php echo $total_transaksi;?></td>
               </tr> 
               <tr>
                 <th colspan="5">Total Modal</th>
                 <td class="text-right" colspan="1">Rp. <?php  echo number_format($total_permodalan, 0, '','.').',-';?></td>
               </tr>
               <tr>
                 <th colspan="5">Total Keuntungan</th>
                 <td class="text-right" colspan="1">Rp. <?php  echo number_format($total_keuntungan, 0, '','.').',-';?></td>
               </tr>
        </tbody>
        </table>
        </div>
    </div>
        </div>
    </div>
        <!-- /#page-content-wrapper -->
</div>
    <!-- /#wrapper -->
</body>
<script type="text/javascript" src="<?php echo base_url('lib/js/tableexport.js');?>"></script>
<script type="text/javascript">
    $("table").tableExport({
       formats: ["xls"],
       position: "bottom"
    });
    $('#cetak').click(function(){
      $(".xls").click();
    });
</script>
<style type="text/css">
  caption.btn-toolbar.bottom {
    display: none;
  }
</style>