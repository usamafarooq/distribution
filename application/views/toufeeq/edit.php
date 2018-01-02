
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
                <h1>Edit Toufeeq</h1>
                <small></small>
                <ol class="breadcrumb">
                    <li><a href="index.html"><i class="pe-7s-home"></i> Home</a></li>
                    <li class="active">Edit Toufeeq</li>
                </ol>
            </div>
        </div>
        <!-- /. Content Header (Page header) -->

        <form method="post" action="<?php echo base_url() ?>toufeeq/update" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $toufeeq["id"] ?>">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd ">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Edit Toufeeq</h4>
                            </div>
                        </div>
                        <div class="panel-body"><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Companyname <span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="companyname " type="textarea" value="<?php  echo $toufeeq["companyname "] ?>" id="example-text-input" placeholder="" required="">
                                </div>

                            </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Ntn<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="ntn" type="number" value="<?php  echo $toufeeq["ntn"] ?>" id="example-text-input" placeholder="" required="">
                                </div>

                            </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Website<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="website" type="text" value="<?php  echo $toufeeq["website"] ?>" id="example-text-input" placeholder="" required="">
                                </div>

                            </div><div class="form-group row">

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
