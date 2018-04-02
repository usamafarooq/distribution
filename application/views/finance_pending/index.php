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
										<table id="dataTableExample2" class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
                                                    <th>S.no</th>
                                                    <th>Distribution Name</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
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
                                                    <td><?php echo $products_detail['scm_name']; ?></td>
                                                    <td><?php echo date('d M Y', strtotime($products_detail['date'])); ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>finance_pending/view/<?php echo $products_detail['id']; ?>"><img src="<?php echo base_url() ?>assets/record1.png" title="View Order" alt="View Order" width="35" height="35"></a>
                                                    </td>
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
