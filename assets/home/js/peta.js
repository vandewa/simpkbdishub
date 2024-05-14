$(document).ready(function(){
	
	// PETA DASAR
	$("#map_kecamatan").change(function(){
		if($(this).is(':checked')) { 
			kecamatan();
		}else{
			kecamatan_grobogan.setMap(null);
		}
	});
	
	$("#map_desa").change(function(){
		if($(this).is(':checked')) { 
			desa();
		}else{
			desa_grobogan.setMap(null);
		}
	});
	
	$("#map_kantor_kelurahan").change(function(){
		if($(this).is(':checked')) { 
			kantor_kelurahan();
		}else{
			kantor_kelurahan_grobogan.setMap(null);
		}
	});
	
	$("#map_jaringan_jalan").change(function(){
		if($(this).is(':checked')) { 
			jaringan_jalan();
		}else{
			jalan_kolektor_grobogan.setMap(null);
			jalan_lokal_grobogan.setMap(null);
			jalan_kereta_api_grobogan.setMap(null);
		}
	});
	
	$("#map_jaringan_sungai").change(function(){
		if($(this).is(':checked')) { 
			jaringan_sungai();
		}else{
			jaringan_sungai_satu_garis_grobogan.setMap(null);
			jaringan_sungai_dua_garis_grobogan.setMap(null);
		}
	});
	
	
	//PETA TEMATIK
	$("#map_curah_hujan").change(function(){
		if($(this).is(':checked')) { 
			curah_hujan();
		}else{
			curah_hujan_grobogan.setMap(null);
		}
	});
	
	$("#map_aliran_sungai").change(function(){
		if($(this).is(':checked')) { 
			aliran_sungai();
		}else{
			aliran_sungai_grobogan.setMap(null);
		}
	});
	
	$("#map_geologi").change(function(){
		if($(this).is(':checked')) { 
			geologi();
		}else{
			geologi_grobogan.setMap(null);
		}
	});
	
	$("#map_hidrologi").change(function(){
		if($(this).is(':checked')) { 
			hidrologi();
		}else{
			hidrologi_grobogan.setMap(null);
		}
	});
	
	$("#map_jenis_tanah").change(function(){
		if($(this).is(':checked')) { 
			jenis_tanah();
		}else{
			jenis_tanah_grobogan.setMap(null);
		}
	});
	
	$("#map_kawasan_hutan").change(function(){
		if($(this).is(':checked')) { 
			kawasan_hutan();
		}else{
			kawasan_hutan_grobogan.setMap(null);
		}
	});
	
	$("#map_kawasan_pertambangan").change(function(){
		if($(this).is(':checked')) { 
			kawasan_pertambangan();
		}else{
			kawasan_pertambangan_grobogan.setMap(null);
		}
	});
	
	$("#map_kepadatan_penduduk").change(function(){
		if($(this).is(':checked')) { 
			kepadatan_penduduk();
		}else{
			kepadatan_penduduk_grobogan.setMap(null);
		}
	});
	
	$("#map_penggunaan_lahan").change(function(){
		if($(this).is(':checked')) { 
			penggunaan_lahan();
		}else{
			penggunaan_lahan1_grobogan.setMap(null);
			penggunaan_lahan2_grobogan.setMap(null);
			penggunaan_lahan3_grobogan.setMap(null);
			penggunaan_lahan4_grobogan.setMap(null);
			penggunaan_lahan5_grobogan.setMap(null);
		}
	});
	
	$("#map_rawan_bencana").change(function(){
		if($(this).is(':checked')) { 
			rawan_bencana();
		}else{
			rawan_bencana1_grobogan.setMap(null);
			rawan_bencana2_grobogan.setMap(null);
		}
	});	
	
	// PETA POLA RUANG
	
	$("#map_pola_ruang").change(function(){
		if($(this).is(':checked')) { 
			polaruang();
		}else{
			polaruang1_grobogan.setMap(null);
			polaruang2_grobogan.setMap(null);
			//polaruang3_grobogan.setMap(null);
			polaruang4_grobogan.setMap(null);
			polaruang5_grobogan.setMap(null);
			//polaruang6_grobogan.setMap(null);
			//polaruang7_grobogan.setMap(null);
		}
	});
	
	$("#map_kawasan_strategis").change(function(){
		if($(this).is(':checked')) { 
			kawasan_strategis();
		}else{
			kawasan_strategis_grobogan.setMap(null);
		}
	});
	
	// PETA STRUKTUR RUANG
	
	$("#map_jaringan_transportasi").change(function(){
		if($(this).is(':checked')) { 
			jaringan_transportasi();
		}else{
			jaringan_angkutan_umum_grobogan.setMap(null);
			jaringan_jalur_kereta_grobogan.setMap(null);
			jaringan_terminal_grobogan.setMap(null);
		}
	});
	
	$("#map_jaringan_telekomunikasi").change(function(){
		if($(this).is(':checked')) { 
			jaringan_telekomunikasi();
		}else{
			jaringan_telekomunikasi_grobogan.setMap(null);
		}
	});
	
	$("#map_jaringan_listrik").change(function(){
		if($(this).is(':checked')) { 
			jaringan_listrik();
		}else{
			jaringan_listrik1_grobogan.setMap(null);
			jaringan_listrik2_grobogan.setMap(null);
			jaringan_listrik3_grobogan.setMap(null);
			jaringan_listrik4_grobogan.setMap(null);
		}
	});
	
	$("#map_jaringan_sda").change(function(){
		if($(this).is(':checked')) { 
			jaringan_sda();
		}else{
			jaringan_bendungan_grobogan.setMap(null);
			jaringan_saluran_sda_grobogan.setMap(null);
		}
	});
	
	$("#map_jaringan_prasarana_lain").change(function(){
		if($(this).is(':checked')) { 
			jaringan_prasarana_lain();
		}else{
			jaringan_prasarana_lain_grobogan.setMap(null);
			/*
			jaringan_iplt_grobogan.setMap(null);
			jaringan_tpa_grobogan.setMap(null);
			*/
		}
	});
});

