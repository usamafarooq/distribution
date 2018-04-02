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
									<form method="post" action="">
										<div class="table-responsive">
											<table id="order_table" class="table table-bordered table-striped table-hover">
												<thead>
													<tr>
	                                                    <th>S.no</th>
	                                                    <th>Order NO</th>
	                                                    <th>Order Date</th>
	                                                    <th>Distribution Name</th>
	                                                    <th>Product Name</th>
	                                                    <th>Order Quantity</th>
	                                                    <th>Pending</th>
	                                                    <th>Reorder</th>
	                                                </tr>
												</thead>
											    <tbody>
											    	<?php 
	                                                    $con = 0;
	                                                    foreach($orders as $products_detail){
	                                                        $con++;
	                                                ?> 
	                                                <tr>
	                                                    <td><?php echo $con ?></td>
	                                                    <td><?php echo $products_detail['orderid']; ?></td>
	                                                    <td><?php echo $products_detail['date']; ?></td>
	                                                    <td><?php echo $products_detail['scm_name']; ?></td>
	                                                    <td><?php echo $products_detail['product_name']; ?></td>
	                                                    <td><?php echo $products_detail['orders']; ?></td>
	                                                    <td><?php echo $products_detail['pending']; ?></td>
	                                                    <td>
	                                                    	<input type="hidden" name="orderid[]" value="<?php echo $products_detail['orderid']; ?>">
	                                                    	<input type="hidden" name="detailid[]" value="<?php echo $products_detail['id']; ?>">
	                                                        <input type="text" name="qty[]" value="<?php echo $products_detail['pending'] ?>">
	                                                    </td>
	                                                </tr>
	                                                <?php } ?>
												</tbody>
											</table>
											
										</div>
										<button type="submit" class="btn btn-info pull-right">Submit</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div style="height: 450px;"></div>
				</div> <!-- /.main content -->
			</div><!-- /#page-wrapper -->
		</div><!-- /#wrapper -->
		<!-- START CORE PLUGINS -->
