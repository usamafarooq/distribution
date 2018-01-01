
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
                <h1>Add Order</h1>
                <small></small>
                <ol class="breadcrumb">
                    <li><a href="index.html"><i class="pe-7s-home"></i> Home</a></li>
                    <li class="active">Add Order</li>
                </ol>
            </div>
        </div>
        <!-- /. Content Header (Page header) -->

        <form method="post" action="<?php echo base_url() ?>order/insert" enctype="multipart/form-data">

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd ">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Add Order</h4>
                            </div>
                        </div>
                        <div class="panel-body">


    <div class="form-group row">
    <label for="example-text-input" class="col-sm-3 col-form-label">Distribution_code<span class="required">*</span></label>
    <div class="col-sm-9">
    <select name="Distribution_code" class="form-control" required>
  <option value="">Please Select Team</option>
  <?php foreach($distributions as $distribution){ ?>
  <option value="<?php echo $distribution['scm_code']; ?>"><?php echo $distribution['scm_name']; ?></option>
    <?php } ?>
</select>
    </div>
    </div>

    <div class="form-group row">
    <label for="example-text-input" class="col-sm-3 col-form-label">Packcode<span class="required">*</span></label>
    <div class="col-sm-9">
    <select name="Packcode" class="form-control" required>
  <option value="">Please Select Team</option>
  <?php foreach($products as $product){ ?>
  <option value="<?php echo $product['product_code']; ?>"><?php echo $product['product_name']; ?></option>
    <?php } ?>
</select>
    </div>
    </div>
                            <div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Date<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="Datename" type="text" value="<?php echo date("Y/m/d"); ?>" id="example-text-input" placeholder="" required="" readonly>
                                </div>
                            </div>

                        

    <div class="form-group row">

    <label for="example-text-input" class="col-sm-3 col-form-label">Sales<span class="required">*</span></label>
    <div class="col-sm-9">
    <input class="form-control" name="Sales" type="number" value="" id="example-text-input" placeholder="" required="">
    </div>
    </div>



 <div class="form-group row">

    <label for="example-text-input" class="col-sm-3 col-form-label">Closing<span class="required">*</span></label>
    <div class="col-sm-9">
    <input class="form-control" name="Closing" type="number" value="" id="example-text-input" placeholder="" required="">
    </div>
</div>










                            <div class="form-group row">

                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary pull-right">Add</button>
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
