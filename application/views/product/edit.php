
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
                <h1>Edit Products</h1>
                <small></small>
                <ol class="breadcrumb">
                    <li><a href="index.html"><i class="pe-7s-home"></i> Home</a></li>
                    <li class="active">Edit Products</li>
                </ol>
            </div>
        </div>
        <!-- /. Content Header (Page header) -->

        <form method="post" action="<?php echo base_url() ?>product/update" enctype="multipart/form-data" id="submit-form">
            <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd ">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Edit Products</h4>
                            </div>
                        </div>
                        <div class="panel-body">

                            <div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Name<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="product_name" type="text"  value="<?php  echo $product['product_name'] ?>" id="example-text-input" placeholder="" required="">
                                </div>

                            </div>

                            <div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Description<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="description" type="text" value="<?php  echo $product['description'] ?>" id="example-text-input" placeholder="" required="">
                                </div>

                            </div>


                            <div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Product Code<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="product_code" type="text" value="<?php  echo $product['product_code'] ?>" id="example-text-input" placeholder="" required="">
                                </div>
                            </div>





<div class="form-group row">
    <label for="example-text-input" class="col-sm-3 col-form-label">Team Select<span class="required">*</span></label>
    <div class="col-sm-9">
    <select name="team" class="form-control" required>
  <?php foreach($team as $data_file){ ?>
  <option value="<?php echo $data_file['name']; ?>" <?php if( $data_file['name'] == $product['team']  ){ echo $product['team'];} ?>><?php echo $data_file['name']; ?></option>
    <?php } ?>
</select>
    </div>
    </div>



<div class="form-group row">

    <label for="example-text-input" class="col-sm-3 col-form-label">SCM Product Code<span class="required">*</span></label>
    <div class="col-sm-9">
    <input class="form-control" name="scm_product_code" type="number" id="example-text-input" value="<?php  echo $product['scm_product_code'] ?>" placeholder="" required="">
    </div>
    </div>



    <div class="form-group row">
    <label for="example-text-input" class="col-sm-3 col-form-label">TP<span class="required">*</span></label>
    <div class="col-sm-9">
    <input class="form-control" name="tp_product" type="number" value="<?php  echo $product['tp_product'] ?>" id="example-text-input" placeholder="" required="">
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
