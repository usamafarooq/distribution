<?php 
$contents = '
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
                <h1>Edit '.ucfirst($controller_name).'</h1>
                <small></small>
                <ol class="breadcrumb">
                    <li><a href="index.html"><i class="pe-7s-home"></i> Home</a></li>
                    <li class="active">Edit '.ucfirst($controller_name).'</li>
                </ol>
            </div>
        </div>
        <!-- /. Content Header (Page header) -->

        <form method="post" action="<?php echo base_url() ?>'.$controller_name.'/update" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo %'.$controller_name.'["id"] ?>">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd ">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Edit '.ucfirst($controller_name).'</h4>
                            </div>
                        </div>
                        <div class="panel-body">';

                            
foreach ($fileds as $f) {
    $contents .= '<div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">'.str_replace("_"," ",ucfirst($f['name'])).'';
                                if ($f['required'] == 1) {
                                    $contents .= '<span class="required">*</span>';
                                    $req = 'required=""';
                                }
                                else{
                                    $req = ''; 
                                }
                                if ($f['type'] == 'INT') {
                                    $type = 'number';
                                }
                                elseif ($f['type'] == 'VARCHAR') {
                                    $type = 'text';
                                }
                                elseif ($f['type'] == 'TEXT') {
                                    $type = 'textarea';
                                }
                                elseif ($f['type'] == 'DATE') {
                                    $type = 'date';
                                }
                                $contents .='</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="'.$f['name'].'" type="'.$type.'" value="<?php  echo %'.$controller_name.'["'.$f['name'].'"] ?>" id="example-text-input" placeholder="" '.$req.'>
                                </div>

                            </div>';
}         
                            $contents .= '<div class="form-group row">

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
';
?>