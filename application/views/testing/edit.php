
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
                <h1>Edit Testing</h1>
                <small></small>
                <ol class="breadcrumb">
                    <li><a href="index.html"><i class="pe-7s-home"></i> Home</a></li>
                    <li class="active">Edit Testing</li>
                </ol>
            </div>
        </div>
        <!-- /. Content Header (Page header) -->

        <form method="post" action="<?php echo base_url() ?>testing/update" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $testing["id"] ?>">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd ">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Edit Testing</h4>
                            </div>
                        </div>
                        <div class="panel-body"><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Test<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="test" type="number" value="<?php  echo $testing["test"] ?>" id="example-text-input" placeholder="" required="">
                                </div>

                            </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Test2<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="test2" type="text" value="<?php  echo $testing["test2"] ?>" id="example-text-input" placeholder="" required="">
                                </div>

                            </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Test3</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="test3" type="textarea" value="<?php  echo $testing["test3"] ?>" id="example-text-input" placeholder="" >
                                </div>

                            </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Test4</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="test4" type="date" value="<?php  echo $testing["test4"] ?>" id="example-text-input" placeholder="" >
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
