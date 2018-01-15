		




		<!-- /.Navbar  Static Side -->
			<div class="control-sidebar-bg"></div>
			<!-- Page Content -->
			<div id="page-wrapper">
				<!-- main content -->
				<div class="content">
					<!-- Content Header (Page header) -->
					<div class="content-header">
						<div class="header-icon">
							<i class="pe-7s-box1"></i>
						</div>
						<div class="header-title">
							<h1>View Distributors</h1>
							<small> </small>
							<ol class="breadcrumb">
								<li><a href="<?php echo base_url() ?>"><i class="pe-7s-home"></i> Home</a></li>

								<li class="active">View Distributors</li>
							</ol>
						</div>
					</div> <!-- /. Content Header (Page header) -->

					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-bd">
								<div class="panel-heading">
									<div class="panel-title">
										<h4>View Distributors</h4>
										<?php 
											if ($permission['created'] == '1') {
										?>
										<a href="<?php echo base_url('distribution/create') ?>"><button class="btn btn-info pull-right">Add Distributors</button></a>
										<?php } ?>

										<button type="button" class="btn btn-success pull-right" style="margin-right: 10px;color: white !important;" data-toggle="modal" data-target="#myModal">Import Csv</button>


<a href="<?php echo base_url('distribution/export_csv_file') ?>" class="btn btn-success pull-right" style="margin-right: 10px;color: white !important;">Export Csv File</a>


									</div>
								</div>
								<div class="panel-body">
									
									<div class="table-responsive">
										<table id="dataTableExample2" class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th>Id</th>
													<th>Name</th>
													<th>Email</th>
													<th>Scm Code</th>
													<th>Scm Name</th>
													<th>Dsr Code</th>
													<th>Dsr Name</th>
													<th>Station</th>
													<?php 
														if ($permission['edit'] == '1' || $permission['deleted'] == '1'){
													?>
													<th>Action</th>
													<?php } ?>
												</tr>
											</thead>
										    <tbody>
										    	<?php
										    		foreach ($distributors as $distributor) {
										    	?>
												<tr>
													<td><?php echo $distributor['id'] ?></td>
										<td><?php echo $distributor['name'] ?></td>
										<td><?php echo $distributor['email'] ?></td>
													<td><?php echo $distributor['scm_code'] ?></td>
													<td><?php echo $distributor['scm_name'] ?></td>
													<td><?php echo $distributor['dsr_code'] ?></td>
													<td><?php echo $distributor['dsr_name'] ?></td>
													<td><?php echo $distributor['station'] ?></td>
													<?php 
														if ($permission['edit'] == '1' || $permission['deleted'] == '1'){
													?>
													<td>
														<?php 
															if ($permission['edit'] == '1') {
														?>
		<a href="<?php echo base_url() ?>distribution/edit/<?php echo $distributor['id'] ?>"><img src="<?php echo base_url() ?>assets/record1.png" title="View Order" alt="View Order" width="35" height="35"></a>
														<?php } ?>
														<?php 
															if ($permission['deleted'] == '1') {
														?>
		<a href="<?php echo base_url() ?>distribution/delete/<?php echo $distributor['id'] ?>" class="delete_data"><img src="<?php echo base_url() ?>assets/d-icon.png" title="Delete" alt="Delete" width="35" height="35"></a>
		                                                <?php } ?>
	                                                </td>
	                                                <?php } ?>
												</tr>
												<?php } ?>
											</tbody>
										</table>
										
									</div>
								</div>
							</div>
						</div>
					</div>
					<div style="height: 450px;"></div>
				</div> <!-- /.main content -->
			</div><!-- /#page-wrapper -->
		</div><!-- /#wrapper -->
		<!-- START CORE PLUGINS -->


<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h1 class="modal-title">Import Csv</h1>
                                            </div>
                                            <div class="modal-body">
                                                
<form method="post" id="restrict_file" action="<?php echo base_url() ?>distribution/csv_upload" enctype="multipart/form-data">
                          <input type="file" name="csv_name" id="csv_check" accept=".csv,.xlsx,.xls">
                                                

                                            </div>
                                            <div class="modal-footer">
                          <button type="submit" class="btn btn-danger csvbtn" >Submit</button>

                                                </form>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

<script>
$(".delete_data").click(function(e){   
  var url = $(this).attr('href');
  e.preventDefault();
   swal({
  title: "Are you sure?",
  text: "Your will not be able to recover this imaginary file!",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes, delete it!",
  closeOnConfirm: false
},
function(){
  swal("Deleted!", "Your imaginary file has been deleted.", "success");
  window.location.replace(url);
});

 });