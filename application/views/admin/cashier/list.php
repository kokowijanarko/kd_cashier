<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->

<!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css">
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Job Order / Invoice
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Daftar Invoice</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
			<table id="tbl-invoice" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nomor Invoice</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Tanggal Order</th>
                  <th>Tanggal Pengambilan</th>
                  <th>Total</th>
                  <th>Kurang</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
					<?php
						$no=1;
						foreach($invoice as $value){
							echo '<tr>';
							echo '<td>'.$no.'</td>';
							echo '<td><button id="invoice_detail" type="button" class="btn btn-sm btn-info">'.$value->order_code.'</button></td>';
							echo '<td>'.$value->order_custommer_name.'</td>';
							echo '<td>'.$value->order_address.'</td>';
							echo '<td>'.$value->order_date_order.'</td>';
							echo '<td>'.$value->order_date_take.'</td>';
							echo '<td class="auto">'.$value->order_amount.'</td>';
							echo '<td class="auto">'.$value->order_cash_minus.'</td>';
							echo '<td>
								<div class="btn-group">
									<a href="'.base_url('index.php/invoice/edit/'.$value->order_id).'">
										<button type="button" class="btn btn-info btn-flat">Edit</button>
									</a>
									<a href="'.base_url('index.php/invoice/edit/'.$value->order_id).'">
										<button type="button" class="btn btn-success btn-flat">Selesai</button>
									</a>								
								</div>
							
							</td>';
							echo '</tr>';
							$no++;
						}
					?>
                </tbody>
              </table>
            
        </div><!-- /.box-body -->
        <div class="box-footer">
            
        </div><!-- /.box-footer-->
    </div><!-- /.box -->
	
	<div class="inv_det">
		<div class="box">
			<!--
			<div class="box-header with-border">
				<h3 class="box-title">Detail Invoice</h3>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			-->
			
		</div>	
	</div>
	

</section><!-- /.content -->

<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<!-- DataTables -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>

<!-- AutoNumeric -->
<script src="<?php echo base_url('assets/AutoNumeric/autoNumeric.js')?>" type="text/javascript"></script>

<script>
  jQuery(function($) {
	  
	$('#invoice_detail').click(function(){
		var invoice_number = $(this).text();
		console.log(invoice_number);
		$.ajax({
			data:{'invo_number':invoice_number},
			method:'post',
			url:'<?php echo site_url('cashier/get_detail_invoice')?>'
		}).success(function(result){
			result = JSON.parse(result);
			console.log(result);
			$('.inv_det').append(' <div class="box"> <div class="box-header with-border"> <h3 class="box-title">Detail Invoice</h3><div class="box-tools pull-right">	<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button><button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button></div></div></div>');
		});
	});
		
    $('#tbl-invoice').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
	
	$('.auto').autoNumeric('init');
  });
</script>
<?php
$this->load->view('template/foot');
?>