//PETA DASAR
function kecamatan(){
	kecamatan_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/dasar/administrasi_kecamatan.kmz',
		map: map,
		preserveViewport: true,
	});
}

function desa(){
	desa_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/dasar/administrasi_kelurahan.kmz',
		map: map,
		preserveViewport: true,
	});
}

function kantor_kelurahan(){
	kantor_kelurahan_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/dasar/kantor_kelurahan.kmz',
		map: map,
		preserveViewport: true,
	});
}

function jaringan_jalan(){
	jalan_kolektor_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/dasar/jalan/jalan_kolektor.kmz',
		map: map,
		preserveViewport: true,
	});

	jalan_lokal_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/dasar/jalan/jaringan_jalan_lokal.kmz',
		map: map,
		preserveViewport: true,
	});
	
	jalan_kereta_api_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/dasar/jalan/jalan_kereta.kmz',
		map: map,
		preserveViewport: true,
	});
}

function jaringan_sungai(){
	jaringan_sungai_satu_garis_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/dasar/sungai/satu_garis.kmz',
		map: map,
		preserveViewport: true,
	});
	jaringan_sungai_dua_garis_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/dasar/sungai/dua_garis.kmz',
		map: map,
		preserveViewport: true,
	});
}


//PETA TEMATIK

function curah_hujan(){
	curah_hujan_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/tematik/curahhujan.kmz',
		map: map,
		preserveViewport: true,
	});
}

function aliran_sungai(){
	aliran_sungai_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/tematik/das.kmz',
		map: map,
		preserveViewport: true,
	});
}

function geologi(){
	geologi_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/tematik/geologi.kmz',
		map: map,
		preserveViewport: true,
	});
}

function hidrologi(){
	hidrologi_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/tematik/hidrologi.kmz',
		map: map,
		preserveViewport: true,
	});
}

function jenis_tanah(){
	jenis_tanah_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/tematik/tanah.kmz',
		map: map,
		preserveViewport: true,
	});
}

function kawasan_hutan(){
	kawasan_hutan_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/tematik/kawasan_hutan.kmz',
		map: map,
		preserveViewport: true,
	});
}

function kawasan_pertambangan(){
	kawasan_pertambangan_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/tematik/pertambangan.kmz',
		map: map,
		preserveViewport: true,
	});
}

function kepadatan_penduduk(){
	kepadatan_penduduk_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/tematik/kepadatan_penduduk.kmz',
		map: map,
		preserveViewport: true,
	});
}

