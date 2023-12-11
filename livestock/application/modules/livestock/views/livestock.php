<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-home"></i> <?php  echo lang('livestocks'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green btn_hover">
                                 <i class="fa fa-plus-circle"></i>   <?php  echo lang('add_new_livestock'); ?>  
                                </button>
                            </div>
                        </a>
                        <button class="export" onclick="javascript:window.print();"><?php  echo lang('print'); ?></button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">  
                        <thead>
                            <tr>
                                <th><?php  echo lang('livestock_id'); ?></th>
                                <th><?php  echo lang('livestock_name'); ?></th> 
                                <th><?php  echo lang('date'); ?></th>                        
                                <th><?php  echo lang('note'); ?></th>
                                <th><?php echo lang('option'); ?></th>
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
                        <?php foreach ($livestocks as $livestock) { ?>
                            <tr class="">
                                <td> <?php echo $livestock->livestock_id; ?></td>
                                <td> <?php echo $livestock->livestock_name; ?></td>

                                <td><?php echo $livestock->date; ?></td>
                                <td><?php echo $livestock->note; ?></td>

                                <td>
                                    <button type="button" class="btn btn-xs editbutton"   data-toggle="modal" data-id="<?php echo $livestock->id; ?>"><i class="fa fa-edit"></i> <?php  echo lang('edit'); ?></button>                                  
                                    <a class="" href="livestock/delete?id=<?php echo $livestock->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><button type="button" class="btn btn-xs  "><i class="fa fa-times"></i> <?php  echo lang('delete'); ?></button></i></a>
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
                <h4 class="modal-title"><strong><i class="fa fa-plus-circle"></i> <?php  echo lang('add_new_livestock'); ?></strong></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="livestock/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('livestock_name'); ?></label>
                        <input type="text" class="form-control" name="livestock_name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('quantity'); ?></label>
                        <input type="text" class="form-control" name="quantity" id="exampleInputEmail1" value='' placeholder="">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('note'); ?></label>
                        <input type="text" class="form-control" name="note" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="l_id" value=''>

                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button"><?php  echo lang('submit'); ?></button>
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
                <h4 class="modal-title"><strong><i class="fa fa-edit"></i> <?php  echo lang('edit_livestock'); ?></strong></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="livestockEditForm" action="livestock/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('livestock_name'); ?></label>
                        <input type="text" class="form-control" name="livestock_name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('quantity'); ?></label>
                        <input type="text" class="form-control" name="quantity" id="exampleInputEmail1" value='' placeholder="">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('note'); ?></label>
                        <input type="text" class="form-control" name="note" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="l_id" value=''>

                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button"><?php  echo lang('submit'); ?></button>
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
                                                    url: 'livestock/editLivestockByJason?id=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).success(function (response) {
                                                    // Populate the form fields with the data returned from server
                                                    $('#livestockEditForm').find('[name="id"]').val(response.livestock.id).end()
                                                    $('#livestockEditForm').find('[name="livestock_name"]').val(response.livestock.livestock_name).end()
                                                    $('#livestockEditForm').find('[name="date"]').val(response.livestock.date).end()
                                                    $('#livestockEditForm').find('[name="note"]').val(response.livestock.note).end()
                                                    $('#livestockEditForm').find('[name="quantity"]').val(response.livestock.quantity).end()

                                                    $('#livestockEditForm').find('[name="l_id"]').val(response.livestock.livestock_id).end()
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


