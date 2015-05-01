<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kelas</title>

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
                    <h1 class="page-header">Kelas</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong>Form Kelas</strong>
                        </div>
                        <div class="panel-body">
							<span id="warning"></span>
                            <?php
							$attform = array(
									'id' => 'form-kelas',
									'role' => 'form'
								);
							echo form_open('admin/kelas/act_kelas', $attform);
							?>
								<input type="hidden" name="kelas_id" value="<?php echo $id_kelas; ?>">
								<div class="form-group">
									<label>Tingkat</label>
                                    <select class="form-control" name="kelas_nama" data-validation="required" data-validation-error-msg="Silahkan Pilih Tingkat" data-toggle="tooltip" data-placement="top" title="Pilih Tingkat Kelas">
										<?php
										$kelas = array('X'=>'X', 'XI'=>'XI', 'XII'=>'XII');
										echo'<option value="">-- Pilih Tingkat --</option>';
										foreach($kelas as $kls => $values){
											echo '<option value="'.$kls.'"';
												if($kls == $nama_kelas){
													echo ' selected';
												}
											echo '>'.$values.'</option>';
											echo form_error('kelas_nama');
										}
										?>
                                    </select>
								</div>
								
								<div class="form-group">
                                    <label>Jurusan</label>
                                    <select class="form-control" name="kelas_jurusan" data-validation="required" data-validation-error-msg="Silahkan Pilih Jurusan" data-toggle="tooltip" data-placement="top" title="Pilih Jurusan Sesuai Sasaran Tingkat">
										<?php
										echo'<option value="">-- Pilih Jurusan --</option>';
										foreach($listJurusan as $jrs){
											echo '<option value="'.$jrs->jurusan_id.'"';
												if($jrs->jurusan_id == $jurusan_kelas){
													echo ' selected';
												}
											echo '>'.$jrs->jurusan_nama.'</option>';
											echo form_error('kelas_jurusan');
										}
										?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
									<label>No</label>
                                    <?php $att = array('class'=>'form-control', 
											'name'=>'kelas_no', 
											'value'=>$no_kelas,
											'placeholder'=>'Masukkan No (Jika Ada)',
											'data-toggle'=>"tooltip",
											'data-placement'=>"top",
											'title'=>"Tuliskan Nomor Tingkatnya (Jika Ada)");
									echo form_input($att);
									echo form_error('kelas_no'); ?>
								</div>
								
								<?php 
								$attsubmit = array(
										'class'=>'btn btn-md btn-outline btn-primary',
										'id'=>'btn-kelas',
										'name'=>'btn-kelas',
										'type'=>'submit',
										'content'=>'<i class="fa fa-save"></i> Simpan'); 
								echo form_button($attsubmit); 
								?>
								<img src="<?= base_url()?>assets/images/ajax-loader.gif" id="LoadingImage" style="display:none; width:50px; height:50px;" />
                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-8">
					<div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong>Data Kelas | Semester: <span class="badge badge-success"><?= $this->session->userdata('semester'); ?></span> | Tahun Pelajaran: <span class="badge badge-success"><?= $this->session->userdata('tahunajaran'); ?></span></strong></strong>
                        </div>
                        <div class="panel-body">
							<table id="tabel-kelas" class="table table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Nama Kelas</th>
										<th>Kontrol</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 0;
									foreach($listKelas as $kelas_data) {?>
									<tr>
										<td><?php echo $no = $no+1; ?></td>
										<td><?php echo $kelas_data->kelas_nama." ".$kelas_data->jurusan_nama." ".$kelas_data->kelas_no; ?></td>
										<td>
											<a href="<?php echo site_url('admin/kelas/edit/'.$kelas_data->kelas_id);?>">
												<i class="fa fa-pencil"></i>
											</a>&nbsp;
											<a href="<?php echo site_url('admin/kelas/hapus/'.$kelas_data->kelas_id);?>" class="hapus-kelas">
												<i class="fa fa-times"></i>
											</a>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div><!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

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

