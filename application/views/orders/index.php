
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
							<h1>View Order</h1>
							<small> </small>
							<ol class="breadcrumb">
								<li><a href="<?php echo base_url() ?>"><i class="pe-7s-home"></i> Home</a></li>

								<li class="active">View Order</li>
							</ol>
						</div>
					</div> <!-- /. Content Header (Page header) -->

					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-bd">
								<div class="panel-heading">
									<div class="panel-title">
										<h4>View Order</h4>
										<?php 
											if ($permission['created'] == '1') {
										?>
										<a href="<?php echo base_url('orders/add') ?>"><button class="btn btn-info pull-right">Add Order</button></a>
										<?php } ?>

										<button type="button" class="btn btn-success pull-right" style="margin-right: 10px;color: white !important;" data-toggle="modal" data-target="#myModal">Import Csv</button>

			<a href="<?php echo base_url('order/export_csv_file') ?>" class="btn btn-success pull-right" style="margin-right: 10px;color: white !important;">Export Csv File</a>



									</div>
								</div>
								<div class="panel-body">
									
									<div class="table-responsive">
										<table id="dataTableExample2" class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th>Id</th>
													<th>Distribution</th>
													<th>Packcode</th>
													<th>Datename</th>
													<th>Sales</th>
													<th>Closing</th>
													
													<?php 
														if ($permission['edit'] == '1' || $permission['deleted'] == '1'){
													?>
													<th>Action</th>
													<?php } ?>
												</tr>
											</thead>
										    <tbody>
										    	<?php
										    		foreach ($orders as $order) {
										    	?>
												<tr>
													<td><?php echo $order['id'] ?></td>

										<td>
										<?php echo $order['scm_name'] ?>	
										</td>
										<td><?php echo $order['product_name'] ?></td>
										<td><?php echo $order['Datename'] ?></td>
										<td><?php echo $order['Sales'] ?></td>
										<td><?php echo $order['Closing'] ?></td>

													<?php 
														if ($permission['edit'] == '1' || $permission['deleted'] == '1'){
													?>
													<td>
														<?php 
															if ($permission['edit'] == '1') {
														?>
														<a href="<?php echo base_url() ?>order/edit/<?php echo $order['id'] ?>"><img src="<?php echo base_url() ?>assets/record1.png" title="View Order" alt="View Order" width="35" height="35"></a>
														<?php } ?>
														<?php 
															if ($permission['deleted'] == '1') {
														?>
		                                                <a href="<?php echo base_url() ?>order/delete/<?php echo $order['id'] ?>"><img src="<?php echo base_url() ?>assets/d-icon.png" title="Delete" alt="Delete" width="35" height="35"></a>
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
                                                <h1 class="modal-title">Order Csv</h1>
                                            </div>
                                            <div class="modal-body">
                                                
<form method="post" id="restrict_file" action="<?php echo base_url() ?>order/csv_upload" enctype="multipart/form-data">
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
$('.csvbtn').attr('disabled',true);
$('#csv_check').change(function() {
      if($(this).val()) {
        
        $('.csvbtn').attr('disabled',false);
      } 
    });

</script>
