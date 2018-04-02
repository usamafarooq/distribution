
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
                <h1>Add Sale</h1>
                <small></small>
                <ol class="breadcrumb">
                    <li><a href="index.html"><i class="pe-7s-home"></i> Home</a></li>
                    <li class="active">Add Sale</li>
                </ol>
            </div>
        </div>
        <!-- /. Content Header (Page header) -->

        <form method="post" action="<?php echo base_url() ?>sales/insert" enctype="multipart/form-data">

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd ">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Add Sale</h4>
                            </div>
                        </div>
                        <div class="panel-body">


    <div class="form-group row">
    <label for="example-text-input" class="col-sm-3 col-form-label">Distribution<span class="required">*</span></label>
    <div class="col-sm-9">
    <select name="distribution_code" class="form-control" required>
  <option value="">Please Select Distrbution</option>
  <?php foreach($distributions as $distribution){ ?>
  <option value="<?php echo ltrim($distribution['dsr_code'], '0'); ?>"><?php echo $distribution['scm_name']; ?></option>
    <?php } ?>
</select>
    </div>
    </div>

    <div class="form-group row">
    <label for="example-text-input" class="col-sm-3 col-form-label">Product<span class="required">*</span></label>
    <div class="col-sm-9">
    <select name="packcode" class="form-control" required>
  <option value="">Please Select Product</option>
  <?php foreach($products as $product){ ?>
  <option value="<?php echo $product['product_code']; ?>"><?php echo $product['product_name']; ?></option>
    <?php } ?>
</select>
    </div>
    </div>
                            <!-- <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Date<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="date" type="text" value="<?php echo date("Y/m/d"); ?>" id="example-text-input" placeholder="" required="" readonly>
                                </div>
                            </div> -->

                        

    <div class="form-group row">

    <label for="example-text-input" class="col-sm-3 col-form-label">Sales<span class="required">*</span></label>
    <div class="col-sm-9">
    <input class="form-control" name="sales" type="number" value="" id="example-text-input" placeholder="" required="">
    </div>
    </div>



 <div class="form-group row">

    <label for="example-text-input" class="col-sm-3 col-form-label">Closing<span class="required">*</span></label>
    <div class="col-sm-9">
    <input class="form-control" name="closing" type="number" value="" id="example-text-input" placeholder="" required="">
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
