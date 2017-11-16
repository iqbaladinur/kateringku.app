<!-- Page Content -->

        <div id="page-content-wrapper">
            <div class="container-fluid">
                <h4>DASHBOARD</h4>
                <div class="row">
                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/pesanan_masuk');?>" class="<?php echo $jml_psn_msk==0?'btn-info':'btn-danger';?> btn  menu-pad">
                            <i class="badge notifikasi"><?php echo $jml_psn_msk;?></i><br>
                            <span style="font-size:50px" class="glyphicon glyphicon-bell"></span><br>
                            Pesanan Masuk
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/konfirmasi_pesanan');?>" class="<?php echo $jml_knfr_msk==0?'btn-info':'btn-danger';?> btn menu-pad">
                            <i class="badge notifikasi"><?php echo $jml_knfr_msk;?></i><br>
                            <span style="font-size:50px" class="glyphicon glyphicon-cog"></span><br>
                            Konfirmasi Pesanan
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="#" onclick="show_menu_form();" class="btn btn-info menu-pad">
                            <i class="badge notifikasi"><?php echo $jml_menu;?></i><br>
                            <span style="font-size:50px" class="glyphicon glyphicon-hdd"></span><br>
                            Tambah Menu
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/data_pengguna')?>" class="btn btn-info menu-pad">
                            <i class="badge notifikasi"><?php echo $jml_usr;?></i><br>
                            <span style="font-size:50px" class="glyphicon glyphicon-hdd"></span><br>
                            Data Pengguna
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/data_penjualan');?>" class="btn btn-info menu-pad">
                            <i class="badge notifikasi"></i><br>
                            <span style="font-size:50px" class="glyphicon glyphicon-hdd"></span><br>
                            Data Penjualan
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/lihat_laporan_penjualan');?>" class="btn btn-info menu-pad">
                            <i class="badge notifikasi"></i><br>
                            <span style="font-size:50px" class="glyphicon glyphicon-stats"></span><br>
                            Lap. Penjualan 
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
</div>
    <!-- /#wrapper -->
</body>