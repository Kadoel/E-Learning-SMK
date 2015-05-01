<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pengajar</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?= base_url('assets/css/plugins/metisMenu/metisMenu.min.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/sb-admin-2.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= base_url('assets/font-awesome-4.3.0/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
    
    <!-- DataTable css -->
    <link href="<?= base_url('assets/css/dataTables.bootstrap.css');?>" rel="stylesheet" />
    
     <script src="<?= base_url('assets/plugins/alertify/alertify.min.js');?>"></script>
	<!-- include the style -->
	<link rel="stylesheet" href="<?= base_url('assets/plugins/alertify/css/alertify.min.css');?>" />
	<!-- include a theme -->
	<link rel="stylesheet" href="<?= base_url('assets/plugins/alertify/css/themes/default.min.css');?>" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <?php $this->load->view('include/menu_admin'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Pengajar</h1>
                </div><!-- /.col-lg-12 -->
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong>Form Pengajar</strong>
                        </div>
                        <div class="panel-body">
							<span id="warning"></span>
                            <?php
							$attform = array(
									'id' => 'form-pengajar',
									'role' => 'form'
								);
							echo form_open('admin/pengajar/act_pengajar', $attform);
							?>
								<input type="hidden" name="pengajar_id" value="<?php echo $id_pengajar; ?>">
								<input type="hidden" name="pengajar_nama_asli" value="<?php echo $nama_pengajar; ?>">
								<input type="hidden" name="pengajar_username_asli" value="<?php echo $username_pengajar; ?>">
								<input type="hidden" name="pengajar_password_asli" value="<?php echo $password_pengajar; ?>">
								<div class="col-lg-6">
									<div class="form-group">
										<label>Nama Pengajar</label>
										<?php $att = array('class'=>'form-control', 
												'name'=>'pengajar_nama', 
												'value'=>$nama_pengajar,
												'placeholder'=>'Masukkan Nama Pengajar',
												'data-validation'=>'required',
												'data-validation-error-msg'=>'Silahkan isi Nama Pengajar',
												'data-toggle'=>"tooltip",
												'data-placement'=>"top",
												'title'=>"Tuliskan Nama Pengajar Beserta Dengan Titlenya");
										echo form_input($att);
										echo form_error('pengajar_nama'); ?>
									</div>
									
									<div class="form-group">
										<label>No. Induk Pegawai</label>
										<?php $attnip = array('class'=>'form-control', 
												'name'=>'pengajar_nip', 
												'value'=>$nip_pengajar,
												'placeholder'=>'Masukkan NIP (Untuk PNS)',
												'data-toggle'=>"tooltip",
												'data-placement'=>"top",
												'title'=>"Tuliskan NIP Hanya Untuk PNS");
										echo form_input($attnip);
										echo form_error('pengajar_nip'); ?>
									</div>
									
									<div class="form-group">
										<label>Username</label>
										<?php $attusername = array('class'=>'form-control', 
												'name'=>'pengajar_username', 
												'value'=>$username_pengajar,
												'placeholder'=>'Masukkan Username',
												'data-validation'=>'custom length',
												'data-validation-regexp'=>'^([a-z]+)$',
												'data-validation-length'=>'min5',
												'data-validation-error-msg'=>'Username Hanya Boleh (a-z), dan Minimal 5 karakter',
												'data-toggle'=>"tooltip",
												'data-placement'=>"top",
												'title'=>"Tuliskan Username Minimal 5 Karakter");
										echo form_input($attusername);
										echo form_error('pengajar_username'); ?>
									</div>
									
									<div class="form-group">
										<label>Password</label>
										<?php $attpass = array('class'=>'form-control', 
												'name'=>'pengajar_password', 
												'value'=>$password_pengajar,
												'placeholder'=>'Masukkan Password',
												'data-validation'=>'length required',
												'data-validation-length'=>'min8',
												'data-validation-error-msg'=>'Password harus 8 karakter atau lebih',
												'data-toggle'=>"tooltip",
												'data-placement'=>"top",
												'title'=>"Tuliskan Password Dengan Kombinasi Huruf, Angka, Symbol");
										echo form_password($attpass);
										echo form_error('pengajar_password'); ?>
									</div>
								</div><!-- /.col-lg-6 -->
								<div class="col-lg-6">
									<div class="form-group">
										<label>Alamat</label>
										<?php $attalamat = array('class'=>'form-control', 
												'name'=>'pengajar_alamat', 
												'value'=>$alamat_pengajar,
												'placeholder'=>'Masukkan Alamat',
												'style'=>'min-height:110px; height:100px; max-height:150px; min-width:100%; max-width:100%; width:100%; ',
												'data-validation'=>'required',
												'data-validation-error-msg'=>'Silahkan isi Alamat Pengajar',
												'data-toggle'=>"tooltip",
												'data-placement'=>"top",
												'title'=>"Tuliskan Alamat Dengan Lengkap");
										echo form_textarea($attalamat);
										echo form_error('pengajar_alamat'); ?>
									</div>
									
									<div class="form-group">
										<label>Group</label>
										<select class="form-control" name="pengajar_group" data-validation='required' data-validation-error-msg='Silahkan isi Group' data-toggle="tooltip" data-placement="top" title="Admin Mempunyai Hak Akses Penuh Terhadap System">
											<?php
											$group = array('1'=>'Admin', '2'=>'Pengajar');
											echo'<option value="">-- Pilih Group --</option>';
											foreach($group as $grp => $values){
												echo '<option value="'.$grp.'"';
													if($grp == $group_pengajar){
														echo ' selected';
													}
												echo '>'.$values.'</option>';
												echo form_error('pengajar_group');
											}
											?>
										</select>
									</div>
									<?php 
									$attsubmit = array(
											'class'=>'btn btn-md btn-outline btn-primary',
											'id'=>'btn-pengajar',
											'name'=>'btn-pengajar',
											'type'=>'submit',
											'content'=>'<i class="fa fa-save"></i> Simpan'); 
									echo form_button($attsubmit); 
									?>
									<img src="<?= base_url()?>assets/images/ajax-loader.gif" id="LoadingImage" style="display:none; width:50px; height:50px;" />
								</div><!-- /.col-lg-6 -->
                            </form>
                        </div><!-- /.panel-body -->
                    </div><!-- /.panel -->
                </div> <!-- /.col-lg-12 -->
            </div><!-- / .row-->
            <div class="row">
                <div class="col-lg-12">
					<div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong>Data Pengajar</strong>
                        </div>
                        <div class="panel-body">
							<div class="table-responsive">
							<table id="tabel-pengajar" class="table table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Nama Pengajar</th>
										<th>No. Induk Pegawai</th>
										<th>Alamat</th>
										<th>Kontrol</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 0;
									foreach($list_pengajar as $pengajar_data) {?>
									<tr>
										<td><?php echo $no = $no+1; ?></td>
										<td><?php echo $pengajar_data->pengajar_nama; ?></td>
										<td><?php echo $pengajar_data->pengajar_nip; ?></td>
										<td><?php echo $pengajar_data->pengajar_alamat; ?></td>
										<td>
											<a href="<?php echo site_url('admin/pengajar/edit/'.$pengajar_data->pengajar_id);?>">
												<i class="fa fa-pencil"></i>
											</a>&nbsp;
											<a href="<?php echo site_url('admin/pengajar/hapus/'.$pengajar_data->pengajar_id);?>" class="hapus-pengajar">
												<i class="fa fa-times"></i>
											</a>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table></div>
						</div><!-- /.panel-body -->
					</div><!-- /.panel -->
				</div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
        </div><!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="<?= base_url('assets/js/jquery-1.11.0.js');?>"></script>
    <script src="<?= base_url('assets/js/jquery.min.js');?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url('assets/js/bootstrap.min.js');?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?= base_url('assets/plugins/metisMenu/metisMenu.min.js');?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?= base_url('assets/js/sb-admin-2.js');?>"></script>
    
    <script src="<?= base_url('assets/plugins/validasi/jquery.form-validator.js');?>"></script>
    
    <!-- DataTable js -->
    <script src="<?= base_url('assets/plugins/dataTables/jquery.dataTables.js');?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/plugins/dataTables/dataTables.bootstrap.js');?>" type="text/javascript"></script>
    
    <?php
    echo $datatable;
    echo $validasi;
    echo $kirim;
    echo $hapusdata;
    ?>
    
     <script>
    // tooltip demo
    $('.form-group').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
    </script>

    Page rendered in <strong>{elapsed_time}</strong> seconds.
</body>

</html>

