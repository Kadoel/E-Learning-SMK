<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cari Materi</title>

   <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
     <!-- Custom Fonts -->
    <link href="<?= base_url('assets/font-awesome-4.3.0/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-4 col-lg-offset-4">
					<div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong>Form Cari Materi</strong>
                        </div>
                        <div class="panel-body">
							<?php
									$attform = array(
											'id' => 'form-cari',
											'role' => 'form'
										);
									echo form_open('cari', $attform);
									?>
										<div class="form-group">
											<label>Kelas</label>
											<select class="form-control" name="materi_kelas" data-validation="required" data-validation-error-msg="Silahkan Pilih Kelas" data-toggle="tooltip" data-placement="top" title="Pilih Kelas Sesuai Sasaran Materi">
												<?php
												echo'<option value="">-- Pilih Kelas --</option>';
												foreach($listKelas as $kls){
													echo '<option value="'.$kls->kelas_id.'"';
													echo '>'.$kls->kelas_nama.' '.$kls->jurusan_nama.' '.$kls->kelas_no.'</option>';
												}
												?>
											</select>
										</div>
										
										<div class="form-group">
											<label>Mat. Pelajaran</label>
											<select class="form-control" name="materi_pelajaran" data-validation="required" data-validation-error-msg="Silahkan Pilih Mata Pelajaran" data-toggle="tooltip" data-placement="top" title="Pilih Mata Pelajaran Sesuai Sasaran Materi">
												<?php
												echo'<option value="">-- Pilih Mat. Pelajaran --</option>';
												foreach($list_pelajaran as $pljr){
													echo '<option value="'.$pljr->pelajaran_id.'"';
													echo '>'.$pljr->pelajaran_nama.'</option>';
												}
												?>
											</select>
										</div>
										
										<div class="form-group">
											<label>Pengajar</label>
											<select class="form-control" name="materi_pengajar" data-validation="required" data-validation-error-msg="Silahkan Pilih Pengajar" data-toggle="tooltip" data-placement="top" title="Pilih Pengajar Sesuai Sasaran Materi">
												<?php
												echo'<option value="">-- Pilih Pengajar --</option>';
												foreach($list_pengajar as $png){
													echo '<option value="'.$png->pengajar_id.'"';
													echo '>'.$png->pengajar_nama.'</option>';
												}
												?>
											</select>
										</div>
										
										<?php 
										$attsubmit = array(
												'class'=>'btn btn-md btn-outline btn-primary',
												'id'=>'btn-cari',
												'name'=>'btn-cari',
												'type'=>'submit',
												'content'=>'<i class="fa fa-search"></i> Cari'); 
										echo form_button($attsubmit); 
										?>
									</form>
						</div><!-- /.panel-body -->
					</div><!-- /.panel -->
				</div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="<?= base_url('assets/js/jquery-1.11.0.js');?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url('assets/js/bootstrap.min.js');?>"></script>
   
    <script src="<?= base_url('assets/plugins/validasi/jquery.form-validator.js');?>"></script>
    
    <?= $validasi; ?>
    
    <script>
    // tooltip demo
    $('.form-group').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
    </script>
</body>

</html>
