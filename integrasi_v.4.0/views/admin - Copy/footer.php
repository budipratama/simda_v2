    <!-- Jquery Core Js -->
    <script src="<?php echo base_url('public/templates/integrasi_v.4.0/plugins/jquery/jquery.min.js');?>"></script>
    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url('public/templates/integrasi_v.4.0/plugins/bootstrap/js/bootstrap.js');?>"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url('public/templates/integrasi_v.4.0/plugins/node-waves/waves.js');?>"></script>
    <!-- Custom Js -->
    <script src="<?php echo base_url('public/templates/integrasi_v.4.0/js/admin.js');?>"></script>

	

	
	

    <!-- Slimscroll Plugin tooltips Js -->
<!-- tooltips <script src="<?php echo base_url('public/templates/integrasi_v.4.0/js/pages/ui/tooltips-popovers.js');?>"></script> -->

	
	
	
	
    <!-- Bootstrap Notify Plugin Js -->
    <script src="<?php echo base_url('public/templates/integrasi_v.4.0/plugins/bootstrap-notify/bootstrap-notify.js');?>"></script>
    <script src="<?php echo base_url('public/templates/integrasi_v.4.0/js/pages/ui/notifications.js');?>"></script>
	
    <!-- SweetAlert Plugin Js -->
    <script src="<?php echo base_url('public/templates/integrasi_v.4.0/plugins/sweetalert/sweetalert.min.js');?>"></script>
	<script src="<?php echo base_url('public/templates/integrasi_v.4.0/js/pages/ui/dialogs.js');?>"></script>
	
	<!-- Modals Plugin Js -->
	<!-- <script src="<?php echo base_url('public/templates/integrasi_v.4.0/js/pages/ui/modals.js');?>"></script> -->
	
	<!-- Select Plugin Js -->
    <script src="<?php echo base_url('public/templates/integrasi_v.4.0/plugins/bootstrap-select/js/bootstrap-select.js');?>"></script>
	
	
	
	
	<!-- Form Validasi -->
	<script src="<?php echo base_url('public/templates/integrasi_v.4.0/plugins/jquery-validation/jquery.validate.js');?>"></script>
    <script src="<?php echo base_url('public/templates/integrasi_v.4.0/js/pages/forms/form-validation.js');?>"></script>
	
	
	
	
<!-- DATA MULTI LEVEL -->
<script src="<?php echo base_url('public/templates/rkpd_v.4.0/global/scripts/jsc.js');?>" type="text/javascript"></script>

<!-- DATA TABLEs -->
<!-- tooltips -->
<script src="<?php echo base_url('public/templates/rkpd_v.4.0/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js');?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url('public/templates/rkpd_v.4.0/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/templates/rkpd_v.4.0/global/plugins/jquery.input-ip-address-control-1.0.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/templates/rkpd_v.4.0/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/templates/rkpd_v.4.0/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/templates/rkpd_v.4.0/global/plugins/typeahead/handlebars.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/templates/rkpd_v.4.0/global/plugins/typeahead/typeahead.bundle.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/templates/rkpd_v.4.0/global/plugins/select2/select2.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/templates/rkpd_v.4.0/global/plugins/datatables/media/js/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/templates/rkpd_v.4.0/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js');?>"></script>

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script> var site_url = "<?php echo site_url();?>"; </script>
<script src="<?php echo base_url('public/templates/rkpd_v.4.0/global/scripts/metronic.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('public/templates/rkpd_v.4.0/admin/layout/scripts/layout.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('public/templates/rkpd_v.4.0/admin/layout/scripts/quick-sidebar.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('public/templates/rkpd_v.4.0/admin/layout/scripts/demo.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('public/templates/rkpd_v.4.0/admin/pages/scripts/index.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('public/templates/rkpd_v.4.0/admin/pages/scripts/tasks.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('public/templates/rkpd_v.4.0/admin/pages/scripts/table-advanced.js');?>"></script>
<script src="<?php echo base_url('public/templates/rkpd_v.4.0/admin/pages/scripts/form-samples.js');?>"></script>
<script src="<?php echo base_url('public/templates/rkpd_v.4.0/admin/pages/scripts/components-form-tools.js');?>"></script>
<script src="<?php echo base_url('public/templates/rkpd_v.4.0/admin/pages/scripts/ui-confirmations.js');?>"></script>
<script src="<?php echo base_url('public/templates/rkpd_v.4.0/admin/pages/scripts/components-pickers.js');?>"></script>




