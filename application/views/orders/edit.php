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
                              
                                    </div>
                                </div>
                                <form action="<?php echo base_url(); ?>orders/update" method="post">
                                <div class="panel-body">
                                    <?php $or = explode(',', $product_data_sort[0]['orders']); print_r($or) ?>
                                    <div class="table-responsive">
                                        <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Distribution</th>
                                                    <th>Products</th>
                                                    <?php 
                                                        for ($i = 3; $i > 0; $i--){
                                                    ?>
                                                    <th><?php echo $a =  date('M', strtotime("-".$i." month", strtotime(date('Y-m-01'))));  ?></th>
                                                    <?php } ?>
                                                    <th>Month Average Sale</th>
                                                    <th>Intransit</th>
                                                    <th>Closing</th>
                                                    <th>Closing Stock</th>
                                                    <th>Requirement</th>
                                                    <?php 
                                                        for ($i=0; $i < $or; $i++) { 
                                                            echo '<th>Order '.($i+1).'</th>';
                                                        }
                                                    ?>
                                                    <th>Order Quantity</th>
                                                    <th>Growth</th>
                                                    <th>Packs Carton</th>
                                                </tr>
                                            </thead>
                                            <tbody>                                          
                                            <?php 
                                                $con = 0;
                                                foreach($product_data_sort as $products_detail){ 
                                                    $con++;
                                                    $sale = explode(",",$products_detail['sale']);
                                                    $month = explode(",",$products_detail['month']);
                                            ?>
                                                <tr>
                                                    <td><?php echo $products_detail['scm_name']; ?></td>
                                                    <td><?php echo $products_detail['product_name']; ?></td>
                                                    <input type="hidden" name="id[]" value="<?php echo $products_detail['oid']; ?>">    
                                                    <?php
                                                        $avg_sum = 0;
                                                        for ($i = -3; $i <= -1; $i++){
                                                            $month_key = date('m', strtotime("$i month", strtotime(date('Y-m-01'))));
                                                            $key = array_search($month_key, $month);
                                                            if ($key <= -1) {
                                                                $val = '0';

                                                            }
                                                            else{
                                                                if (array_key_exists($key,$month)) {
                                                                    $val = $sale[$key];
                                                                    $avg_sum+= $val;
                                                                }
                                                                else{
                                                                    $val = '0';

                                                                }
                                                            }
                                                            if ($i == -2) {
                                                                $one = $val;
                                                            }
                                                            if ($i == -1) {
                                                                $two = $val;
                                                            }
                                                            echo '<td>'.$val.'</td>';
                                                        }
                                                    ?>

                                                    <td>
                                                        <?php 
                                                            $avg_sum = $avg_sum/3;
                                                            echo $res_avg = round($avg_sum);
                                                        ?>
                                                    </td>
                                                    <td><?php echo $instransit = 0; ?></td>
                                                    <td><?php echo $products_detail['closing']; ?></td>
                                                    <td><?php echo $closing_stock = $products_detail['closing'] + $instransit; ?></td>
                                                    <td>
                                                        <?php 
                                                            $res = ($avg_sum * 2.5) - $closing_stock ; 
                                                            echo round($res);
                                                        ?>
                                                    </td>
                                                    <?php 
                                                        for ($i=0; $i < $or; $i++) { 
                                                            echo '<td>Order '.($i+1).'</td>';
                                                        }
                                                    ?>
                                                    <td><?php echo $products_detail['total_order'] ?></td>
                                                    <?php 
                                                        $total = $one - $two * 100;
                                                        if ($two != 0) {
                                                            $total = $total / $two;
                                                        }
                                                        $total = round($total);
                                                    ?>
                                                    <td><?php echo $products_detail['growth'] ?>%</td>
                                                    <td><?php echo $products_detail['pack_carton']; ?></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>

                        

<input type="submit" name="" class="btn btn-primary pull-right">
</form>
                        </div>
                    </div>
                    <div style="height: 450px;"></div>
                </div> <!-- /.main content -->
            </div><!-- /#page-wrapper -->
        </div><!-- /#wrapper -->
        <!-- START CORE PLUGINS -->