function rawan_bencana(){
	rawan_bencana1_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/tematik/rawan_bencana.kmz',
		map: map,
		preserveViewport: true,
	});
	
	rawan_bencana2_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/tematik/rawan_bencana2.kmz',
		map: map,
		preserveViewport: true,
	});
}

function penggunaan_lahan(){
	penggunaan_lahan1_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/tematik/penggunaan_lahan/lahan1.kmz',
		map: map,
		preserveViewport: true,
	});
	penggunaan_lahan2_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/tematik/penggunaan_lahan/lahan2.kmz',
		map: map,
		preserveViewport: true,
	});
	penggunaan_lahan3_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/tematik/penggunaan_lahan/lahan3.kmz',
		map: map,
		preserveViewport: true,
	});
	penggunaan_lahan4_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/tematik/penggunaan_lahan/lahan4.kmz',
		map: map,
		preserveViewport: true,
	});
	penggunaan_lahan5_grobogan = new google.maps.KmlLayer({
		url: 'https://siprgrobogan.duamedia.net/upload/peta/tematik/penggunaan_lahan/lahan5.kmz',
		map: map,
		preserveViewport: true,
	});
}

// POLA RUANG

function polaruang(){
	polaruang1_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/pola/pola1.kmz',
		map: map,
		preserveViewport: true,
	});
	
	polaruang2_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/pola/pola2.kmz',
		map: map,
		preserveViewport: true,
	});
	
	/*
	polaruang3_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/pola/pola3.kmz',
		map: map,
		preserveViewport: true,
	});
	*/
	
	polaruang4_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/pola/pola4.kmz',
		map: map,
		preserveViewport: true,
	});
	
	polaruang5_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/pola/pola5.kmz',
		map: map,
		preserveViewport: true,
	});
	
	/*
	polaruang6_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/pola/pola6.kmz',
		map: map,
		preserveViewport: true,
	});
	
	polaruang7_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/pola/pola7.kmz',
		map: map,
		preserveViewport: true,
	});
	*/
}

function kawasan_strategis(){
	kawasan_strategis_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/pola/kawasan_strategis.kmz',
		map: map,
		preserveViewport: true,
	});
}

// PETA STRUKTUR RUANG
function jaringan_transportasi(){
	jaringan_angkutan_umum_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/struktur/transportasi/angkutan_umum.kmz',
		map: map,
		preserveViewport: true,
	});
	jaringan_jalur_kereta_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/struktur/transportasi/jalur_kereta.kmz',
		map: map,
		preserveViewport: true,
	});
	jaringan_terminal_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/struktur/transportasi/terminal.kmz',
		map: map,
		preserveViewport: true,
	});
}

function jaringan_telekomunikasi(){
	jaringan_telekomunikasi_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/struktur/BTS.kmz',
		map: map,
		preserveViewport: true,
	});
}

function jaringan_listrik(){
	jaringan_listrik1_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/struktur/listrik/1.kmz',
		map: map,
		preserveViewport: true,
	});
	jaringan_listrik2_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/struktur/listrik/2.kmz',
		map: map,
		preserveViewport: true,
	});
	jaringan_listrik3_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/struktur/listrik/3.kmz',
		map: map,
		preserveViewport: true,
	});
	jaringan_listrik4_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/struktur/listrik/4.kmz',
		map: map,
		preserveViewport: true,
	});
}

function jaringan_sda(){
	jaringan_bendungan_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/struktur/sda/bendungan.kmz',
		map: map,
		preserveViewport: true,
	});
	jaringan_saluran_sda_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/struktur/sda/saluran_sda.kmz',
		map: map,
		preserveViewport: true,
	});
}

function jaringan_prasarana_lain(){
	jaringan_prasarana_lain_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/struktur/prasarana_lain.kmz',
		map: map,
		preserveViewport: true,
	});
	/*
	jaringan_iplt_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/struktur/prasaranalain/iplt.kmz',
		map: map,
		preserveViewport: true,
	});
	jaringan_tpa_grobogan = new google.maps.KmlLayer({
		url: 'http://siprgrobogan.duamedia.net/upload/peta/struktur/prasaranalain/tpa.kmz',
		map: map,
		preserveViewport: true,
	});
	*/
}

function updateKoordinat(newLat, newLng)
{
	$('#lat').val(newLat);
	$('#lat_lokasi').val(newLat);
	$('#lng').val(newLng);
	$('#long_lokasi').val(newLng);
}