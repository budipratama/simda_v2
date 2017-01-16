<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Learn PHP CodeIgniter Framework with AJAX and Bootstrap</title>
  </head>
  <body>


  <div class="container">
    <h1>Learn PHP CodeIgniter Framework with AJAX and Bootstrap</h1>
</center>
    <h3>Book Store</h3>
    <br />
    <button class="btn btn-success" onclick="add_book()"><i class="glyphicon glyphicon-plus"></i> Add Book</button>
    <br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
					<th>ID</th>
					<th>No</th>
					<th>Nama</th>
					<th>Saldo</th>

          <th style="width:125px;">Action
          </p></th>
        </tr>
      </thead>
      <tbody>
				<?php foreach($books as $book){?>
				     <tr>
				         <td><?php echo $book->kode;?></td>
				         <td><?php echo $book->no;?></td>
				         <td><?php echo $book->nm_rek_3;?></td>
				         <td><?php echo $book->saldo_normal;?></td>
								<td>
									<button class="btn btn-warning" onclick="edit_book(<?php echo $book->kode;?>)"><i class="glyphicon glyphicon-pencil"></i></button>
								</td>
				      </tr>
				<?php }?>
      </tbody>

      <tfoot>
        <tr>
			<th>ID</th>
			<th>No</th>
			<th>Nama</th>
			<th>Saldo</th>
			<th>Action</th>
        </tr>
      </tfoot>
    </table>
  </div>

  <script src="<?php echo base_url('public/assests/jquery/jquery-3.1.0.min.js')?>"></script>
  <script type="text/javascript">
  $(document).ready( function () {
      $('#table_id').DataTable();
  } );
    var save_method; //for save method string
    var table;


    function add_book()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function edit_book(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('parameter/book/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="kode"]').val(data.kode);
            $('[name="ccc_kode"]').val(data.no);
            $('[name="ddd_kode"]').val(data.nm_rek_3);
            $('[name="eee_kode"]').val(data.saldo_normal);			
			
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Book'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }



    function save()
    {
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('parameter/book/book_add')?>";
      }
      else
      {
        url = "<?php echo site_url('parameter/book/book_update')?>";
      }

       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }
  </script>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Book Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" name="kode"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Saldo Normal</label>
              <div class="col-md-9">
                                <select name="eee_kode" class="form-control">
                                    <option value="">--Select Gender--</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">No</label>
              <div class="col-md-9">
					<input name="ccc_kode" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Nama</label>
              <div class="col-md-9">
					<input name="ddd_kode" class="form-control" type="text">
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

  </body>
</html>
