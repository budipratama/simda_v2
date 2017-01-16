<script src="<?php echo base_url('public/01/jquery/jquery-2.1.4.min.js')?>"></script>
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
            <div class="panel panel-success">
				<div style="font-size:20pt" class="panel-heading"><i class="fa fa-bars"></i> Rekening</div>	
				<div class="panel-body">				
				<!-- BEGIN FORM -->
				<div class="container">
						<button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Add Person</button>
						<button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
						<br/><br/>
						<table id="table" class="table table-hover table-bordered">
							<thead>
								<tr>
								<th style="width:50px;">No</th>
								<th style="width:50px;">Akun</th>
								<th style="width:50px;">Kelompok</th>
								<th>Jenis</th>
								<th style="width:80px;"><center>Action</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
				</div>
				<!-- END FORM-->
				<div class="form-group">
						<div class="col-md-offset-8 col-md-8">
							<a href="<?php echo site_url('parameter/rekening/add');?>" class="btn green"><i class="fa fa-plus"></i> Data</a>
							<a href="<?php echo site_url('parameter');?>" class="btn default"><i class="fa fa-reply"></i> Kembali</a>
						</div>
					</div>
				</div>
			</div>
			</div>
			</div>
			<!-- END SAMPLE TABLE PORTLET-->
</div>
<!-- END CONTENT -->
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Akun</label>
                            <div class="col-md-5">
								<input name="rekening_akun" placeholder="<?php echo $rekening_akun;?>" class="form-control" type="text" readonly="readonly">	
								<span class="help-block"></span>
                            </div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Kelompok</label>
                            <div class="col-md-5">
                                <input name="rekening_kelompok" placeholder="<?php echo $rekening_kelompok;?>" class="form-control" type="text" readonly="readonly">								
                                <span class="help-block"></span>
                            </div>
						</div>                       
                        <div class="form-group">
                            <label class="control-label col-md-3">Jenis</label>
                            <div class="col-md-7">
                                <input name="rekening_jenis" placeholder="Masukan Jenis ..." class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
	<script type="text/javascript">
var save_method; //for save method string
var table;

$(document).ready(function() {
    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": { "url": "<?php echo site_url('parameter/rekening/ajax_list')?>", "type": "POST" },

        //Set column definition initialisation properties.
        "columnDefs": [ { "targets": [ -1 ], //last column
		"orderable": false, //set not orderable
		}, ],
    });

    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });
});

function add_person() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
}

function edit_person(id) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('parameter/rekening/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {			
            $('[name="id"]').val(data.id);
            $('[name="rekening_akun"]').val(data.rekening_akun);
            $('[name="rekening_kelompok"]').val(data.rekening_kelompok);
            $('[name="rekening_jenis"]').val(data.rekening_jenis);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        { alert('Error get data from ajax'); }
    });
}

function reload_table() {
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save() {
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('parameter/rekening/ajax_add')?>";
    } else {
        url = "<?php echo site_url('parameter/rekening/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            { $('#modal_form').modal('hide'); reload_table(); }

            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        }
    });
}

function delete_person(id) {
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('parameter/rekening/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            { alert('Error deleting data'); }
        });
    }
}
</script>