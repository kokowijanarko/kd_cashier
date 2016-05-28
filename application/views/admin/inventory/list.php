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
        Inventori
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
            <h3 class="box-title">Daftar Barang dan Stok</h3>
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
				<a href="<?php echo base_url('index.php/inventory/add')?>" ><button type="button" class="btn btn-block btn-success btn-sm">Tambah Produk</button></a>
			</div>
			</br>
			</br>
			<table id="tbl-inventory" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Produk</th>
                  <th>Kategori</th>
                  <th>Type</th>
                  <th width="120px">Harga</th>
                  <th>Stok</th>
                  <th>Deskripsi</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
					<?php
						$no=1;
						foreach($list as $value){
							echo '<tr>';
							echo '<td>'.$no.'</td>';
							echo '<td>'.$value->inv_name.'</td>';
							echo '<td>'.$value->category_name.'</td>';
							echo '<td>'.$value->type_name.'</td>';
							echo '<td><div style="float:left">Rp</div><div class="auto" data-a-sep="." data-a-dec="," style="text-align:right">'.$value->inv_price.'</div></td>';
							echo '<td>'.$value->inv_stock.'</td>';
							echo '<td>'.$value->inv_desc.'</td>';
							echo '<td>
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-flat">Aksi</button>
									<button type="button" class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="'.base_url('index.php/inventory/edit/'.$value->inv_id).'">Edit</a></li>
										<li><a href="'.site_url('inventory/doDelete/'.$value->inv_id).'">Hapus</a></li>
										<li><a href="'.site_url('mass_price/listing/'.$value->inv_id).'">Lihat Harga Massal</a></li>
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
    $('#tbl-inventory').DataTable({
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