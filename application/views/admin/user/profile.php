<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/select2/select2.css')?>">

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Pengguna Aplikasi</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
			<div class="row">
				<?php 
					if(!is_null($this->session->userdata('msg'))){
						echo $this->session->userdata('msg');
					}
				?>
				<div class="col-md-6">
					<form role="form" method="post" action="<?php echo site_url('user/doEditProffile')?>" enctype="multipart/form-data">
					<input type="hidden" value="<?php echo $detail->user_id?>" name="id" id="id">
						<div class="form-group">
							<label>Nama Lengkap</label>
							<input type="text" value="<?php echo $detail->user_full_name?>" name="user_full_name" id="user_full_name" class="form-control" placeholder="Nama Lengkap">
						</div>
						
						<div class="form-group">
							<label>Email</label>
							<input type="text" value="<?php echo $detail->user_email?>" name="user_email" id="user_email" class="form-control" placeholder="Email">
						</div>
						
						<div class="form-group">
							<label>Username</label>
							<input type="text" value="<?php echo $detail->user_username?>" name="user_username" id="user_username" class="form-control" placeholder="Level">
						</div>						
						<div class="form-group">
							<label>Deskripsi</label>
							<textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" placeholder="Enter ..."><?php echo $detail->user_desc?></textarea>
						</div>
						<div class="form-group">
							<label>Password baru</label>
							<input type="password" name="user_password" id="user_password" class="form-control" placeholder="Password Baru"> *<i>kososngkan jika tidak ingin merubah password</i>
						</div>						
						<div class="form-group hide" id="conf_pass">
							<label>Konfirmasi Password baru</label>
							<input type="password" name="user_password_conf" id="user_password_conf" class="form-control" placeholder="Konfirmasi Password Baru">
						</div>		
						<div class="form-group hide" id="old_pass">
							<label>Password Lama</label>
							<input type="password" name="user_password_old" id="user_password_old" class="form-control" placeholder="Password Lama">
						</div>
						<?php
							$hide_foto = '';
							if(empty($detail->user_photo_name) || is_null($detail->user_photo_name)){
								$hide_foto = 'hide';
							}
						?>
						<div class="form-group">
							<label>Foto</label>
							<input type="file" name="photo" id="photo">							
							<label class="<?php echo $hide_foto ?>" ><img height="100px" src="<?php echo base_url('assets/user_img/'. $detail->user_photo_name)?>"></label>
						</div>
						
						<div class="box-footer">
							<button type="submit" class="btn btn-info pull-right">Simpan</button>
						</div>
					</form>
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
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/select2/select2.full.js')?>"></script>

<script>	
	jQuery(function($) {
		$('#user_password').keyup(function(){
			$('#conf_pass').removeClass('hide');
			$('#old_pass').removeClass('hide');
		})
	})
</script>
<?php
$this->load->view('template/foot');
?>