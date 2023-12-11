<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-home"></i> <?php echo lang('sheds'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green btn_hover">
                                    <i class="fa fa-plus-circle"></i>     <?php echo lang('add_new_shed'); ?>
                                </button>
                            </div>
                        </a>
                        <button class="export" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">  
                        <thead>
                            <tr>
                                <th><?php echo lang('shed_id'); ?></th>
                                <th><?php echo lang('shed_no'); ?></th> 
                                <th><?php echo lang('livestock_type'); ?></th>                        
                                <th><?php echo lang('purchase_date'); ?></th>
                                <th><?php echo lang('age_days'); ?></th>
                                <th><?php echo lang('quantity'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <style>

                            .img_url{
                                height:20px;
                                width:20px;
                                background-size: contain; 
                                max-height:20px;
                                border-radius: 100px;
                            }
                        </style>
                        <?php foreach ($sheds as $shed) { ?>
                            <tr class="">
                                <td> <?php echo $shed->shed_id; ?></td>
                                <td> <?php echo $shed->no; ?></td>
                                <td> <?php echo $shed->chicken_type; ?></td>
                                <td><?php echo $shed->date; ?></td>
                                <td><?php echo $shed->age; ?></td>
                                <td><?php echo $shed->quantity; ?></td>
                                <td>
                                    <button type="button" class="btn btn-xs editbutton"   data-toggle="modal" data-id="<?php echo $shed->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>                                  
                                    <a class="" href="shed/delete?id=<?php echo $shed->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><button type="button" class="btn btn-xs  "><i class="fa fa-times"></i> <?php echo lang('delete'); ?></button></i></a>
                                </td>
                            </tr>

                        <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><strong><i class="fa fa-plus-circle"></i> <?php echo lang('add_new_shed'); ?></strong></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="shed/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('shed_no'); ?></label>
                        <input type="text" class="form-control" name="no" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('livestock_type'); ?></label>
                        <select name="chicken_type" class="form-control js-example-basic-single" id="exampleInputEmail1" placeholder="" style="width: 100%;" required>
                            <?php foreach ($livestocks as $livestock) { ?>
                                <option  value="<?php echo $livestock->livestock_name; ?>"> <?php echo $livestock->livestock_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('purchase_date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('age_days'); ?></label>
                        <input type="text" class="form-control" name="age" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('quantity'); ?></label>
                        <input type="text" class="form-control" name="quantity" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="s_id" value=''>

                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Car -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><strong><i class="fa fa-edit"></i> <?php echo lang('edit_shed'); ?></strong></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="shedEditForm" action="shed/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('shed_no'); ?></label>
                        <input type="text" class="form-control" name="no" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('livestock_type'); ?></label>
                        <select name="chicken_type" class="form-control js-example-basic-single " id="exampleInputEmail1" style="width: 100%;">
                            <?php foreach ($livestocks as $livestock) { ?>
                                <option  value="<?php echo $livestock->livestock_name; ?>" <?php
                                if ($livestock->livestock_name == $livestock->livestock_name) {
                                    echo 'selected';
                                }
                                ?>> <?php echo $livestock->livestock_name; ?></option>  
                                     <?php } ?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('purchase_date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('age_days'); ?></label>
                        <input type="text" class="form-control" name="age" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('quantity'); ?></label>
                        <input type="text" class="form-control" name="quantity" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="s_id" value=''>

                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Payment To That Car -->

<!-- Javascript For Edit Trip -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">


                                        $(document).ready(function () {
                                            $(".editbutton").click(function (e) {
                                                e.preventDefault(e);
                                                // Get the record's ID via attribute  
                                                var iid = $(this).attr('data-id');
                                                $.ajax({
                                                    url: 'shed/editShedByJason?id=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).success(function (response) {
                                                    // Populate the form fields with the data returned from server
                                                    $('#shedEditForm').find('[name="id"]').val(response.shed.id).end()
                                                    $('#shedEditForm').find('[name="chicken_type"]').val(response.shed.chicken_type).end()
                                                    $('#shedEditForm').find('[name="date"]').val(response.shed.date).end()
                                                    $('#shedEditForm').find('[name="age"]').val(response.shed.age).end()
                                                    $('#shedEditForm').find('[name="quantity"]').val(response.shed.quantity).end()
                                                    $('#shedEditForm').find('[name="no"]').val(response.shed.no).end()
                                                    $('#shedEditForm').find('[name="s_id"]').val(response.shed.shed_id).end()
                                                    $('#myModal2').modal('show');
                                                });

                                            });
                                        });

</script>


<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>


