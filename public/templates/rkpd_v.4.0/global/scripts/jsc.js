    function load(page,div){
		$.ajax({
			url: site_url+page,
			success: function(response){
				$(div).html(response);
			},
		dataType:"html"
		});
		return false;
	}
		
	function totalAsumsi(){
		var apbd_kab 		= document.getElementById("apbd_kab").value || 0;
		var apbd_prov 		= document.getElementById("apbd_prov").value || 0;
		var apbn 			= document.getElementById("apbn").value || 0;
		var sumberlain 		= document.getElementById("sumberlain").value || 0;
		var hasil 			= parseInt(apbd_kab) + parseInt(apbd_prov)+ parseInt(apbn) + parseInt(sumberlain);
		document.getElementById("total_asumsi").value = tandaPemisahTitik(hasil);
	}
	
	function tandaPemisahTitik(b){
		var _minus = false;
		if (b<0) _minus = true;
		b = b.toString();
		b=b.replace(".","");
		b=b.replace("-","");
		c = "";
		panjang = b.length;
		j = 0;
		for (i = panjang; i > 0; i--){
			 j = j + 1;
			 if (((j % 3) == 1) && (j != 1)){
			   c = b.substr(i-1,1) + "." + c;
			 } else {
			   c = b.substr(i-1,1) + c;
			 }
		}
		if (_minus) c = "-" + c ;
		return c;
	}
	
	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
