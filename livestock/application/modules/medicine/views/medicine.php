<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-money"></i> Medicines
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green btn_hover">
                                    Add New Medicine <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </a>
                        <button class="export" onclick="javascript:window.print();">Print</button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th>Medicine Id</th>
                                <th>Shed No</th> 
                                <th>Medicine Duration</th>                        
                                <th>Previous Medicine Date</th>
                                <th>Next Medicine Date</th>
                                <th>Last Medicine Date</th>
                                <th>Action</th>
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
                        <?php foreach ($medicines as $medicine) { ?>
                            <tr class="">
                                <td> <?php echo $medicine->medicine_id; ?></td>
                                <td> <?php echo $medicine->no; ?></td>
                                <td> <?php echo $medicine->duration; ?></td>
                                <td><?php echo $medicine->p_date; ?></td>
                                <td><?php echo $medicine->n_date; ?></td>
                                <td><?php echo $medicine->l_date; ?></td>
                                <td>
                                    <button type="button" class="btn btn-xs editbutton"  data-toggle="modal" data-id="<?php echo $medicine->id; ?>"><i class="fa fa-edit"></i>Edit</button>                                   
                                    <a class="" href="medicine/delete?id=<?php echo $medicine->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><button type="button" class="btn btn-xs"><i class="fa fa-times"></i>Delete</button></i></a>
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
                <h4 class="modal-title"><strong><i class="fa fa-plus-circle"></i> Add New Medicine</strong></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="medicine/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Shed No</label>
                         <select name="no" class="form-control js-example-basic-single" id="exampleInputEmail1" placeholder="" style="width: 100%;" required>
                            <?php foreach ($sheds as $shed) { ?>
                                <option  value="<?php echo $shed->no; ?>"> <?php echo $shed->no; ?></option>
                            <?php } ?>
                        </select> </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Medicine Duration</label>
                        <input type="text" class="form-control" name="duration" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Previous Medicine Date</label>
                        <input type="date" class="form-control" name="p_date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Next Medicine Date</label>
                        <input type="date" class="form-control" name="n_date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Last Medicine Date</label>
                        <input type="date" class="form-control" name="l_date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="m_id" value=''>

                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button">Submit</button>
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
                <h4 class="modal-title"><strong><i class="fa fa-edit"></i> Edit Medicine</strong></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="medicineEditForm" action="medicine/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Shed No</label>
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
                        <label for="exampleInputEmail1">Medicine Duration</label>
                        <input type="text" class="form-control" name="duration" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Previous Medicine Date</label>
                        <input type="date" class="form-control" name="p_date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Next Medicine Date</label>
                        <input type="date" class="form-control" name="n_date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Last Medicine Date</label>
                        <input type="date" class="form-control" name="l_date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="m_id" value=''>

                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button">Submit</button>
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
                                                url: 'medicine/editMedicineByJason?id=' + iid,
                                                method: 'GET',
                                                data: '',
                                                dataType: 'json',
                                            }).success(function (response) {
                                                // Populate the form fields with the data returned from server
                                                $('#medicineEditForm').find('[name="id"]').val(response.medicine.id).end()
                                                $('#medicineEditForm').find('[name="duration"]').val(response.medicine.duration).end()
                                                $('#medicineEditForm').find('[name="p_date"]').val(response.medicine.p_date).end()
                                                $('#medicineEditForm').find('[name="n_date"]').val(response.medicine.n_date).end()
                                                $('#medicineEditForm').find('[name="l_date"]').val(response.medicine.l_date).end()
                                                $('#medicineEditForm').find('[name="no"]').val(response.medicine.no).end()
                                                $('#medicineEditForm').find('[name="m_id"]').val(response.medicine.medicine_id).end()
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


