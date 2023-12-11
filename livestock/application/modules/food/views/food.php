<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-sitemap"></i> <?php  echo lang('food_consumption_history'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green btn_hover">
                                <i class="fa fa-plus-circle"></i>    <?php  echo lang('add_food_history'); ?> 
                                </button>
                            </div>
                        </a>
                        <button class="export" onclick="javascript:window.print();"><?php  echo lang('print'); ?></button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php  echo lang('food_id'); ?></th>
                                <th><?php  echo lang('date'); ?></th> 
                                <th><?php  echo lang('food_consumption'); ?></th>                        
                                <th><?php  echo lang('livestock_quantity'); ?></th>
                                <th><?php  echo lang('average_food_consumption'); ?></th>
                                <th><?php  echo lang('note'); ?></th>
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
                        <?php foreach ($foods as $food) { ?>
                            <tr class="">
                                <td> <?php echo $food->food_id; ?></td>
                                <td> <?php echo $food->date; ?></td>
                                <td> <?php echo $food->consumption; ?></td>
                                <td><?php echo $food->quantity; ?></td>
                                <td><?php echo $food->ave_consumption; ?></td>
                                <td><?php echo $food->note; ?></td>
                                <td>
                                    <a class="" href="food/editFood?id=<?php echo $food->id; ?>" ><button type="button" class="btn btn-xs"><i class="fa fa-edit"></i> <?php  echo lang('edit'); ?></button></i></a>
                                <a class="" href="food/delete?id=<?php echo $food->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><button type="button" class="btn btn-xs"><i class="fa fa-times"></i> <?php  echo lang('delete'); ?></button></i></a>
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
                <h4 class="modal-title"><strong><i class="fa fa-plus-circle"></i> <?php  echo lang('add_food_history'); ?></strong></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="food/addNew" method="post" id="editFoodForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('food_consumption'); ?></label>
                        <input type="text" class="form-control" name="consumption" id="consumption" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('livestock_quantity'); ?></label>
                        <input type="text" class="form-control" name="quantity" id="quantity" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('average_food_consumption'); ?></label>
                        <input type="text" class="form-control" name="ave_consumption" id="ave_consumption" value='' placeholder="" readonly="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('note'); ?></label>
                        <input type="text" class="form-control" name="note" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="f_id" value=''>

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
                <h4 class="modal-title"><strong><i class="fa fa-edit"></i> <?php  echo lang('edit_food_history'); ?></strong></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editFoodForm" action="food/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('food_consumption'); ?></label>
                        <input type="text" class="form-control" name="consumption" id="consumption" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('livestock_quantity'); ?></label>
                        <input type="text" class="form-control" name="quantity" id="quantity" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('average_food_consumption'); ?></label>
                        <input type="text" class="form-control" name="ave_consumption" id="ave_consumption" value='' placeholder="" readonly="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php  echo lang('note'); ?></label>
                        <input type="text" class="form-control" name="note" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="f_id" value=''>

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
                                                url: 'food/editFoodByJason?id=' + iid,
                                                method: 'GET',
                                                data: '',
                                                dataType: 'json',
                                            }).success(function (response) {
                                                // Populate the form fields with the data returned from server
                                                $('#editFoodForm').find('[name="id"]').val(response.food.id).end()
                                                $('#editFoodForm').find('[name="date"]').val(response.food.date).end()
                                                $('#editFoodForm').find('[name="consumption"]').val(response.food.consumption).end()                                                
                                                $('#editFoodForm').find('[name="ave_consumption"]').val(response.food.ave_consumption).end()
                                                $('#editFoodForm').find('[name="quantity"]').val(response.food.quantity).end()
                                                $('#editFoodForm').find('[name="note"]').val(response.food.note).end()
                                                $('#editFoodForm').find('[name="f_id"]').val(response.food.food_id).end()
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

<script>


    $(document).ready(function () {
        $('#consumption').keyup(function () {
            var consumption = 0;
            var quantity = 0;
            var ave_consumption = 0;

            quantity = $('#quantity').val();
            consumption = this.value;
            ave_consumption = consumption / quantity;


            $('#editFoodForm').find('[name="ave_consumption"]').val(ave_consumption)

        });

        $('#quantity').keyup(function () {
            var consumption = 0;
            var quantity = 0;
            var ave_consumption = 0;

            quantity = this.value;
            consumption = $('#consumption').val();
            ave_consumption = consumption / quantity;


            $('#editFoodForm').find('[name="ave_consumption"]').val(ave_consumption)

        });


    });




</script>
<script>


    $(document).ready(function () {

        var consumption = 0;
        var quantity = 0;
        var ave_consumption = 0;
       
        quantity = $('#quantity').val();
        consumption = $('#consumption').val();
        ave_consumption = consumption / quantity;
        

        $('#editFoodForm').find('[name="ave_consumption"]').val(ave_consumption)
       


    });


</script>