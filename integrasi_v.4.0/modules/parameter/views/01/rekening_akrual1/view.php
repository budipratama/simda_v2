<!-- Main Content -->
<div class="container-fluid">
<div class="side-body padding-top">
	<h3 class="page-title">Parameter <small> rekening</small></h3>		
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
					<li class="active"><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/rekening');?>"> Rekening</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/rekening');?>"> Jenis</a></li>
				</ol>
				</div>
			</div>
		</div>	
			<!-- END PAGE HEADER-->
			<div class="clearfix"></div>
			<?php echo validation_errors(); ?>
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
			<div class="row">
			<div class="col-md-12">
            <div class="panel panel-primary">
				<div class="panel-heading"><i class="fa fa-bars"></i> Rekening</div>
				<div class="panel-body">
				<div class="portlet-body" style="display: block;">
					<a href="<?php echo site_url('parameter/rekening/addj');?>" class="icon-btn"><i class="fa fa-plus"></i><div>Jenis</div></a>
					</div>							
				</div>
				<div class="panel-body">				
				<!-- BEGIN FORM -->				

				<h3>My Latest Lists</h3>
				
<table class="table table-striped table-bordered table-hover">
    <tr>
        <th style="width:25px">List Name</th>
        <th style="text-align:center; width:60px">Actions</th>
    </tr>
	<?php foreach($open_tasks as $task) : ?>
    <tr>
        <td><?php echo $task->akrual_nama; ?></td>
        <td><a href="<?php echo base_url(); ?>lists/show/<?php echo $list->id; ?>">View List</a></td>
    </tr>
    <?php endforeach; ?>
</table>				
				
<h4> Current Open Tasks</h4>
<?php if($open_tasks) : ?>
    <ul>
    <?php foreach($open_tasks as $task) : ?>
        <li><a href="<?php echo base_url(); ?>tasks/show/<?php echo $task->task_id; ?>"><?php echo $task->akrual_nama; ?></a></li>
    <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>There are no current tasks</p>
<?php endif; ?>
<br />
<h4> Recently Completed</h4>
<?php if($close_tasks) : ?>
    <ul>
    <?php foreach($close_tasks as $task) : ?>
        <li><a href="<?php echo base_url(); ?>tasks/show/<?php echo $task->task_id; ?>"><?php echo $task->akrual_nama; ?></a></li>
    <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>There are no current tasks</p>
<?php endif; ?>
<hr />
				
				<!-- END FORM-->
				</div>
			</div>
			</div>
			</div>

			<!-- END SAMPLE TABLE PORTLET-->
</div>
<!-- END CONTENT -->
	<script>
	var ajax_source_url = '<?php echo site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/jenisv'); ?>';
	var ajax_source_field =	  [ { "data": "nomor" }, { "data": "nama_akun" }, { "data": "nama_kelompok" }, { "data": "jenis_nama" }, { "data": "Actions" } ];
	
	function show_form_akun_by_kelompok(){
		var aaa_kode = $('select[name=aaa_kode]').val();
		load('parameter/rekening/tampil_combobox_akun_by_kelompok/'+aaa_kode, '#tampil_combobox_akun_by_kelompok');
	}
	
	function show_form_kelompok_by_jenis(){
		var bbb_kode = $('select[name=bbb_kode]').val();
		load('parameter/rekening/tampil_combobox_kelompok_by_jenis/'+bbb_kode, '#tampil_combobox_kelompok_by_jenis');
	}
	
	function show_form_jenis_by_obyek(){
		var ccc_kode = $('select[name=ccc_kode]').val();
		load('parameter/rekening/tampil_combobox_jenis_by_obyek/'+ccc_kode, '#tampil_combobox_jenis_by_obyek');
	}
	
	function show_form_obyek_by_rincian(){
		var ddd_kode = $('select[name=ddd_kode]').val();
		load('parameter/rekening/tampil_combobox_obyek_by_rincian/'+ddd_kode, '#tampil_combobox_obyek_by_rincian');
	}
	</script>