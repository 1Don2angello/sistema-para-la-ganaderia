<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($purchase->id))
                    echo '<i class="fa fa-edit"></i> '. lang('edit_purchase');
                else
                    echo '<i class="fa fa-plus-circle"></i> '. lang('add_new_purchase') ;
                ?>
            </header>


            <style>


                form {
                    border: 1px solid #ccc;
                    padding: 23px;
                    background: #fff;
                    height: 1000px;
                    clear: both;
                }

                .note{
                    padding-left: 0px;
                    padding-right: 0px; 
                }


            </style>


            <div class="panel">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo validation_errors(); ?>
                                    <form role="form" action="purchase/addPurchase" method="post" id="editPurchaseForm" enctype="multipart/form-data">
                                        <div class="col-md-12">
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> <?php  echo lang('reference'); ?> </label>
                                                    <input type="text" class="form-control" name="reference" id="exampleInputEmail1" value='<?php
                                                    if (!empty($purchase->reference)) {
                                                        echo $purchase->reference;
                                                    }
                                                    ?>' placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> <?php  echo lang('date'); ?> </label>
                                                    <input type="text" class="form-control default-date-picker" name="date" id="exampleInputEmail1" value='<?php
                                                    if (!empty($purchase->date)) {
                                                        echo date($settings->date_format, $purchase->date);
                                                    }
                                                    ?>' placeholder="">
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> <?php  echo lang('product'); ?> </label>
                                                    <select class="form-control m-bot15" name="product" value=''>
                                                        <?php foreach ($products as $product) { ?>
                                                            <option value="<?php echo $product->id; ?>" <?php
                                                            if (!empty($purchase->product)) {
                                                                if ($purchase->product == $product->id) {
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?> > <?php echo $product->name; ?> </option>
                                                                <?php } ?> 
                                                    </select>
                                                </div>


                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> <?php  echo lang('supplier'); ?> </label>
                                                    <select class="form-control m-bot15" name="supplier" value=''>
                                                        <?php foreach ($suppliers as $supplier) { ?>
                                                            <option value="<?php echo $supplier->id; ?>" <?php
                                                            if (!empty($purchase->supplier)) {
                                                                if ($purchase->supplier == $supplier->id) {
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?> > <?php echo $supplier->name; ?> </option>
                                                                <?php } ?> 
                                                    </select>
                                                </div>




                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> <?php  echo lang('status'); ?> </label>
                                                    <select id="paid_by" class="form-control m-bot15" name="status" value=''>
                                                        <option value="received"><?php  echo lang('received'); ?></option>
                                                        <option value="ordered"><?php  echo lang('ordered'); ?></option>
                                                    </select>
                                                </div>



                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> <?php  echo lang('unit_price'); ?> </label>
                                                    <input type="text" class="form-control" name="unit_price" id="price" value='<?php
                                                    if (!empty($purchase->unit_price)) {
                                                        echo $purchase->unit_price;
                                                    }
                                                    ?>' placeholder="">
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> <?php  echo lang('quantity'); ?> </label>
                                                    <input type="text" class="form-control" name="quantity" id="qty" value='<?php
                                                    if (!empty($purchase->quantity)) {
                                                        echo $purchase->quantity;
                                                    }
                                                    ?>' placeholder="">
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> <?php  echo lang('sub_total'); ?> </label>
                                                    <input type="text" class="form-control" name="sub_total" id="sub_total" value='' placeholder="" readonly="">
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> <?php  echo lang('discount'); ?> </label>
                                                    <input type="text" class="form-control" name="discount" id="discount" value='<?php
                                                    if (!empty($purchase->discount)) {
                                                        echo $purchase->discount;
                                                    }
                                                    ?>' placeholder="">
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> <?php  echo lang('amount_payable'); ?></label>
                                                    <input type="text" class="form-control" name="amount_payable" id="amount_payable" value='' placeholder="" readonly="">
                                                </div>





                                            </div>
                                        </div>

                                        <div class="col-md-12"> 
                                            <div class="form-group col-md-12">
                                                <label class="control-label col-md-3 note"><?php  echo lang('note'); ?></label>
                                                <div class="col-md-12 note">
                                                    <textarea class="ckeditor form-control" name="note" value="<?php
                                                    if (!empty($department->note)) {
                                                        echo $department->note;
                                                    }
                                                    ?>" rows="5"></textarea>
                                                </div>
                                            </div>

                                            <input type="hidden" name="id" value='<?php
                                            if (!empty($purchase->id)) {
                                                echo $purchase->id;
                                            }
                                            ?>'>

                                            <input type="hidden" name="supplier_id" value='<?php
                                            if (!empty($supplier_id)) {
                                                echo $supplier_id;
                                            }
                                            ?>'>
                                            <div class="form-group col-md-12">
                                                <button type="submit" name="submit" class="btn btn-info"> <?php  echo lang('submit'); ?> </button>
                                            </div>
                                        </div>


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



<!-- page end--><script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>


    $(document).ready(function () {
        $('#price').keyup(function () {
            var price = 0;
            var qty = 0;
            var sub_total = 0;
            var discount = 0;
            var amount_payable = 0;
            qty = $('#qty').val();
            price = this.value;
            sub_total = price * qty;
            discount = $('#discount').val();
            amount_payable = sub_total - discount;

            $('#editPurchaseForm').find('[name="sub_total"]').val(sub_total)
            $('#editPurchaseForm').find('[name="amount_payable"]').val(amount_payable)
        });

        $('#qty').keyup(function () {
            var price = 0;
            var qty = 0;
            var sub_total = 0;
            var discount = 0;
            var amount_payable = 0;
            qty = this.value;
            price = $('#price').val();
            sub_total = price * qty;
            discount = $('#discount').val();
            amount_payable = sub_total - discount;

            $('#editPurchaseForm').find('[name="sub_total"]').val(sub_total)
            $('#editPurchaseForm').find('[name="amount_payable"]').val(amount_payable)
        });

        $('#discount').keyup(function () {
            var price = 0;
            var qty = 0;
            var sub_total = 0;
            var discount = 0;
            var amount_payable = 0;
            qty = $('#qty').val();
            price = $('#price').val();
            sub_total = price * qty;
            discount = this.value;
            amount_payable = sub_total - discount;

            $('#editPurchaseForm').find('[name="sub_total"]').val(sub_total)
            $('#editPurchaseForm').find('[name="amount_payable"]').val(amount_payable)
        });
    });




</script>

<script>


    $(document).ready(function () {

        var price = 0;
        var qty = 0;
        var sub_total = 0;
        var discount = 0;
        var amount_payable = 0;
        qty = $('#qty').val();
        price = $('#price').val();
        sub_total = price * qty;
        discount = $('#discount').val();
        amount_payable = sub_total - discount;

        $('#editPurchaseForm').find('[name="sub_total"]').val(sub_total)
        $('#editPurchaseForm').find('[name="amount_payable"]').val(amount_payable)


    });


</script>