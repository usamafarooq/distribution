
<!-- /.Navbar  Static Side -->
<div class="control-sidebar-bg"></div>
<!-- Page Content -->
<div id="page-wrapper">
    <!-- main content -->
    <div class="content">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="header-icon">
                <i class="pe-7s-note2"></i>
            </div>
            <div class="header-title">
                <h1>Edit Order</h1>
                <small></small>
                <ol class="breadcrumb">
                    <li><a href="index.html"><i class="pe-7s-home"></i> Home</a></li>
                    <li class="active">Edit Order</li>
                </ol>
            </div>
        </div>
        <!-- /. Content Header (Page header) -->

        <form method="post" action="<?php echo base_url() ?>orders/update" enctype="multipart/form-data" id="submit-form">

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd ">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Edit Order</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                    
                            
<input name="id_order" type="hidden" value="<?php echo $order['id']; ?>">



                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Order Field<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control order1" name="order_field" type="text" value="<?php echo $order['order_field']; ?>" id="example-text-input" placeholder="" required="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Order Field2<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control order1" name="order_field2" type="text" value="<?php echo $order['order_field2']; ?>" id="example-text-input" placeholder="" required="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Order Field3<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control order1" name="order_field3" type="text" value="<?php echo $order['order_field3']; ?>" id="example-text-input" placeholder="" required="">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Growth<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" value="<?php echo $order['growth']; ?>" name="growth" type="text" id="example-text-input" placeholder="" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Carton<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" value="<?php echo $order['carton']; ?>" name="carton" type="text" id="example-text-input" placeholder="" required="">
                                </div>
                            </div>
                            


                            <div class="form-group row">

                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                                </div>
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

</div>
<!-- /.main content -->
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- START CORE PLUGINS -->


<script>
$( "#submit-form" ).submit(function(e) {
        var form = this;
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Update it!",
            closeOnConfirm: false
        },
        function() {
        form.submit();
        });
    });
</script>