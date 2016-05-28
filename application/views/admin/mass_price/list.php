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
        Harga Massal
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
    <div class="col-md-7">
	<div class="box">		
        <div class="box-header with-border">
			<?php
				foreach($list as $ls){
					$nama = $ls->inv_name;
					$inv_id = $ls->inv_id;
				}
				
			?>
            <h3 class="box-title">Daftar Harga Massal <?php echo strtoupper($nama);?></h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
			<div class="col-md-4">
				<?php echo isset($message)?$message:NULL?>
			</div>
			<div style="float:right" class="col-md-2">
				<a href="<?php echo base_url('index.php/mass_price/add')?>" ><button type="button" class="btn btn-block btn-success btn-sm">+</button></a>
			</div>
			</br>
			</br>
			<table id="tbl-mass_price" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Mulai</th>
                  <th>Sampai</th>                  
                  <th>Harga</th>                  
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
					<?php
						$no=1;
						foreach($list as $value){
							$price = ($value->massprice_range_end == 9999999)?"~":$value->massprice_range_end;
							echo '<tr>';
							echo '<td>'.$no.'</td>';
							echo '<td>'.$value->massprice_range_start.'</td>';
							echo '<td>'.$price.'</td>';
							echo '<td><div style="float:left">Rp</div><div class="auto" data-a-sep="." data-a-dec="," style="text-align:right">'.$value->massprice_price.'</div></td>';
							echo '<td>
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-flat">Aksi</button>
									<button type="button" class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="'.base_url('index.php/mass_price/edit/'.$value->inv_id.'/'.$value->massprice_id).'">Edit</a></li>
										<li><a href="'.site_url('mass_price/doDelete/'.$value->inv_id.'/'.$value->massprice_id).'">Hapus</a></li>
									</ul>
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
	</div>

	<div class="col-md-5">
	<div class="box">		
        <div class="box-header with-border">
			<h3 class="box-title">Tambah Harga Massal <?php echo strtoupper($nama);?></h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
			<div class="col-md-4">
				<?php echo isset($message)?$message:NULL?>
			</div>
			</br>
			</br>
			<form role="form" method="post" action="<?php echo base_url('index.php/mass_price/doAdd')?>">
				<div class="form-group">
					<label>Produk</label>
					<input type="text" name="produk" id="produk" value="<?php echo $inv_id?>" class="form-control" placeholder="Produk">
					<input type="hidden" name="produk_id" id="produk" value="<?php echo $inv_id?>" class="form-control" placeholder="Produk">
				</div>
				<div class="form-group">
					<label>Mulai</label>
					<input type="text" name="start" id="start" value="<?php echo $inv_id?>" class="form-control" placeholder="Produk">
				</div>
				<div class="form-group">
					<label>Sampai</label>
					<input type="text" name="end" id="end" value="<?php echo $inv_id?>" class="form-control" placeholder="Produk">
				</div>
				
				<div class="form-group">
					<label>Harga</label>
					<div class="input-group">
						<span class="input-group-addon">Rp</span>
						<input id="harga"  type="text" name="harga" pattern="[1-9].{4,}" class="form-control">
						<span class="input-group-addon">.00</span>
					</div>
				</div>
				
				<div class="box-footer">
					<button type="submit" class="btn btn-info pull-right">Simpan</button>
				</div>
			</form>
		</div><!-- /.box-body -->
        <div class="box-footer">           
        </div><!-- /.box-footer-->
		
    </div><!-- /.box -->
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
    $('#tbl-mass_price').DataTable({
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