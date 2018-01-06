



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
                <h1>Edit Distributor</h1>
                <small></small>
                <ol class="breadcrumb">
                    <li><a href="index.html"><i class="pe-7s-home"></i> Home</a></li>
                    <li class="active">Edit Distributor</li>
                </ol>
            </div>
        </div>
        <!-- /. Content Header (Page header) -->

        <form method="post" action="<?php echo base_url() ?>distribution/update" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $distributors[0]['id'] ?>">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd ">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Edit Distributor</h4>
                            </div>
                        </div>
                        <div class="panel-body">

<!-- hidden -->
<input class="form-control" name="distribution_id" type="hidden" value="<?php echo $distributors[0]['distribution_id']; ?>" id="example-text-input" placeholder="">

<input class="form-control" name="user_id" type="hidden" value="<?php echo $distributors[0]['user_id']; ?>" id="example-text-input" placeholder="">

<input class="form-control" name="role" type="hidden" value="<?php echo $distributors[0]['role']; ?>" id="example-text-input" placeholder="">

        <div class="form-group row">
        <label for="example-text-input" class="col-sm-3 col-form-label">User Name<span class="required">*</span></label>
        <div class="col-sm-9">
        <input class="form-control" name="name" type="text" value="<?php echo $distributors[0]['name']; ?>" id="example-text-input" placeholder="" required="">
        </div>
        </div>


        <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Email<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="email" type="text" value="<?php echo $distributors[0]['email']; ?>" id="example-text-input" placeholder="" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Password<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="password" type="text" value="" id="example-text-input" placeholder="">
                                    

                                </div>
        </div>


                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Scm Code<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="scm_code" type="text"  value="<?php  echo $distributors[0]['scm_code'] ?>" id="example-text-input" placeholder="" required="">
                                </div>
                            </div>

                            <div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Scm Name<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="scm_name" type="text" value="<?php  echo $distributors[0]['scm_name'] ?>" id="example-text-input" placeholder="" required="">
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Dsr Code<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="dsr_code" type="text" value="<?php  echo $distributors[0]['dsr_code'] ?>" id="example-text-input" placeholder="" required="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Dsr Name<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="dsr_name" type="text" value="<?php  echo $distributors[0]['dsr_name'] ?>" id="example-text-input" placeholder="" required="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Station<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="station" type="text" value="<?php  echo $distributors[0]['station'] ?>" id="example-text-input" placeholder="" required="">
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
