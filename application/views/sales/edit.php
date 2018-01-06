
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
                <h1>Edit Sale</h1>
                <small></small>
                <ol class="breadcrumb">
                    <li><a href="index.html"><i class="pe-7s-home"></i> Home</a></li>
                    <li class="active">Edit Sale</li>
                </ol>
            </div>
        </div>
        <!-- /. Content Header (Page header) -->

        <form method="post" action="<?php echo base_url() ?>sales/update" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $orders['id'] ?>">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd ">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Edit Sale</h4>
                            </div>
                        </div>
                        <div class="panel-body">

                           

     <div class="form-group row">
    <label for="example-text-input" class="col-sm-3 col-form-label">Distribution_code<span class="required">*</span></label>
    <div class="col-sm-9">
    <select name="Distribution_code" class="form-control" required>
  <?php foreach($distributions as $distribution){ ?>
  <option value="<?php echo $distribution['scm_code']; ?>"    <?php if($orders['distribution_code'] == $distribution['scm_code'] ){ echo 'selected'; } ?>  ><?php echo $distribution['scm_name']; ?></option>
    <?php } ?>
</select>
    </div>
    </div>



    <div class="form-group row">
    <label for="example-text-input" class="col-sm-3 col-form-label">Packcode<span class="required">*</span></label>
    <div class="col-sm-9">
    <select name="Packcode" class="form-control" required>
  <?php foreach($products as $product){ ?>
  <option value="<?php echo $product['product_code']; ?>" <?php if($orders['packcode'] == $product['product_code'] ){ echo 'selected'; } ?>      ><?php echo $product['product_name']; ?></option>
    <?php } ?>
</select>
    </div>
    </div>


<div class="form-group row">
    <label for="example-text-input" class="col-sm-3 col-form-label">Date<span class="required">*</span></label>
    <div class="col-sm-9">
        <input class="form-control" name="date" type="date" value="<?php  echo $orders['date'] ?>" id="example-text-input" placeholder="" required="">
    </div>
</div>



<div class="form-group row">

    <label for="example-text-input" class="col-sm-3 col-form-label">sales<span class="required">*</span></label>
    <div class="col-sm-9">
    <input class="form-control" name="sales" type="number" id="example-text-input" value="<?php  echo $orders['sales'] ?>" placeholder="" required="">
    </div>
    </div>



<div class="form-group row">
    <label for="example-text-input" class="col-sm-3 col-form-label">Closing<span class="required">*</span></label>
    <div class="col-sm-9">
    <input class="form-control" name="closing" type="number" value="<?php  echo $orders['closing'] ?>" id="example-text-input" placeholder="" required="">
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
