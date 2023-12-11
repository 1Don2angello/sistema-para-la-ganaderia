<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-user"></i> <?php  echo lang('staff'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green btn_hover">
                                <i class="fa fa-plus-circle"></i>     <?php  echo lang('add_new_staff'); ?>
                                </button>
                            </div>
                        </a>
                        <button class="export" onclick="javascript:window.print();"><?php  echo lang('print'); ?></button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php  echo lang('staff_id'); ?></th>                        
                                <th><?php  echo lang('image'); ?></th>
                                <th><?php  echo lang('name'); ?></th>
                                <th class="center"><?php  echo lang('email'); ?></th>                                
                                <th><?php  echo lang('phone'); ?></th>
                                <th><?php  echo lang('address'); ?></th>
                                <th><?php  echo lang('options'); ?></th>
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
                        <?php foreach ($staffs as $staff) { ?>
                            <tr class="">
                                <td> <?php echo $staff->staff_id; ?></td>
                                <td style="width:10%;"><img style="width:95%;" src="<?php echo $staff->img_url; ?>"></td>
                                <td> <?php echo $staff->name; ?></td>
                                <td><?php echo $staff->email; ?></td>                              
                                <td><?php echo $staff->phone; ?></td>
                                <td><?php echo $staff->address; ?></td>
                                <td>
                                    <button type="button" class="btn btn-xs editbutton" data-toggle="modal" data-id="<?php echo $staff->id; ?>"><i class="fa fa-edit"></i> <?php  echo lang('edit'); ?></button>                                
                                    <a class="" href="staff/delete?id=<?php echo $staff->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><button type="button" class="btn btn-xs"><i class="fa fa-times"></i> <?php  echo lang('delete'); ?></button></i></a>
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
                <h4 class="modal-title"><strong><i class="fa fa-plus-circle"></i> <?php  echo lang('add_new_staff'); ?></strong></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="staff/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                   

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="s_id" value=''>

                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button"><?php  echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Client -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><strong><i class="fa fa-edit"></i> <?php  echo lang('edit_staff'); ?></strong></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="staffEditForm" action="staff/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('email'); ?></label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                   
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>
                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="s_id" value=''>


                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button"><?php  echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<!-- Javascript For Edit Staff -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">


                                        $(document).ready(function () {
                                            $(".editbutton").click(function (e) {
                                                e.preventDefault(e);
                                                // Get the record's ID via attribute  
                                                var iid = $(this).attr('data-id');
                                                $.ajax({
                                                    url: 'staff/editStaffByJason?id=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).success(function (response) {
                                                    // Populate the form fields with the data returned from server
                                                    $('#staffEditForm').find('[name="id"]').val(response.staff.id).end()
                                                    $('#staffEditForm').find('[name="s_id"]').val(response.staff.staff_id).end()
                                                    $('#staffEditForm').find('[name="name"]').val(response.staff.name).end()
                                                    $('#staffEditForm').find('[name="email"]').val(response.staff.email).end()
                                                  
                                                    $('#staffEditForm').find('[name="phone"]').val(response.staff.phone).end()
                                                    $('#staffEditForm').find('[name="address"]').val(response.staff.address).end()

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


