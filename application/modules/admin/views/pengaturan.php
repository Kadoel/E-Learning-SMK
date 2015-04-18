<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pengaturan</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?= base_url('assets/css/plugins/metisMenu/metisMenu.min.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/sb-admin-2.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= base_url('assets/font-awesome-4.1.0/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
    
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
                    <h1 class="page-header">Pengaturan</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <strong>Form Pengaturan</strong>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
									<span id="warning"></span>
                                    <?php
									$attform = array(
											'id' => 'form-pengaturan',
											'role' => 'form'
									);
									echo form_open('admin/pengaturan/act_pengaturan', $attform);
									?>
                                        <div class="form-group">
                                            <label>Semester</label>
                                            <select class="form-control" name="semester">
												<?php
												$semester = array('Ganjil', 'Genap');
												foreach($semester as $smt){
													echo '<option value="'.$smt.'"';
														if($smt == $smester){
															echo ' selected';
														}
													echo '>'.$smt.'</option>';
													echo form_error('semester');
												}
												?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Tahun Ajaran</label>
                                            <select class="form-control" name="thnajaran">
												<?php
												$th = date('Y'); 
												$th1 =  date('Y', strtotime('-1 year', strtotime($th))).'/'.$th;
												$th2 = $th.'/'.date('Y', strtotime('+1 year', strtotime($th)));
												$th3 = date('Y', strtotime('+1 year', strtotime($th))).'/'.date('Y', strtotime('+2 year', strtotime($th)));
												$thn = array($th1, $th2, $th3);
												foreach($thn as $tahun){
													echo '<option value="'.$tahun.'"';
														if($tahun == $thnajaran){
															echo ' selected';
														}
													echo '>'.$tahun.'</option>';
													echo form_error('thnajaran');
												}
												?>
                                            </select>
                                        </div>
                                        <?php 
										$attsubmit = array(
												'class'=>'btn btn-md btn-success',
												'id'=>'btn-pengaturan',
												'name'=>'btn-pengaturan',
												'type'=>'submit',
												'content'=>'Update'); 
										echo form_button($attsubmit); 
										?>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
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
    
    <?= $kirim; ?>
Page rendered in <strong>{elapsed_time}</strong> seconds.
</body>

</html>

