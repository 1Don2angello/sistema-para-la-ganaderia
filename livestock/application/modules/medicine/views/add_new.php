<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($patient->id))
                    echo '<i class="fa fa-edit"></i> Edit Medicine';
                else
                    echo '<i class="fa fa-plus-circle"></i> Add New Medicine';
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
                                    <form role="form" action="medicine/addNew" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Shed No</label>
                                            <select name="no" class="form-control js-example-basic-single" id="exampleInputEmail1" placeholder="" style="width: 100%;" required>
                                                <?php foreach ($sheds as $shed) { ?>
                                                    <option  value="<?php echo $shed->no; ?>"> <?php echo $shed->no; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Medicine Duration</label>
                                            <input type="text" class="form-control" name="duration" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->duration)) {
                                                echo $medicine->duration;
                                            }
                                            ?>' placeholder="">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Previous Medicine Date</label>
                                            <input type="date" class="form-control" name="p_date" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->p_date)) {
                                                echo $medicine->p_date;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Next Medicine Date</label>
                                            <input type="date" class="form-control" name="n_date" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->n_date)) {
                                                echo $medicine->n_date;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Last Medicine Date</label>
                                            <input type="date" class="form-control" name="l_date" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->l_date)) {
                                                echo $medicine->l_date;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($medicine->id)) {
                                            echo $medicine->id;
                                        }
                                        ?>'>

                                        <section class="">
                                            <button type="submit" name="submit" class="btn btn-info submit_button">Submit</button>
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
