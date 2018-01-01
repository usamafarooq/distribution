
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
                <h1>Add Product</h1>
                <small></small>
                <ol class="breadcrumb">
                    <li><a href="index.html"><i class="pe-7s-home"></i> Home</a></li>
                    <li class="active">Add Product</li>
                </ol>
            </div>
        </div>
        <!-- /. Content Header (Page header) -->

        <form method="post" action="<?php echo base_url() ?>product/insert" enctype="multipart/form-data">

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd ">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Add Product</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Name<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="product_name" type="text" value="" id="example-text-input" placeholder="" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Description<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="description" type="text" value="" id="example-text-input" placeholder="" required="">
                                </div>
                            </div>
                            <div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Product Code<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="product_code" type="text" value="" id="example-text-input" placeholder="" required="">
                                </div>
                            </div>




    <div class="form-group row">
    <label for="example-text-input" class="col-sm-3 col-form-label">Team Select<span class="required">*</span></label>
    <div class="col-sm-9">
    <select name="team" class="form-control" required>
  <option value="">Please Select Team</option>

  <?php foreach($team as $data_file){ ?>
  <option value="<?php echo $data_file['name']; ?>"><?php echo $data_file['name']; ?></option>
    <?php } ?>
</select>
    </div>
    </div>



    <div class="form-group row">

    <label for="example-text-input" class="col-sm-3 col-form-label">SCM Product Code<span class="required">*</span></label>
    <div class="col-sm-9">
    <input class="form-control" name="scm_product_code" type="number" value="" id="example-text-input" placeholder="" required="">
    </div>
    </div>





<div class="form-group row">
    <label for="example-text-input" class="col-sm-3 col-form-label">TP<span class="required">*</span></label>
    <div class="col-sm-9">
    <input class="form-control" name="tp_product" type="number" value="" id="example-text-input" placeholder="" required="">
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
