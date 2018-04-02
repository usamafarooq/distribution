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
        </div>
        <!-- /. Content Header (Page header) -->

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
                    <br>
                    <form method="post" action="">
                        <input type="hidden" name="distribution_sort" value="<?php echo $distribution['dsr_code']; ?>">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-md-3">Distribution Name</label>
                                <div class="col-md-9">
                                    <input type="text" name="" class="form-control" value="<?php echo $distribution['scm_name'] ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-3">Distribution Code</label>
                                <div class="col-md-9">
                                    <input type="text" name="" class="form-control" value="<?php echo $distribution['dsr_code'] ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-md-3">Station</label>
                                <div class="col-md-9">
                                    <input type="text" name="" class="form-control" value="<?php echo $distribution['station'] ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-3">No of Installment</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="column" value="<?php echo $column ?>">
                                        <option>Select</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                    <script type="text/javascript">
                                        $('[name="column"]').val(<?php echo $column ?>)
                                    </script>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-info pull-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>View Product</h4>
                        </div>
                    </div>
                    <form action="<?php echo base_url(); ?>orders/submit_data_order" method="post">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="order_table" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Products</th>
                                            <th>IMS Pack Code</th>
                                            <?php for ($i = 3; $i > 0; $i--){?>
                                            <th>
                                                <?php echo $a =  date('M', strtotime("-".$i." month", strtotime(date('Y-m-01'))));  ?>
                                            </th>
                                            <?php } ?>
                                            <th>Month Average Sale</th>
                                            <th>Intransit</th>
                                            <th>Closing</th>
                                            <th>Closing Stock</th>
                                            <th>Requirement</th>
                                            <?php 
                                            $num = 1;
                                                for ($i=0; $i < $num_order; $i++) { 
                                                    echo '<th>Order '.($i+1).'</th>';
                                                    $num++;
                                                }
                                                if (isset($column)) {
                                                    echo '<th>Order '.$num.'</th>';
                                                }
                                            ?>
                                            <th>Order Quantity</th>
                                            <?php 
                                                if ($old_orders == 1) {
                                                    echo '<th>Remaning</th><th>Current Sale</th><th>Current Closing</th><th>Current Intransit</th><th>Pending</th>';
                                                }
                                            ?>
                                            <th>Growth</th>
                                            <th>Packs Carton</th>
                                            <th>TP</th>
                                            <th>T.P Without Tax</th>
                                            <th>Discounted Price Without Tax</th>
                                            <th>Sale Tax</th>
                                            <th>DP</th>
                                            <th>Priority</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $con = 0;
                                            $tp = array();
                                            $dp = array();
                                            $first = array();
                                            $first_np = array();
                                            $secound = array();
                                            $secound_np = array();
                                            $third = array();
                                            $third_np = array();
                                            $avg_total = array();
                                            $avg_total_np = array();
                                            $intransit_total = array();
                                            $intransit_total_np = array();
                                            $closing_total = array();
                                            $closing_total_np = array();
                                            $closing_stock_total = array();
                                            $closing_stock_total_np = array();
                                            $requirement = array();
                                            $requirement_np = array();
                                            $order_total = array();
                                            $order_total_np = array();
                                            $remaning_total = array();
                                            $remaning_total_np = array();
                                            foreach($product_data_sort as $products_detail){ 
                                                $con++;
                                                $sale = explode(",",$products_detail['sale']);
                                                $month = explode(",",$products_detail['month']);
                                                $avg_sum = $products_detail['avg'];
                                                if (!empty($products_detail['closing_stock'])) {
                                                    $closing_stock = $products_detail['closing_stock'];
                                                }
                                                else{
                                                    $closing_stock = $products_detail['closing'] - $products_detail['Intransit'];
                                                }
                                                $res = ($avg_sum * 2.5) - $closing_stock; 
                                                if ($products_detail['pack_carton'] != 0) {
                                                    $carton = $res / $products_detail['pack_carton'];
                                                    $nres = round($carton) * $products_detail['pack_carton'];
                                                }
                                                else{
                                                    $nres = round($res);
                                                }
                                                if (isset($column)) {
                                                    $qty = $nres; 
                                                    if ($old_orders == 1) {
                                                        $orders = explode(',', $products_detail['orders']);
                                                        $qty = $qty - array_sum($orders);
                                                    }
                                                    $qty = round($qty / $column);
                                                    if ($qty < 1) {
                                                        $qty = 0;
                                                    }
                                                    if ($qty > 0 && $products_detail['pack_carton'] > 0) {
                                                        $qty_carton = $qty / $products_detail['pack_carton'];
                                                        $qty = round($qty_carton) * $products_detail['pack_carton'];
                                                    }
                                                    
                                                }
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $products_detail['product_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $products_detail['product_code']; ?>
                                            </td>
                                            <input type="hidden" name="distribution_code_order[]" value="<?php echo $distribution['dsr_code']; ?>">
                                            <input type="hidden" name="scm_product_order[]" value="<?php echo $products_detail['product_code']; ?>">
                                            <?php
                                                //$avg_sum = 0;
                                                for ($i = -3; $i <= -1; $i++){
                                                    $month_key = date('m', strtotime("$i month", strtotime(date('Y-m-01'))));
                                                    $key = array_search($month_key, $month);
                                                    if ($key <= -1) {
                                                        $val = '0';

                                                    }
                                                    else{
                                                        if (array_key_exists($key,$month)) {
                                                            $val = $sale[$key];
                                                            //$avg_sum+= $val;
                                                        }
                                                        else{
                                                            $val = '0';
                                                        }
                                                    }
                                                    if ($i == -2) {
                                                        $one = $val;
                                                        $secound[] = $val * $products_detail['tp_product'];
                                                    }
                                                    if ($i == -1) {
                                                        $two = $val;
                                                        $third[] = $val * $products_detail['tp_product'];
                                                    }
                                                    if ($i == -3) {
                                                        $three = $val;
                                                        $first[] = $val * $products_detail['tp_product'];
                                                    }
                                                    echo '<td>'.$val.'</td>';
                                                }
                                                $total = $one - $two * 100;
                                                if ($two != 0) {
                                                    $total = $total / $two;
                                                }
                                                $total = round($total);
                                            ?>
                                            <td>
                                                <?php 
                                                    $avg_total[] = $avg_sum * $products_detail['tp_product'];
                                                    echo $avg_sum;
                                                ?>
                                            </td>
                                            <?php $orders = explode(',', $products_detail['orders']); ?>
                                            <td>
                                                <?php $intransit_total[] = $products_detail['Intransit'] * $products_detail['tp_product']; echo $products_detail['Intransit']; ?>
                                            </td>
                                            <td>
                                                <?php $closing_total[] = $products_detail['closing'] * $products_detail['tp_product']; echo $products_detail['closing']; ?>
                                            </td>
                                            <td>
                                                <?php $closing_stock_total[] = $closing_stock * $products_detail['tp_product']; echo $closing_stock; ?>
                                            </td>
                                            <td>
                                                <?php
                                                 $requirement[] = $res * $products_detail['tp_product']; 
                                                    echo round($res);
                                                ?>
                                            </td>
                                            <?php 
                                                if ($num_order >= 1) {
                                                    for ($i=sizeof($orders) - 1; $i >= 0; $i--) { 
                                                        echo '<td>'.$orders[$i].'</td>';
                                                    }
                                                    $re = $num_order - sizeof($orders);
                                                    for ($i=0; $i < $re; $i++) { 
                                                        echo '<td></td>';
                                                    }
                                                }
                                            ?>
                                            <?php 
                                                if (isset($column)) {
                                                    echo '<td><input type="number" name="order['.$products_detail['product_code'].'][]" value="'.$qty.'"></td>';
                                                }
                                            ?>
                                            <td>
                                                <?php 
                                                if($nres > 0){
                                                    $order_total[] = $nres * $products_detail['tp_product']; 
                                                    echo $nres;
                                                }
                                                else{
                                                    $order_total[] = 0; 
                                                    echo 0;
                                                }
                                                ?>
                                                <input type="hidden" name="qty[]" value="<?php if($nres > 0){echo round($nres);}else{echo 0;} ?>">
                                            </td>
                                            <?php 
                                                if ($old_orders == 1) {
                                                    $total_order = array_sum($orders);
                                                    $pending = $products_detail['pending'];
                                                    if (empty($pending)) {
                                                        $totals = $total_order - $products_detail['curent_intransit'];
                                                        $pending = $totals;
                                                    }
                                                    $intransit = $products_detail['curent_intransit'];
                                                    if (empty($intransit)) {
                                                        $intransit = 0;
                                                    }
                                                    $remaning = $nres - $total_order;
                                                    $remaning_total = $remaning * $products_detail['tp_product'];
                                                    echo '<td>'.$remaning.'</td><td>'.$products_detail['current_sale'].'</td><td>'.$products_detail['curent_closing'].'</td><td>'.$intransit.'</td><td>'.$pending.'</td>';
                                                }
                                            ?>
                                            <td>
                                                <?php echo $total ?>%<input type="hidden" name="growth[]" value="<?php echo $total ?>"></td>
                                            <td>
                                                <?php echo $products_detail['pack_carton']; ?>
                                            </td>
                                            <td><?php echo $products_detail['tp_product']; $tp[] = $products_detail['tp_product']; ?></td>
                                            <td><?php echo $products_detail['tp_product']; ?></td>
                                            <td>
                                                <?php 
                                                    if ($distribution['price_type'] == 'D1')
                                                        echo $price = $products_detail['p1'];
                                                    elseif ($distribution['price_type'] == 'D2')
                                                        echo $price = $products_detail['p2'];
                                                    elseif ($distribution['price_type'] == 'D3')
                                                        echo $price = $products_detail['p3'];
                                                    if (!$price) {
                                                        $price = $products_detail['tp_product'];
                                                    }
                                                    $dp[] = $price;
                                                    $secound_np[] = $one * $price;
                                                    $third_np[] = $two * $price;
                                                    $first_np[] = $three * $price;
                                                    $avg_total_np[] = $avg_sum * $price;
                                                    $intransit_total_np[] = $products_detail['Intransit'] * $price;
                                                    $closing_total_np[] = $products_detail['closing'] * $price;
                                                    $closing_stock_total_np[] = $closing_stock * $price;
                                                    $requirement_np[] = $res * $price;
                                                    $order_total_np[] = $nres * $price;
                                                    if ($old_orders == 1) {
                                                        $remaning_total_np = $remaning * $price;
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $tax = round($price * 17 / 100, 2) ?></td>
                                            <td><?php echo round($price + $tax, 2) ?></td>
                                            <td>
                                            <?php 
                                            $avg_per = ($two / 30);
                                            if (!$avg_per)
                                                $ty = $closing_stock / 1;
                                            else
                                            $ty = $closing_stock / $avg_per;
                                                // if ($avg_sum > $closing_stock) {
                                                //     echo "HI";
                                                // }
                                                // else{
                                                //     echo 'Low';
                                                // }
                                        if ($ty>0) {
                                            if($ty<5){
                                                echo "Super Urgent";
                                            }
                                            if($ty>=5 && $ty<10){
                                                echo "Overnight Dispatch";
                                            }
                                            if($ty>=10 && $ty<20){
                                                echo "Overland Dispatch";
                                            }
                                            if($ty>=20 && $ty<45){
                                                echo "Normal Dispatch";
                                            }
                                            if($ty>=45 && $ty<999){
                                                echo "High Inventory";
                                            }
                                        }
                                            ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td><span style="opacity: 0">zz</span> Value at TP</td>
                                            <td></td>
                                            <td><?php echo number_format(round(array_sum($first))) ?></td>
                                            <td><?php echo number_format(round(array_sum($secound))) ?></td>
                                            <td><?php echo number_format(round(array_sum($third))) ?></td>
                                            <td><?php echo number_format(round(array_sum($avg_total))) ?></td>
                                            <td><?php echo number_format(round(array_sum($intransit_total))) ?></td>
                                            <td><?php echo number_format(round(array_sum($closing_total))) ?></td>
                                            <td><?php echo number_format(round(array_sum($closing_stock_total))) ?></td>
                                            <td><?php echo number_format(round(array_sum($requirement))) ?></td>
                                            <?php 
                                            $num = 1;
                                                for ($i=0; $i < $num_order; $i++) { 
                                                    echo '<td></td>';
                                                    $num++;
                                                }
                                                if (isset($column)) {
                                                    echo '<td></td>';
                                                }
                                            ?>
                                            <td><?php echo number_format(round(array_sum($order_total))) ?></td>
                                            <?php 
                                                if ($old_orders == 1) {
                                                    echo '<td>'.number_format(round(array_sum($remaning_total))).'</td><td></td><td></td><td></td><td></td>';
                                                }
                                            ?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><span style="opacity: 0">zz</span> Value at <span style="opacity: 0">z</span>NP</td>
                                            <td></td>
                                            <td><?php echo number_format(round(array_sum($first_np))) ?></td>
                                            <td><?php echo number_format(round(array_sum($secound_np))) ?></td>
                                            <td><?php echo number_format(round(array_sum($third_np))) ?></td>
                                            <td><?php echo number_format(round(array_sum($avg_total_np))) ?></td>
                                            <td><?php echo number_format(round(array_sum($intransit_total_np))) ?></td>
                                            <td><?php echo number_format(round(array_sum($closing_total_np))) ?></td>
                                            <td><?php echo number_format(round(array_sum($closing_stock_total_np))) ?></td>
                                            <td><?php echo number_format(round(array_sum($requirement_np))) ?></td>
                                            <?php 
                                            $num = 1;
                                                for ($i=0; $i < $num_order; $i++) { 
                                                    echo '<td></td>';
                                                    $num++;
                                                }
                                                if (isset($column)) {
                                                    echo '<td></td>';
                                                }
                                            ?>
                                            <td><?php echo number_format(round(array_sum($order_total_np))) ?></td>
                                            <?php 
                                                if ($old_orders == 1) {
                                                    echo '<td>'.number_format(round(array_sum($remaning_total_np))).'</td><td></td><td></td><td></td><td></td>';
                                                }
                                            ?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <input type="submit" name="" class="btn btn-primary pull-right">
                    <!-- <p>tp = <?php echo array_sum($tp) ?></p>
                    <p>dp = <?php echo array_sum($dp) ?></p> -->
                </form>
            </div>
        </div>
        <div style="height: 450px;"></div>
    </div>
    <!-- /.main content -->
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- START CORE PLUGINS -->
<style type="text/css">
    .navbar {
        position: relative;
    }
</style>

<script>
    $('.csvbtn').attr('disabled', true);
    $('#csv_check').change(function() {
        if ($(this).val()) {

            $('.csvbtn').attr('disabled', false);
        }
    });
    
</script>
<style type="text/css">
    div#page-wrapper {
        width: 100%;
        margin: 0;
    }

    .sidebar {
        display: none;
    }
</style>