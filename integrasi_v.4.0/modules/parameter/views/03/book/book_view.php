<!-- Main Content -->
<link href="<?php echo base_url('public/assests/select2-master/dist/css/select2.min.css')?>" rel="stylesheet">
   <section class="content">
		<h2>Parameter<small> rekening</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li><a href="<?php echo site_url('parameter/rekening');?>"> Rekening</a></li>
					<li class="active"> Akun</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-purple">
						<h2>Rekening<small>Data Akun</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">                                        
                                        <li><a title="Kembali" href="<?php echo base_url('parameter'); ?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                        <li role="presentation" class="active"><a href="#home_animation_1" data-toggle="tab">Akun</a></li>
                                        <li><a href="javascript:void(0);">Kelompok</a></li>
                                        <li><a href="javascript:void(0);">Jenis</a></li>
                                        <li><a href="javascript:void(0);">Obyek</a></li>
                                        <li><a href="javascript:void(0);">Rincian</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane animated flipInX active" id="home_animation_1">
                                            <b><?php echo validation_errors(); ?><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></b>
                                            <p><table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
					<th>Book ID</th>
					<th>Book ISBN</th>
					<th>Book Title</th>
					<th>Book Author</th>
					<th>Book Category</th>

          <th style="width:125px;"><button class="btn btn-success" onclick="add_book()"><i class="glyphicon glyphicon-plus"></i> Add Book</button>
          </p></th>
        </tr>
      </thead>
      <tbody>
				<?php foreach($books as $book){?>
				     <tr>
				         <td><?php echo $book->book_id;?></td>
				         <td><?php echo $book->book_isbn;?></td>
								 <td><?php echo $book->book_title;?></td>
								<td><?php echo $book->book_author;?></td>
								<td><?php echo $book->book_category;?></td>
								<td>
									<button class="btn btn-warning" onclick="edit_book(<?php echo $book->book_id;?>)"><i class="glyphicon glyphicon-pencil"></i></button>
									<button class="btn btn-danger" onclick="delete_book(<?php echo $book->book_id;?>)"><i class="glyphicon glyphicon-remove"></i></button>


								</td>
				      </tr>
				<?php }?>
      </tbody>

      <tfoot>
        <tr>
          <th>Book ID</th>
          <th>Book ISBN</th>
          <th>Book Title</th>
          <th>Book Author</th>
          <th>Book Category</th>
          <th>Action</th>
        </tr>
      </tfoot>
    </table></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Tabs With Custom Animations -->
        </div>
    </section>
<!-- END CONTENT -->
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
          <input type="hidden" value="" name="book_id"/>
          <div class="form-body">
            <div class="form-group">
				<label class="control-label col-md-3">Book ISBN</label>
				<div class="col-md-9">				
					<select id="book_isbn" name="book_isbn" class="form-control">
						<option value="">Pilih ...</option>
						<option value="aa">AA</option>
						<option value="bb">BB</option>
					</select>				
              </div>
            </div>
            <div class="form-group">
				<label class="control-label col-md-3">Book Title</label>
				<div class="col-md-9">
					<input name="book_title" placeholder="Book_title" class="form-control" type="text">
				</div>
            </div>
            <div class="form-group">
				<label class="control-label col-md-3">Book Author</label>
				<div class="col-md-9">
					<input name="book_author" placeholder="Book Author" class="form-control" type="text">
				</div>
            </div>
						<div class="form-group">
							<label class="control-label col-md-3">Book Category</label>
							<div class="col-md-9">
								<input name="book_category" placeholder="Book Category" class="form-control" type="text">
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