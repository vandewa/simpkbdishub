jQuery(function($) {
	$("#jenis_uji").on("select2:select",function(e){
		if( ($(this).val()==="Numpang Masuk") || ($(this).val()==="Mutasi Masuk")){
			$('#form_jenis_pendaftaran').empty();
			$("#form_jenis_pendaftaran").load("<?php echo base_url('pendaftaran/uji_masuk');?>");
		} else if($(this).val()==="Numpang Keluar"){
			$('#form_jenis_pendaftaran').empty();
			$("#form_jenis_pendaftaran").load("<?php echo base_url('pendaftaran/uji_numpang');?>");
		} else if($(this).val()==="Mutasi Keluar"){
			$('#form_jenis_pendaftaran').empty();
			$("#form_jenis_pendaftaran").load("<?php echo base_url('pendaftaran/uji_mutasi');?>");
		} else if($(this).val()==="Kehilangan"){
			$('#form_jenis_pendaftaran').empty();
			$("#form_jenis_pendaftaran").load("<?php echo base_url('pendaftaran/uji_kehilangan');?>");
		} else {
			$('#form_jenis_pendaftaran').empty();
		}
	});
});