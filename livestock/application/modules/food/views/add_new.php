<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($food->id))
                    echo '<i class="fa fa-edit"></i> '.lang('edit_food_history');
                else
                    echo '<i class="fa fa-plus-circle"></i> '.lang('add_food_history');
                ?>
            </header>
            <div class="panel-body col-md-6">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo $this->session->flashdata('feedback'); ?>
                                    <div class="col-lg-12">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <?php echo validation_errors(); ?>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                    <form role="form" action="food/addNew" id="editFoodForm" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php  echo lang('date'); ?></label>
                                            <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='<?php
                                            if (!empty($food->date)) {
                                                echo $food->date;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php  echo lang('food_consumption'); ?></label>
                                            <input type="text" class="form-control" name="consumption" id="consumption" value='<?php
                                            if (!empty($food->consumption)) {
                                                echo $food->consumption;
                                            }
                                            ?>' placeholder="">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php  echo lang('livestock_quantity'); ?></label>
                                            <input type="text" class="form-control" name="quantity" id="quantity" value='<?php
                                            if (!empty($food->quantity)) {
                                                echo $food->quantity;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php  echo lang('average_food_consumption'); ?></label>
                                            <input type="text" class="form-control" name="ave_consumption" id="ave_consumption" value='<?php
                                            if (!empty($food->ave_consumption)) {
                                                echo $food->ave_consumption;
                                            }
                                            ?>' placeholder="" readonly="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php  echo lang('note'); ?></label>
                                            <input type="text" class="form-control" name="note" id="exampleInputEmail1" value='<?php
                                            if (!empty($food->note)) {
                                                echo $food->note;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($food->id)) {
                                            echo $food->id;
                                        }
                                        ?>'>

                                        <section class="">
                                            <button type="submit" name="submit" class="btn btn-info submit_button"><?php  echo lang('submit'); ?></button>
                                        </section>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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