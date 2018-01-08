
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
                                        
                                        <a href="<?php echo base_url('orders/add') ?>"><button class="btn btn-info pull-right">Add</button></a>
                                         


                                    </div>
                                </div>
        <form action="<?php echo base_url(); ?>orders/submit_data_order" method="post">
                                <div class="panel-body">
                                    
                                    <div class="table-responsive">

  
                                        <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>S.no</th>
                                                    <th>Distributor Code</th>
                                                    <th>Distributor Name</th>
                                                    <th>Products</th>
                                                    <th>SCM Product Code</th>
                                                    <th>IMS Pack Code</th>
                                                    <th>First Month</th>
                                                    <th>Second Month</th>
                                                    <th>Third Month</th>
                                                    <th>Month Average Sale</th>
                                                    <th>Intransit</th>
                                                    <th>Closing</th>
                                                    <th>Closing Stock</th>
                                                    <th>Average of Closing Stock</th>
                                                    <th>Order1</th>
                                                    <th>Order2</th>
                                                    <th>Order3</th>
                                                    <th>Order Quantity</th>
                                                    <th>Growth</th>
                                                    <th>Packs Carton</th>
                                                </tr>
                                            </thead>
                                            <tbody> 



<?php 
 $con = 0;
 
 foreach($index_data as $products_detail)
 { 
    $sale = explode(",",$products_detail['sale']);

                                                $con++;
$month = $products_detail['MONTH'];
 $data_month = explode(",",$month);
 //print_r($data_month);
 

                                            ?>


                                           
                                                <tr>
                                                    <td><?php echo $con ?></td>
<td><?php echo $products_detail['scm_code']; ?></td>
                                        <td><?php echo $products_detail['scm_name']; ?></td>
                                        <td><?php echo $products_detail['product_name']; ?></td>
                                        <td><?php echo $products_detail['scm_product_code']; ?></td>
<td><?php echo $products_detail['pak_code']; ?></td>                                             

<?php
$avg_sum = 0;
for ($i = 1; $i <= 3; $i++){
$month_key = date('m', strtotime('-'.$i.' month', strtotime($products_detail['date'])));
    $key = array_search($month_key, $data_month);
    if ($key <= -1) {
        $val = '0';

    }
    else{
        if (array_key_exists($key,$data_month)) {
            $val = $sale[$key];
            $avg_sum+= $val;
        }
        else{
            $val = '0';

        }
    }
    echo '<td>'.$val.'</td>';     
}

?>

                                       <td><?php 
                                         $avg_sum = $avg_sum/3;
                                         echo $res_avg = round($avg_sum);
                                          ?></td>
                                        <td><?php echo $instransit = 0; ?></td>
                                        <td><?php echo $products_detail['closing']; ?></td>
                                        <td><?php echo $closing_stock = $products_detail['closing'] + $instransit; ?></td>

                                         <td><?php 
                                        $res = ($avg_sum * 2.5) - $closing_stock ; 

                                        echo round($res);
                                        ?></td>
                                        
                <td><?php echo $products_detail['order_field']; ?></td>
                <td><?php echo $products_detail['order_field2']; ?></td>
                <td><?php echo $products_detail['order_field3']; ?></td>
                                        <td><?php 


     echo $total =  $products_detail['order_field'] + $products_detail['order_field2'] + $products_detail['order_field3'];



                                        ?></td>
                                        <td><?php echo $products_detail['growth']; ?></td>
                                        <td><?php echo $products_detail['carton']; ?></td>
                                        </tr>

                                            <?php } ?>


                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>                    
</form>
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
