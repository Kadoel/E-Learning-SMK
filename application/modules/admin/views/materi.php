<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Materi</title>

   <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?= base_url('assets/css/plugins/metisMenu/metisMenu.min.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/sb-admin-2.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= base_url('assets/font-awesome-4.1.0/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
    
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
                    <h1 class="page-header">Materi</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
				<div class="col-lg-12">
					<div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong>Form Upload Materi</strong>
                        </div>
                        <div class="panel-body">
							<div class="confirm"></div>
                            <?php
							$attform = array(
								'id' => 'form-materi',
								'role' => 'form'
							);
							echo form_open_multipart('admin/materi/act_materi', $attform);
							?>
								<input type="hidden" name="materi_id" value="<?= $id_materi; ?>">
								<div class="form-group">
									<label>Nama Materi</label>
                                    <?php $att = array('class'=>'form-control', 
											'name'=>'materi_nama', 
											'value'=>$nama_materi,
											'placeholder'=>'Masukkan Nama Materi',
											'data-validation'=>'required',
											'data-validation-error-msg'=>'Silahkan isi Nama Materi');
									echo form_input($att);
									echo form_error('materi_nama'); ?>
								</div>
								
								<div class="form-group">
									<label>Deskripsi Materi</label>
                                    <?php $att = array('class'=>'form-control', 
											'name'=>'materi_deskripsi', 
											'value'=>$deskripsi_materi,
											'placeholder'=>'Masukkan Deskripsi Materi',
											'data-validation'=>'required',
											'data-validation-error-msg'=>'Silahkan isi Deskripsi Materi');
									echo form_input($att);
									echo form_error('materi_nama'); ?>
								</div>
								
								<div class="form-group">
                                    <label>Kelas</label>
                                    <select class="form-control" name="materi_kelas" data-validation="required" data-validation-error-msg="Silahkan Pilih Kelas">
										<?php
										$kelas = array('X'=>'X', 'XI'=>'XI', 'XII'=>'XII');
										echo'<option value="">-- Pilih Kelas --</option>';
										foreach($kelas as $kls => $values){
											echo '<option value="'.$kls.'"';
												if($kls == $kelas_materi){
													echo ' selected';
												}
											echo '>'.$values.'</option>';
											echo form_error('materi_kelas');
										}
										?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Jurusan</label>
                                    <select class="form-control" name="materi_jurusan" data-validation="required" data-validation-error-msg="Silahkan Pilih Jurusan">
										<?php
										echo'<option value="">-- Pilih Jurusan --</option>';
										foreach($list_jurusan as $jrs){
											echo '<option value="'.$jrs->jurusan_id.'"';
												if($jrs->jurusan_id == $jurusan_materi){
													echo ' selected';
												}
											echo '>'.$jrs->jurusan_nama.'</option>';
											echo form_error('materi_jurusan');
										}
										?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Pilih Materi</label>
                                    <input type="file" name="materi_file"<?=$file_materi;?>data-validation="extension required" data-validation-allowing="doc, docx, ppt, pptx, xls, xlsx, pdf" data-validation-error-msg="Hanya Boleh File Dokumen (Word, Excel, Powerpoint, PDF)">
                                </div>
                                
								<?php 
								$attsubmit = array(
										'class'=>'btn btn-md btn-success',
										'id'=>'btn-materi',
										'name'=>'btn-materi',
										'type'=>'submit',
										'content'=>'Simpan'); 
								echo form_button($attsubmit); 
								?>
                            </form>
                        </div><!-- /.panel-body -->
                    </div><!-- /.panel -->
				</div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
					<div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong>Data Materi Anda | Semester: <?= $this->session->userdata('semester'); ?> | Tahun Ajaran: <?= $this->session->userdata('tahunajaran'); ?></strong>
                        </div>
                        <div class="panel-body">
							<div class="table-responsive">
							<table id="tabel-materi" class="table table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Materi</th>
										<th>Deskripsi</th>
										<th>Kelas</th>
										<th>File</th>
										<th>Tanggal</th>
										<th>Kontrol</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 0;
									foreach($list_materi as $materi_data) {?>
									<tr>
										<td><?php echo $no = $no+1; ?></td>
										<td><?php echo $materi_data->materi_nama; ?></td>
										<td><?php echo $materi_data->materi_deskripsi; ?></td>
										<td><?php echo $materi_data->materi_kelas." ".$materi_data->jurusan_nama; ?></td>
										<td><a href="<?php echo base_url('assets/uploads').'/'.$materi_data->materi_file; ?>"><span class="glyphicon glyphicon-floppy-save"></span></a></td>
										<td><?php echo $materi_data->materi_tanggal; ?></td>
										<td>
											<a href="<?php echo site_url('admin/materi/edit/'.$materi_data->materi_id);?>">
												<i class="fa fa-pencil"></i>
											</a>&nbsp;
											<a href="<?php echo site_url('admin/materi/hapus/'.$materi_data->materi_id);?>" class="hapus-materi">
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
    
    <script>
		$.validate({
			modules : 'file'
		});
	</script>
	
    <?php
    echo $datatable;
    echo $validasi;
    echo $hapusdata;
    ?>
    
    <script>
	// assumes you're using jQuery
		$(document).ready(function() {
			$('.confirm').hide();
			<?php if($this->session->flashdata('notif')){ ?>
				$('.confirm').html(<?php echo $this->session->flashdata('notif'); ?>).show();
			});
		<?php } ?>
	</script>

</body>

</html>
