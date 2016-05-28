<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<!-- Select2 -->
<link rel="stylesheet" href="../../plugins/select2/select2.min.css">

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Order
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
            <h3 class="box-title">Buat Order</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
			<div class="row">
				<div class="col-md-4">
						<div class="form-group">
							<label>Produk</label>
							<select id="produk" name="produk" class="form-control select2" style="width: 100%;">
								<option value=''>--Pilih--</option>
								<?php
									foreach($produk as $val){
										echo '<option value="'.$val->inv_id.'|'.$val->inv_price.'">'.$val->inv_name .'</option>';
									}
								?>								
							</select>
						</div>						
						<div class="form-group">
							<label>Harga</label>
							<div class="input-group">
								<span class="input-group-addon">Rp</span>
								<input id="harga"  readonly type="text" name="harga" pattern="[1-9].{4,}" class="form-control">
								<span class="input-group-addon">.00</span>
							</div>
						</div>
						
						<div class="form-group">
							<label>Jumlah</label>
							<div class="input-group">
								<span class="input-group-addon">@</span>
								<input id="jumlah"  type="jumlah" name="jumlah" pattern="[1-9].{1,}" class="form-control">
								<span class="input-group-addon">Biji</span>
							</div>
						</div>
						
						<div class="form-group">
							<label>Catatan</label>
							<textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" placeholder="Enter ..."></textarea>
						</div>
						
						<div class="box-footer">
							<button id="smt-order" type="submit" class="btn btn-info">Tambah</button>
						</div>
					
				</div>
				<div class="col-md-8">
					<div class="col-md-6">
						<table class="table">
							<tr>
								<td>No. Nota</td>
								<td>:</td>
								<td><?php echo $order_code?></td>
							</tr>
							<tr>
								<td>Tanggal</td>
								<td>:</td>
								<td><?php echo date('D, d-m-Y') ?></td>
							</tr>										
						</table>
					</div>	
					<div class="col-md-6 pull-right">
						<table class="table">
							<tr>
								<td>Nama</td>
								<td>:</td>
								<td>xxxx</td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td>:</td>
								<td>xxxx</td>
							</tr>			
							<tr>
								<td>No. Kontak</td>
								<td>:</td>
								<td>xxxx</td>
							</tr>
							<tr>
								<td>No. email</td>
								<td>:</td>
								<td>xxxx</td>
							</tr>
						</table>
					</div>
					<div class="col-sm-12">
						<table id="tbl-produk-order" class="table table-bordered table-hover">
							<thead>
							<tr>
								<th>NO</th>
								<th>Produk</th>
								<th>Harga</th>
								<th>Jumlah</th>
								<th>Sub-Total</th>
								<th>Keterangan</th>
							</tr>
							</thead>
							<tbody id="tbl-body-produk-order">							
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tbody>
						</table>
					</div>
					
					<div class="col-md-3 pull-right">
						Front Office </br></br></br></br>						
						<label> Rere
						</label>
					</div>
				</div>
			</div><!-- /.box-body -->
        <div class="box-footer">
           
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->

<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<!-- Select2 -->
<script src="../../plugins/select2/select2.full.min.js"></script>

<?php
	$td = '
	<td></td>
	<td>-</td>
	<td>-</td>
	<td>-</td>
	<td>-</td>
	';
?>

<script>	
	jQuery(function($) {
		
		
		
		$('#type').prop('disabled', true);
		
		$('#category').change(function(){
			$('#type').prop('disabled', false);
		});
		$('#type').change(function(){
			var category = $('#category option:selected').text();
			var type = $('#type option:selected').text();
			var produk = category + ' ' + type;
			//console.log(produk);
			$('#produk').val(produk);
			
		});

		$('#produk').change(function(){
			var prod_val = $('#produk').val();
			var prod = prod_val.split('|');			
			var prod_price = prod[1];
			
			$('#harga').val(prod_price);
			$('#jumlah').val('1');
			console.log(prod);
		});
		
		var product_name = [];
		var product_id = [];
		var price = [];
		var quantity = [];
		var sub_total = [];
		var desc = [];
		$('#smt-order').click(function(){
			var prod_val = $('#produk').val();
			var prod_name = $('#produk option:selected').text();
			var prod = prod_val.split('|');			
			var prod_price = prod[1];
			var prod_id = prod[0];
			var prod_quantity = $('#jumlah').val(); 
			var prod_desc = $('#deskripsi').val(); 
			var prod_sub_total = prod_price * prod_quantity;
			
			
			if(prod_id != ""){
				product_id.push(prod_id);
				product_name.push(prod_name);
				price.push(prod_price);
				quantity.push(prod_quantity);
				sub_total.push(prod_sub_total);
				desc.push(prod_desc);
			}
			console.log(product_id);
			
		});
	})
</script>
<?php
$this->load->view('template/foot');
?>