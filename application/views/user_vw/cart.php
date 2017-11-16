<head>
	<title>Kerajang</title>
</head>
<div style="margin-top:20px;margin-bottom:30px" class='container'>
	<h3>Keranjang Pesanan</h3><br>
	<div class="col-md-12 table-responsive">
		<?php echo $table;?>	
	</div>
	<div class="col-md-offset-7 col-md-5">
		<div class="panel panel-default">
			<div class="panel-heading">
				<b>DETAIL PEMESANAN</b>
			</div>
			<div class="panel-body table-responsive">
				<table class="table">
					<tr>
						<td class="middle">Jumlah Items</td>
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
			<div class="panel-footer">
				<?php if ($itemcart!=0) {?>
					<a href="proses_pesanan.html" class="btn btn-sm btn-style btn-info" >Cek Keluar</a>	
				<?php }?>
						
			</div>
		</div>
	</div>


</div>
<script type="text/javascript">
	var active_button=function(){
		 var currentRow=$(this).closest("tr");
		 var btndis= currentRow.find("td:eq(4) > button:eq(0)");
		 btndis.removeClass("disabled");
		}
</script>
