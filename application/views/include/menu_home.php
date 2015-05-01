<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url();?>">E-Learning SMKN 1 Nusa Penida</a>
            </div>
            <!-- /.navbar-header -->
            
            <ul class="nav navbar-top-links navbar-right">
				<strong>Cari:</strong>
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-search fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <div class="row">
							<div class="col-lg-12">
								<div class="cari">
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
								</div>
							</div>
                        </div>
                    </ul><!-- /.dropdown-user -->
                </li><!-- /.dropdown -->
            </ul><!-- /.navbar-top-links -->
            
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="fa fa-university fa-fw"></i> Kelas X<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php
								foreach($listKelas as $kls){
									if($kls->kelas_nama == "X"){
										if($kls->kelas_no ==""){
											echo '<li>
												<a href="'.base_url('kelas/'.strtolower($kls->kelas_nama).'_'.$kls->jurusan_slug).'"><i class="fa fa-bars fa-fw"></i> '.$kls->jurusan_nama.' '.$kls->kelas_no.'</a>
											</li>';
										}
										else{
											echo '<li>
												<a href="'.base_url('kelas/'.strtolower($kls->kelas_nama).'_'.$kls->jurusan_slug.'_'.$kls->kelas_no).'"><i class="fa fa-bars fa-fw"></i> '.$kls->jurusan_nama.' '.$kls->kelas_no.'</a>
											</li>';
										}
									}
								}
								?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-university fa-fw"></i> Kelas XI<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php
								foreach($listKelas as $kls){
									if($kls->kelas_nama == "XI"){
										if($kls->kelas_no ==""){
											echo '<li>
												<a href="'.base_url('kelas/'.strtolower($kls->kelas_nama).'_'.$kls->jurusan_slug).'"><i class="fa fa-bars fa-fw"></i> '.$kls->jurusan_nama.' '.$kls->kelas_no.'</a>
											</li>';
										}
										else{
											echo '<li>
												<a href="'.base_url('kelas/'.strtolower($kls->kelas_nama).'_'.$kls->jurusan_slug.'_'.$kls->kelas_no).'"><i class="fa fa-bars fa-fw"></i> '.$kls->jurusan_nama.' '.$kls->kelas_no.'</a>
											</li>';
										}
									}
								}
								?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-university fa-fw"></i> Kelas XII<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               <?php
								foreach($listKelas as $kls){
									if($kls->kelas_nama == "XII"){
										if($kls->kelas_no ==""){
											echo '<li>
												<a href="'.base_url('kelas/'.strtolower($kls->kelas_nama).'_'.$kls->jurusan_slug).'"><i class="fa fa-bars fa-fw"></i> '.$kls->jurusan_nama.' '.$kls->kelas_no.'</a>
											</li>';
										}
										else{
											echo '<li>
												<a href="'.base_url('kelas/'.strtolower($kls->kelas_nama).'_'.$kls->jurusan_slug.'_'.$kls->kelas_no).'"><i class="fa fa-bars fa-fw"></i> '.$kls->jurusan_nama.' '.$kls->kelas_no.'</a>
											</li>';
										}
									}
								}
								?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
