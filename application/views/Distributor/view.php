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
							<h1>View Product</h1>
							<small> </small>
							<ol class="breadcrumb">
								<li><a href="<?php echo base_url() ?>"><i class="pe-7s-home"></i> Home</a></li>

								<li class="active">View Product</li>
							</ol>
						</div>
					</div> <!-- /. Content Header (Page header) -->

					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-bd">
								<div class="panel-heading">
									<div class="panel-title">
										<h4>View Product</h4>

										<!-- <button type="button" class="btn btn-success pull-right" style="margin-right: 10px;color: white !important;" data-toggle="modal" data-target="#myModal">Import Csv</button>

			<a href="<?php echo base_url('distributor/export_csv_file') ?>" class="btn btn-success pull-right" style="margin-right: 10px;color: white !important;">Export Csv File</a> -->



									</div>
								</div>
								<div class="panel-body">
									
									<div class="table-responsive">
										<form method="post" action="">
										<table id="dataTableExample2" class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th>Id</th>
													<th>Distrbution Name</th>
													<th>Product Name</th>
													<th>Qty</th>
													<th>Dc No</th>
													<th>Date</th>
													<th>C.N</th>
													<th>Kg</th>
													<th>Cartons</th>
													<th>Packs</th>
													<th>Receive Quantity</th>
													<th>Remarks</th>
												</tr>
											</thead>
										    <tbody>
										    	<?php
										    		foreach ($distributors as $data) {
										    	?>
												<tr>
													
										<td><?php echo $data['id'] ?></td>
										<td><?php echo $data['scm_name'] ?></td>
										<td><?php echo $data['product_name'] ?></td>
										<td><?php echo $data['orders'] ?></td>
										<td><?php echo $data['dc_no'] ?></td>
										<td><?php echo $data['date'] ?></td>
										<td><?php echo $data['cn'] ?></td>
										<td><?php echo $data['kg'] ?></td>
										<td><?php echo $data['cartons'] ?></td>
										<td><?php echo $data['packs'] ?></td>
										<?php 
											if ($data['receive_quantity'] != 0) {
												echo '<td>'.$data['receive_quantity'].'</td>';
												echo '<td>'.$data['distribution_remarks'].'</td>';
											}
											else{
												echo '<td><input type="hidden" name="id[]" value="'.$data['id'].'"><input type="number" name="receive_quantity[]" value="'.$data['orders'].'"></td><td><input type="text" name="remarks[]"></td>';
											}
										?>
										

													
												</tr>
												<?php } ?>
											</tbody>
										</table>
										<button type="submit" class="btn btn-info pull-right">Submit</button>
										</form>
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
                                                <h1 class="modal-title">Modal title</h1>
                                            </div>
                                            <div class="modal-body">
                                                
<form method="post" id="restrict_file" action="<?php echo base_url() ?>distributor/csv_upload" enctype="multipart/form-data">
                          <input type="file" name="csv_name" id="csv_check" accept=".csv,.xlsx,.xls">
                                                

                                            </div>
                                            <div class="modal-footer">
                          <button type="submit" class="btn btn-danger csvbtn" >Submit</button>

                                                </form>
                                            </div>
                                        </div><!-- /.modal-content
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal --> 
<script>	
$('.csvbtn').attr('disabled',true);
$('#csv_check').change(function() {
      if($(this).val()) {
        
        $('.csvbtn').attr('disabled',false);
      } 
    });

</script>
