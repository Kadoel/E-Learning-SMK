<?php
	class MY_Handle{
		function validasi($idform){
			$validasi = "<script>
				$.validate({
					  form : '#".$idform."'
					});
			</script>";
			
			return $validasi;
		}

		function kirimdata($idbutton, $idform, $iddiv){
			$kirim = '<script type="text/javascript">
				$("#'.$idbutton.'").click(function(){
					$.post(	$("#'.$idform.'").attr("action"), 
							$("#'.$idform.'").serializeArray(), 
							function(info){
								$("#'.$iddiv.'").html(info);
					});
				});
				
				$("#'.$idform.'").submit(function(){
					return false;
				});
			</script>';
			
			return $kirim;
		}
		
		function datatable($idtable, $row){
			$datatable = '<script type="text/javascript">
					$("#'.$idtable.'").dataTable( {
						"aLengthMenu": [['.$row.', 10, 25, 50, -1], ['.$row.', 10, 25, 50, "All"]],
						"iDisplayLength" : '.$row.',
					} );
				</script>';
			
			return $datatable;
		}
		
		function hapusdata($class){
			$hapusdata = '<script type="text/javascript">
					$(".'.$class.'").on("click", function(e){
						e.preventDefault();
						var href = this.href;
						alertify.confirm("Apakah Anda Yakin ?", function (e) {
						if (e) {
							window.location.href = href;
						}
						});
					});
				</script>';
			return $hapusdata;
		}
	}
?>
