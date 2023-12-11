<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($patient->id))
                    echo '<i class="fa fa-edit"></i> ' . lang('edit_product');
                else
                    echo '<i class="fa fa-plus-circle"></i> ' . lang('add_new_product');
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
                                    <form role="form" action="product/addNew" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('product_code'); ?></label>
                                            <input type="text" class="form-control" name="code" id="exampleInputEmail1" value='<?php
                                            if (!empty($product->code)) {
                                                echo $product->code;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('product_name'); ?></label>
                                            <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                                            if (!empty($product->name)) {
                                                echo $product->name;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('category'); ?></label>
                                            <select name="category" class="form-control js-example-basic-single" id="exampleInputEmail1" placeholder="" style="width: 100%;" required>
                                                <?php foreach ($categorys as $category) { ?>
                                                    <option  value="<?php echo $category->category; ?>"> <?php echo $category->category; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('cost'); ?> </label>
                                            <input type="text" class="form-control" name="cost" id="exampleInputEmail1" value='<?php
                                            if (!empty($product->cost)) {
                                                echo $product->cost;
                                            }
                                            ?>' placeholder="">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('product_price'); ?></label>
                                            <input type="text" class="form-control" name="price" id="exampleInputEmail1" value='<?php
                                            if (!empty($product->price)) {
                                                echo $product->price;
                                            }
                                            ?>' placeholder="">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('quantity'); ?></label>
                                            <input type="text" class="form-control" name="quantity" id="exampleInputEmail1" value='<?php
                                            if (!empty($product->quantity)) {
                                                echo $product->quantity;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('type'); ?></label>
                                            <input type="text" class="form-control" name="type" id="exampleInputEmail1" value='<?php
                                            if (!empty($product->type)) {
                                                echo $product->type;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('note'); ?></label>
                                            <input type="text" class="form-control" name="note" id="exampleInputEmail1" value='<?php
                                            if (!empty($product->note)) {
                                                echo $product->note;
                                            }
                                            ?>' placeholder="">
                                        </div>

                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($product->id)) {
                                            echo $product->id;
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
