<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-money"></i> <?php echo lang('vaccines'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green btn_hover">
                                    <i class="fa fa-plus-circle"></i>     <?php echo lang('add_new_vaccine'); ?>
                                </button>
                            </div>
                        </a>
                        <button class="export" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('vaccine_id'); ?></th>
                                <th><?php echo lang('shed_no'); ?></th> 
                                <th><?php echo lang('vaccine_name'); ?></th>                        
                                <th><?php echo lang('last_date'); ?></th>
                                <th><?php echo lang('next_date'); ?></th>
                                <th><?php echo lang('vaccine_duration_days'); ?></th>

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
                        <?php foreach ($vaccines as $vaccine) { ?>
                            <tr class="">
                                <td> <?php echo $vaccine->vaccine_id; ?></td>
                                <td> <?php echo $vaccine->no; ?></td>
                                <td> <?php echo $vaccine->name; ?></td>
                                <td><?php echo $vaccine->l_date; ?></td>
                                <td><?php echo $vaccine->n_date; ?></td>
                                <td><?php echo $vaccine->duration; ?></td>

                                <td>
                                    <button type="button" class="btn btn-xs editbutton"  data-toggle="modal" data-id="<?php echo $vaccine->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>                                  
                                    <a class="" href="vaccine/delete?id=<?php echo $vaccine->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><button type="button" class="btn btn-xs"><i class="fa fa-times"></i> <?php echo lang('delete'); ?></button></i></a>
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
                <h4 class="modal-title"><strong><i class="fa fa-plus-circle"></i> <?php echo lang('add_new_vaccine'); ?></strong></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="vaccine/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('shed_no'); ?></label>
                        <select name="no" class="form-control js-example-basic-single" id="exampleInputEmail1" placeholder="" style="width: 100%;" required>
                            <?php foreach ($sheds as $shed) { ?>
                                <option  value="<?php echo $shed->no; ?>"> <?php echo $shed->no; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('vaccine_name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('last_date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="l_date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('next_date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="n_date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('vaccine_duration_days'); ?></label>
                        <input type="text" class="form-control" name="duration" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="v_id" value=''>

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
                <h4 class="modal-title"><strong><i class="fa fa-edit"></i> <?php echo lang('edit_vaccine'); ?></strong></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="vaccineEditForm" action="vaccine/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('shed_no'); ?></label>
                        <select name="no" class="form-control js-example-basic-single " id="exampleInputEmail1" style="width: 100%;">
                            <?php foreach ($sheds as $shed) { ?>
                                <option  value="<?php echo $shed->no; ?>" <?php
                                if ($shed->no == $shed->no) {
                                    echo 'selected';
                                }
                                ?>> <?php echo $shed->no; ?></option>  
                                     <?php } ?> 
                        </select></div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('vaccine_name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder=""> 
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('last_date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="l_date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('next_date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="n_date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('vaccine_duration_days'); ?></label>
                        <input type="text" class="form-control" name="duration" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="v_id" value=''>

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
                                                    url: 'vaccine/editVaccineByJason?id=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).success(function (response) {
                                                    // Populate the form fields with the data returned from server
                                                    $('#vaccineEditForm').find('[name="id"]').val(response.vaccine.id).end()
                                                    $('#vaccineEditForm').find('[name="name"]').val(response.vaccine.name).end()
                                                    $('#vaccineEditForm').find('[name="l_date"]').val(response.vaccine.l_date).end()
                                                    $('#vaccineEditForm').find('[name="n_date"]').val(response.vaccine.n_date).end()
                                                    $('#vaccineEditForm').find('[name="duration"]').val(response.vaccine.duration).end()
                                                    $('#vaccineEditForm').find('[name="no"]').val(response.vaccine.no).end()
                                                    $('#vaccineEditForm').find('[name="v_id"]').val(response.vaccine.vaccine_id).end()
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


