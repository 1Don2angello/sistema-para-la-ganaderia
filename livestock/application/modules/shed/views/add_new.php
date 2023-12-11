<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($patient->id))
                    echo '<i class="fa fa-edit"></i> '. lang('edit_shed');
                else
                    echo '<i class="fa fa-plus-circle"></i> '. lang('add_new_shed');
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
                                    <form role="form" action="shed/addNew" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php  echo lang('shed_no'); ?></label>
                                            <input type="text" class="form-control" name="no" id="exampleInputEmail1" value='<?php
                                            if (!empty($shed->no)) {
                                                echo $shed->no;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                         <div class="form-group">
                                                    <label for="exampleInputEmail1">   <?php  echo lang('livestock_type'); ?></label>
                                                    <select class="form-control m-bot15" name="chicken_type" value=''>
                                                        <?php foreach ($livestocks as $livestock) { ?>
                                                            <option value="<?php echo $livestock->livestock_name; ?>" <?php
                                                            if (!empty($shed->chicken_type)) {
                                                                if ($shed->chicken_type == $livestock->chicken_type) {
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?> > <?php echo $livestock->livestock_name; ?> </option>
                                                                <?php } ?> 
                                                    </select>
                                                </div>
                                        
                                       

                                        <div class="form-group">
                                                <label for="exampleInputEmail1"> <?php  echo lang('purchase_date'); ?></label>
                                                <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='<?php
                                            if (!empty($shed->date)) {
                                                echo $shed->date;
                                            }
                                            ?>' placeholder="">
                                            </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">  <?php  echo lang('age_days'); ?></label>
                                            <input type="text" class="form-control" name="age" id="exampleInputEmail1" value='<?php
                                            if (!empty($shed->age)) {
                                                echo $shed->age;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php  echo lang('quantity'); ?></label>
                                            <input type="text" class="form-control" name="quantity" id="exampleInputEmail1" value='<?php
                                            if (!empty($shed->quantity)) {
                                                echo $shed->quantity;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($shed->id)) {
                                            echo $shed->id;
                                        }
                                        ?>'>

                                        <section class="">
                                            <button type="submit" name="submit" class="btn btn-info submit_button"> <?php  echo lang('submit'); ?></button>
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
