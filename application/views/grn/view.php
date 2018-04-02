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
							<h1>View Orders</h1>
							<small> </small>
							<ol class="breadcrumb">
								<li><a href="<?php echo base_url() ?>"><i class="pe-7s-home"></i> Home</a></li>

								<li class="active">View Orders</li>
							</ol>
						</div>
					</div> <!-- /. Content Header (Page header) -->

					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-bd">
								<div class="panel-heading">
									<div class="panel-title">
										<h4>View Orders</h4>


									</div>
								</div>
								<div class="panel-body">
									
									<div class="table-responsive">
										<form method="post" action="">
										<table id="dataTableExample2" class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th>S.no</th>
													<th>Distrbution Name</th>
													<th>Product Name</th>
													<th>Order Quantity</th>
													<th>Sent Quantity</th>
													<th>Receive Quantity</th>
													<th>Remaning</th>
													<th>Missing</th>
												</tr>
											</thead>
										    <tbody>
										    	<?php
										    		$con =1;
										    		foreach ($grn as $data) {
										    			$mis = $data['sent'] - $data['receive'];
										    	?>
												<tr <?php if($mis) echo 'style="background:red"' ?>>
													<td><?php echo $con?></td>
													<td><?php echo $data['scm_name'] ?></td>
													<td><?php echo $data['product_name'] ?></td>
													<?php 
														$orders = explode(',', $data['orders']);
													?>
													<td><?php echo array_sum($orders) ?></td>
													<td><?php echo $data['sent'] ?></td>
													<td><?php echo $data['receive'] ?></td>
													<td><?php echo array_sum($orders) - $data['receive'] ?></td>
													<td><?php echo $data['sent'] - $data['receive'] ?></td>
												</tr>
												<?php $con++; } ?>
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