<script>
$(document).ready(function() {
	<?php for($i=0;$i<6;$i++){?>
	$("#photo<?php echo $i; ?>").on("change", function()
	{	
		var files = !!this.files ? this.files : [];
		if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
		
		if (/^image/.test( files[0].type)){ // only image file
			var reader = new FileReader(); // instance of the FileReader
			reader.readAsDataURL(files[0]); // read the local file
			reader.onloadend = function(){ // set image data as background of div
				document.getElementById('photo-preview<?php echo $i; ?>').style.display = "block";
				document.getElementById('img-preview<?php echo $i; ?>').src=this.result;
				document.getElementById('action-preview<?php echo $i; ?>').style.display = "block";
			}
		}
	});
	
	$("#cancel-upload<?php echo $i; ?>").click(function() {
		document.getElementById('img-preview<?php echo $i; ?>').src = "";
		document.getElementById('photo<?php echo $i; ?>').value = "";
		document.getElementById('photo-preview<?php echo $i; ?>').style.display = "none";
		document.getElementById('action-preview<?php echo $i; ?>').style.display = "none";
	});
	<?php } ?>
	
	$("#btn-save-coord").click(function() {
		document.getElementById('latlong').value = document.getElementById('latitudelongitude').value;
	});
});
</script>

<!-- END PAGE LEVEL SCRIPTS -->
<script>
var site_url = "<?php echo site_url();?>";
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   QuickSidebar.init(); // init quick sidebar
   Demo.init(); // init demo features 
   Index.init();   
   Index.initDashboardDaterange();
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
   Index.initCharts(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Tasks.initDashboardWidget();
   ComponentsPickers.init();
   FormSamples.init();
   ComponentsFormTools.init();
   UIConfirmations.init();
   TableAdvanced.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-61000838-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- END BODY -->













<!-- BEGIN Peta Form-->
<?php 
$koordinat_ = "-6.364551, 107.172446";
if (isset($koordinat)){
	if ($koordinat != 0 && $koordinat != ""){
		$koordinat_ = $koordinat;
	}
}

?>
<!-- Peta Google-->
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script>
	var var_map;
	var var_location = new google.maps.LatLng(<?php echo $koordinat_; ?>);
	var var_infowindow;
	var var_marker;
	var new_latlong;
	
	function map_init() {
		
		var var_mapoptions = {
			center: var_location,
			zoom: 12,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			mapTypeControl: true,
			panControl:false,
			rotateControl:false,
			streetViewControl: false,
		};
		var_map = new google.maps.Map(document.getElementById("map-container"), var_mapoptions);
		
		var_marker = new google.maps.Marker({
            position: var_location,
            map: var_map
        });
		
		var_infowindow = new google.maps.InfoWindow({
            content: ""
        });

		google.maps.event.addListener(var_map, 'click', function(event) {
			var_marker.setPosition(event.latLng);
			var yeri = event.latLng;
			var latlongi = "(" + yeri.lat().toFixed(6) + " , " + yeri.lng().toFixed(6) + ")";
			var_infowindow.setContent(latlongi);
			new_latlong = yeri.lat().toFixed(6)+ ", " +yeri.lng().toFixed(6);
		});	
	}
 
	google.maps.event.addDomListener(window, 'load', map_init);

	//start of modal google map
	$('#mapmodals').on('shown.bs.modal', function () {
		google.maps.event.trigger(var_map, "resize"); 
		var_map.setCenter(var_location);
	});
	
	$('#simpan_lokasi').click(function(){ 
		document.getElementById('koordinat').value = new_latlong;	
	});
</script>
<!-- END Peta Form-->


<!-- BEGIN Peta home-->
<?php if ($this->uri->segment(3) == 'peta'){?>
<?php 
$usulan_ = "-6.364551, 107.172446";
if (isset($usulan)){
	if ($usulan != 0 && $usulan != ""){
		$usulan_ = $usulan;
	}
}

?>
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
	<script type="text/javascript">
	  var locations = [
			<?php if ($usulan){
				foreach($usulan as $row){
				?>
				["<div style=\"width:260px; height:90px; font-size: 12px; color:#000; font-weight: normal;\"><div style=\"height:15px; width:260px; float:left; font-size:12px; color:#555555; font-weight: normal;\">Nama Kegiatan :</div><div style=\"height:25px; width:260px; float:left; font-size:14px; font-weight: normal;\"><?php echo $row->kegiatan; ?></div><div style=\"height:15px; width:260px; float:left; font-size:12px; color:#555555; font-weight: normal;\">Alamat :</div><div style=\"height:20px; width:260px; float:left; font-size:14px; font-weight: normal;\"><?php echo $row->alamat.' '.$row->rt.'/'.$row->rw.' '.$row->nama_deskel.', '.$row->nama_kecamatan; ?></div></div>", <?php echo $row->koordinat; ?>, 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'],
				<?php 
				}
			} ?>
	  	  ];

	  var map = new google.maps.Map(document.getElementById('map-usulan'), {
		zoom: 11,
		center: new google.maps.LatLng(-6.364551, 107.172446),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	  });

	  var infowindow = new google.maps.InfoWindow();

	  var marker, i;

	  for (i = 0; i < locations.length; i++) {  
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(locations[i][1], locations[i][2]),
			map: map,
			icon: locations[i][3]
		});

		google.maps.event.addListener(marker, 'click', (function(marker, i) {
		  return function() {
			infowindow.setContent(locations[i][0]);
			infowindow.open(map, marker);
		  }
		})(marker, i));
	  }
	  
	</script>
<?php } ?>
<!-- END Peta home-->

</body>
<!-- END BODY -->
</html>
</html>