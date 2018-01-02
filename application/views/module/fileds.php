
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
                <h1>Add Fileds</h1>
                <small></small>
                <ol class="breadcrumb">
                    <li><a href="index.html"><i class="pe-7s-home"></i> Home</a></li>
                    <li class="active">Add Fileds</li>
                </ol>
            </div>
        </div>
        <!-- /. Content Header (Page header) -->

        <form method="post" action="<?php echo base_url() ?>modules/fields_insert" enctype="multipart/form-data">
            <input type="hidden" name="module_id" value="<?php echo $id ?>">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd ">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Add Fileds</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="after-add-sub">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Name<span class="required">*</span></label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="name[]" type="text" value="" id="example-text-input" placeholder="" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Type<span class="required">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="type[]" required="">
                                            <option>Select Type</option>
                                            <option value="INT">INT</option>
                                            <option value="VARCHAR">VARCHAR</option>
                                            <option value="TEXT">TEXT</option>
                                            <option value="DATE">DATE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">length<span class="required">*</span></label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="length[]" type="number" value="" id="example-text-input" placeholder="" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Required<span class="required">*</span></label>
                                    <div class="col-sm-9">
                                        <input name="required[0]" type="checkbox" value="1" id="example-text-input" placeholder="" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-2 delet pull-right">
                                        <button type="button" class="add-sub btn btn-success ">Add More</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
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
<script type="text/javascript">
    $("body").on("click",".add-sub",function(){
        var html = $(".after-add-sub").first().clone();
        $(html).find(".delet").html("<a class='btn btn-danger remove'><i class='fa fa-trash-o' aria-hidden='true'></i> </a> "+' <a class="btn btn-success add-sub"><strong> + </strong> </a>');
        $(".after-add-sub").last().after(html);
        $(".after-add-sub").last().find('input,select').not('input[type="checkbox"]').val('')
        $(".after-add-sub").last().find('input[type="checkbox"]').removeAttr('checked')
        var con = 0
        $(".after-add-sub").each(function() {
            $(this).find('input[type="checkbox"]').attr('name','required['+con+']')
            con++
        })
    });
    $("body").on("click",".remove",function(){
        $(this).parents(".after-add-sub").remove();
        var con = 0
        $(".after-add-sub").each(function() {
            $(this).find('input[type="checkbox"]').attr('name','required['+con+']')
            con++
        })
    });
</script>