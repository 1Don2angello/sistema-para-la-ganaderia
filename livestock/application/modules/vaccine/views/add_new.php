<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($patient->id))
                    echo '<i class="fa fa-edit"></i> '. lang('edit_vaccine');
                else
                    echo '<i class="fa fa-plus-circle"></i> '. lang('add_new_vaccine');
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
                                            <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                                            if (!empty($vaccine->name)) {
                                                echo $vaccine->name;
                                            }
                                            ?>' placeholder="">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('last_date'); ?></label>
                                            <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="l_date" id="exampleInputEmail1" value='<?php
                                            if (!empty($vaccine->l_date)) {
                                                echo $vaccine->l_date;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                         <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('next_date'); ?></label>
                                            <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="n_date" id="exampleInputEmail1" value='<?php
                                            if (!empty($vaccine->n_date)) {
                                                echo $vaccine->n_date;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('vaccine_duration_days'); ?></label>
                                            <input type="text" class="form-control" name="duration" id="exampleInputEmail1" value='<?php
                                            if (!empty($vaccine->duration)) {
                                                echo $vaccine->duration;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                       
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($vaccine->id)) {
                                            echo $vaccine->id;
                                        }
                                        ?>'>

                                        <section class="">
                                            <button type="submit" name="submit" class="btn btn-info submit_button"><?php echo lang('submit'); ?></button>
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
