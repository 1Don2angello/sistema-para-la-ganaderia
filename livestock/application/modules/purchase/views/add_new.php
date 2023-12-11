<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($patient->id))
                    echo '<i class="fa fa-edit"></i> ' . lang('edit_purchase');
                else
                    echo '<i class="fa fa-plus-circle"></i> ' . lang('add_new_purchase'); 
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
                                    <form role="form" action="purchase/addNew" method="post" id="editPurchaseForm" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php  echo lang('purchase_date'); ?></label>
                                            <input type="date" class="form-control" name="date" id="exampleInputEmail1" value='<?php
                                            if (!empty($purchase->date)) {
                                                echo $purchase->date;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php  echo lang('supplier'); ?></label>
                                            <select name="supplier" class="form-control js-example-basic-single" id="exampleInputEmail1" placeholder="" style="width: 100%;" required>
                                                <?php foreach ($suppliers as $supplier) { ?>
                                                    <option  value="<?php echo $supplier->name; ?>"> <?php echo $supplier->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php  echo lang('product_name'); ?></label>
                                            <select name="product" class="form-control js-example-basic-single" id="exampleInputEmail1" placeholder="" style="width: 100%;" required>
                                                <?php foreach ($products as $product) { ?>
                                                    <option  value="<?php echo $product->name; ?>"> <?php echo $product->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php  echo lang('status'); ?></label>
                                            <select id="status" class="form-control m-bot15" name="status" value=''>
                                                <option value="received"><?php  echo lang('recived'); ?> </option>
                                                <option value="ordered"><?php  echo lang('ordered'); ?></option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php  echo lang('unit_price'); ?></label>
                                            <input type="text" class="form-control" name="unit_price" id="unit_price" value='<?php
                                            if (!empty($purchase->unit_price)) {
                                                echo $purchase->unit_price;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php  echo lang('quantity'); ?></label>
                                            <input type="text" class="form-control" name="quantity" id="quantity" value='<?php
                                            if (!empty($purchase->quantity)) {
                                                echo $purchase->quantity;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php  echo lang('subtotal'); ?></label>
                                            <input type="text" class="form-control" name="sub_total" id="sub_total" value='<?php
                                            if (!empty($purchase->sub_total)) {
                                                echo $purchase->sub_total;
                                            }
                                            ?>' placeholder="" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php  echo lang('discount'); ?></label>
                                            <input type="text" class="form-control" name="discount" id="discount" value='<?php
                                            if (!empty($purchase->discount)) {
                                                echo $purchase->discount;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php  echo lang('amount_payable'); ?></label>
                                            <input type="text" class="form-control" name="amount_payable" id="amount_payable" value='<?php
                                            if (!empty($purchase->amount_payable)) {
                                                echo $purchase->amount_payable;
                                            }
                                            ?>' placeholder="" disabled>
                                        </div>

                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($purchase->id)) {
                                            echo $purchase->id;
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
        $('#unit_price').keyup(function () {
            var unit_price = 0;
            var quantity = 0;
            var sub_total = 0;
            var discount = 0;
            var amount_payable = 0;
            quantity = $('#quantity').val();
            unit_price = this.value;
            sub_total = unit_price * quantity;
            discount = $('#discount').val();
            amount_payable = sub_total - discount;

            $('#editPurchaseForm').find('[name="sub_total"]').val(sub_total)
            $('#editPurchaseForm').find('[name="amount_payable"]').val(amount_payable)
        });

        $('#quantity').keyup(function () {
            var unit_price = 0;
            var quantity = 0;
            var sub_total = 0;
            var discount = 0;
            var amount_payable = 0;
            quantity = this.value;
            unit_price = $('#unit_price').val();
            sub_total = unit_price * quantity;
            discount = $('#discount').val();
            amount_payable = sub_total - discount;

            $('#editPurchaseForm').find('[name="sub_total"]').val(sub_total)
            $('#editPurchaseForm').find('[name="amount_payable"]').val(amount_payable)
        });

        $('#discount').keyup(function () {
            var unit_price = 0;
            var quantity = 0;
            var sub_total = 0;
            var discount = 0;
            var amount_payable = 0;
            quantity = $('#quantity').val();
            unit_price = $('#unit_price').val();
            sub_total = unit_price * quantity;
            discount = this.value;
            amount_payable = sub_total - discount;

            $('#editPurchaseForm').find('[name="sub_total"]').val(sub_total)
            $('#editPurchaseForm').find('[name="amount_payable"]').val(amount_payable)
        });
    });




</script>

<script>


    $(document).ready(function () {

        var unit_price = 0;
        var quantity = 0;
        var sub_total = 0;
        var discount = 0;
        var amount_payable = 0;
        quantity = $('#quantity').val();
        unit_price = $('#unit_price').val();
        sub_total = unit_price * quantity;
        discount = $('#discount').val();
        amount_payable = sub_total - discount;

        $('#editPurchaseForm').find('[name="sub_total"]').val(sub_total)
        $('#editPurchaseForm').find('[name="amount_payable"]').val(amount_payable)


    });


</script>