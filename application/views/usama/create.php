
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
                <h1>Add Usama</h1>
                <small></small>
                <ol class="breadcrumb">
                    <li><a href="index.html"><i class="pe-7s-home"></i> Home</a></li>
                    <li class="active">Add Usama</li>
                </ol>
            </div>
        </div>
        <!-- /. Content Header (Page header) -->

        <form method="post" action="<?php echo base_url() ?>usama/insert" enctype="multipart/form-data">

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd ">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Add Usama</h4>
                            </div>
                        </div>
                        <div class="panel-body"><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Full name<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="full_name" type="text" value="" id="example-text-input" placeholder="" required="">
                                </div>

                            </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Date of birth<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="date_of_birth" type="date" value="" id="example-text-input" placeholder="" required="">
                                </div>

                            </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Website</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="website" type="text" value="" id="example-text-input" placeholder="" >
                                </div>

                            </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Email<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="email" type="text" value="" id="example-text-input" placeholder="" required="">
                                </div>

                            </div><div class="form-group row">

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
