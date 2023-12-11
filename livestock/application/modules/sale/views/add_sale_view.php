<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($sale->id))
                    echo '<i class="fa fa-edit"></i> '. lang('edit_sale');
                else
                    echo '<i class="fa fa-plus-circle"></i> '. lang('add_new_sale');
                ?>
                 <?php
                $message = $this->session->flashdata('quantity_check');
                if (!empty($message)) {
                    ?>
                    <div class="quantity_check pull-left"> <?php echo $message; ?></div>
                <?php }
                ?> 
            </header>
            <div class="panel-body col-md-12">
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
                                    <form role="form" action="sale/addSale" method="post" id="editSaleForm" enctype="multipart/form-data">
                                        <div class="col-md-6">
                                            <?php if (!empty($sale->id)) { ?>
                                            
                                             <div class="form-group">
                                                <label for="exampleInputEmail1">  <?php  echo lang('invoice_id'); ?> :</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                                <span>                                                   
                                                        <?php echo '00' . $sale->id; ?>                                                                                                       
                                                    </span>
                                            </div>
                                            
                                                                                         
                                            <?php } ?>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> <?php  echo lang('client'); ?> </label>
                                                <select name="client" class="form-control js-example-basic-single" id="exampleInputEmail1" placeholder="" style="width: 100%;" required>
                                                    <?php foreach ($clients as $client) { ?>
                                                        <option value="<?php echo $client->id; ?>" <?php
                                                        if (!empty($sale->client_id)) {
                                                            if ($client->id == $sale->client_id) {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?> > <?php echo $client->name; ?> </option>
                                                            <?php } ?> 
                                                </select>
                                            </div>

                                            <div class="form-group">

                                                <select name="category_name[]"  class="multi-select " multiple="" id="my_multi_select3" >

                                                    <?php foreach ($products as $product) { ?>
                                                        <option class="ooppttiioonn" data-id="<?php echo $product->id; ?>" <?php if (empty($sale->id)) { ?> data-price="<?php echo $product->price; ?>"  <?php } ?> data-m_name = "<?php echo $product->name; ?>" value="<?php echo $product->id; ?>"
                                                        <?php
                                                        if (!empty($sale->category_name)) {
                                                            $category_name = $sale->category_name;
                                                            $category_name1 = explode(',', $category_name);
                                                            foreach ($category_name1 as $category_name2) {
                                                                $category_name3 = explode('*', $category_name2);
                                                                if ($category_name3[0] == $product->id) {

                                                                    echo 'data-qtity=' . $category_name3[2];
                                                                }
                                                            }
                                                        }
                                                        ?>


                                                                <?php
                                                                if (!empty($sale->category_name)) {
                                                                    $category_name = $sale->category_name;
                                                                    $category_name1 = explode(',', $category_name);
                                                                    foreach ($category_name1 as $category_name2) {
                                                                        $category_name3 = explode('*', $category_name2);
                                                                        if ($category_name3[0] == $product->id) {

                                                                            echo 'data-price=' . $category_name3[1];
                                                                        }
                                                                    }
                                                                }
                                                                ?>



                                                                <?php
                                                                if (!empty($sale->category_name)) {
                                                                    $category_name = $sale->category_name;
                                                                    $category_name1 = explode(',', $category_name);
                                                                    foreach ($category_name1 as $category_name2) {
                                                                        $category_name3 = explode('*', $category_name2);
                                                                        if ($category_name3[0] == $product->id) {
                                                                            echo 'selected';
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                                >

                                                            <?php echo $product->name; ?>
                                                        </option>
                                                    <?php }
                                                    ?>
                                                </select>   
                                            </div>
                                            <style>.qfloww {
                                                    background: #097095;
                                                    padding: 23px;
                                                    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
                                                    overflow: scroll;
                                                }</style>
                                            <div class="col-md-12 qfloww">
                                                <p class="btn btn-xs green" style="margin-bottom: 20px;"><?php  echo lang('selected_items'); ?></p>    
                                            </div>


                                        </div> <div class="col-md-6">
                                            
                                            

                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> <?php  echo lang('sale_date'); ?> </label>
                                                <input type="text" class="form-control default-date-picker" name="date" id="exampleInputEmail1" value='<?php
                                                if (!empty($sale->date)) {

                                                    echo date($settings->date_format, $sale->date);
                                                } else {
                                                    echo date($settings->date_format);
                                                }
                                                ?>' placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> <?php  echo lang('status'); ?> </label>
                                                <select id="paid_by" class="form-control m-bot15" name="sale_status" value=''>
                                                    <option value="delivered"> <?php  echo lang('delivered'); ?></option>
                                                    <option value="ordered"><?php  echo lang('ordered'); ?></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> <?php  echo lang('subtotal'); ?> </label>
                                                <input type="text" class="form-control" name="subtotal" id="subtotal" value='<?php
                                                if (!empty($sale->amount)) {

                                                    echo $sale->amount;
                                                }
                                                ?>' placeholder="" readonly="">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php  echo lang('discount'); ?><?php
                                                    if ($discount_type == 'percentage') {
                                                        echo ' (%)';
                                                    }
                                                    ?> </label>
                                                <input type="text" class="form-control" name="discount" id="dis_id" value='<?php
                                                if (!empty($sale->discount)) {
                                                    $discount = explode('*', $sale->discount);
                                                    echo $discount[0];
                                                }
                                                ?>' placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> <?php  echo lang('gross_total'); ?> </label>
                                                <input type="text" class="form-control" name="grsss" id="gross" value='<?php
                                                if (!empty($sale->gross_total)) {

                                                    echo $sale->gross_total;
                                                }
                                                ?>' placeholder="" readonly="">
                                            </div>

                                            <input type="hidden" name="id" value='<?php
                                            if (!empty($sale->id)) {
                                                echo $sale->id;
                                            }
                                            ?>'>
                                        </div>
                                        <section class="">
                                            <button type="submit" name="submit" class="btn btn-info submit_button"> <?php  echo lang('submit'); ?> </button>
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
<!-- page end--><script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


<style>

    .remove{
        margin-bottom: 20px;
        width:40px
    }
</style>

<script>
    $(document).ready(function () {
        var tot = 0;
        $(".ms-selected").click(function () {
            var id = $(this).data('id');
            $('#id-div' + id).remove();
            $('#idinput-' + id).remove();
            $('#mediidinput-' + id).remove();
            $('#priceInput-' + id).remove();

        });


        $.each($('select.multi-select option:selected'), function () {
            var unit_price = $(this).data('price');
            var id = $(this).data('id');
            var qtity = $(this).data('qtity');
            if ($('#idinput-' + id).length)
            {

            } else {
                if ($('#id-div' + id).length)
                {

                } else {

                    $("#editSaleForm .qfloww").append('<div class="remove1" id="id-div' + id + '"> <div class="name col-md-4">Name: ' + $(this).data("m_name") + '</div><div class="price y' + id + ' col-md-3">Price / Kg:</div><div class="quantity x' + id + ' col-md-3">quantity:</div>')
                }
                var input2 = $('<input>').attr({
                    type: 'text',
                    class: "remove",
                    id: 'idinput-' + id,
                    name: 'quantity[]',
                    value: qtity,
                }).appendTo('#editSaleForm .x' + id + '');

                $('<input>').attr({
                    type: 'hidden',
                    class: "remove",
                    id: 'mediidinput-' + id,
                    name: 'product_id[]',
                    value: id,
                }).appendTo('#editSaleForm .qfloww');

                var input3 = $('<input>').attr({
                    type: 'text',
                    class: "remove",
                    id: 'priceInput-' + id,
                    name: 'price[]',
                    value: unit_price,
                }).appendTo('#editSaleForm .y' + id + '');
            }
            $(document).ready(function () {
                $('#idinput-' + id).keyup(function () {
                    var qty = 0;
                    var price = 0;
                    var total = 0;
                    $.each($('select.multi-select option:selected'), function () {
                        var id1 = $(this).data('id');
                        qty = $('#idinput-' + id1).val();
                        price = $('#priceInput-' + id1).val();
                        var ekokk = $(this).data('s_price');
                        total = total + qty * price;
                    });

                    tot = total;

                    var discount = $('#dis_id').val();
                    var gross = tot - discount;
                    $('#editSaleForm').find('[name="subtotal"]').val(tot).end()
                    $('#editSaleForm').find('[name="grsss"]').val(gross)
                });


                $('#priceInput-' + id).keyup(function () {
                    var qty = 0;
                    var price = 0;
                    var total = 0;
                    $.each($('select.multi-select option:selected'), function () {
                        var id1 = $(this).data('id');
                        qty = $('#idinput-' + id1).val();
                        price = $('#priceInput-' + id1).val();
                        var ekokk = $(this).data('s_price');
                        total = total + qty * price;
                    });

                    tot = total;

                    var discount = $('#dis_id').val();
                    var gross = tot - discount;
                    $('#editSaleForm').find('[name="subtotal"]').val(tot).end()
                    $('#editSaleForm').find('[name="grsss"]').val(gross)
                });
            });
            var curr_val = $('#priceInput-' + id).val() * $('#idinput-' + id).val();
            tot = tot + curr_val;
        });
        var discount = $('#dis_id').val();
        var gross = tot - discount;
        $('#editSaleForm').find('[name="subtotal"]').val(tot).end()
        $('#editSaleForm').find('[name="grsss"]').val(gross)
        //  });
    });
    $(document).ready(function () {
        $('#dis_id').keyup(function () {
            var val_dis = 0;
            var amount = 0;
            var ggggg = 0;
            amount = $('#subtotal').val();
            val_dis = this.value;
            ggggg = amount - val_dis;
            $('#editSaleForm').find('[name="grsss"]').val(ggggg)
        });
    });

</script> 



<script>
    $(document).ready(function () {
        $('.multi-select').change(function () {
            var tot = 0;
            $(".ms-selected").click(function () {
                var id = $(this).data('id');
                $('#id-div' + id).remove();
                $('#idinput-' + id).remove();
                $('#mediidinput-' + id).remove();
                $('#priceInput-' + id).remove();

            });
            $.each($('select.multi-select option:selected'), function () {

                var id = $(this).data('id');
                var unit_price = $(this).data('price');
                if ($('#idinput-' + id).length)
                {

                } else {
                    if ($('#id-div' + id).length)
                    {

                    } else {

                        $("#editSaleForm .qfloww").append('<div class="remove1" id="id-div' + id + '"> <div class="name col-md-4">Name: ' + $(this).data("m_name") + '</div><div class="price y' + id + ' col-md-3">Price / Kg:</div><div class="quantity x' + id + ' col-md-3">quantity:</div>')
                    }
                    var input2 = $('<input>').attr({
                        type: 'text',
                        class: "remove",
                        id: 'idinput-' + id,
                        name: 'quantity[]',
                        value: 1,
                    }).appendTo('#editSaleForm .x' + id + '');

                    $('<input>').attr({
                        type: 'hidden',
                        class: "remove",
                        id: 'mediidinput-' + id,
                        name: 'product_id[]',
                        value: id,
                    }).appendTo('#editSaleForm .qfloww');

                    var input3 = $('<input>').attr({
                        type: 'text',
                        class: "remove",
                        id: 'priceInput-' + id,
                        name: 'price[]',
                        value: unit_price,
                    }).appendTo('#editSaleForm .y' + id + '');

                }

                $(document).ready(function () {
                    $('#idinput-' + id).keyup(function () {
                        var qty = 0;
                        var price = 0;
                        var total = 0;
                        $.each($('select.multi-select option:selected'), function () {
                            var id1 = $(this).data('id');
                            qty = $('#idinput-' + id1).val();
                            price = $('#priceInput-' + id1).val();
                            var ekokk = $(this).data('s_price');
                            total = total + qty * price;
                        });

                        tot = total;

                        var discount = $('#dis_id').val();
                        var gross = tot - discount;
                        $('#editSaleForm').find('[name="subtotal"]').val(tot).end()
                        $('#editSaleForm').find('[name="grsss"]').val(gross)
                    });


                    $('#priceInput-' + id).keyup(function () {
                        var qty = 0;
                        var price = 0;
                        var total = 0;
                        $.each($('select.multi-select option:selected'), function () {
                            var id1 = $(this).data('id');
                            qty = $('#idinput-' + id1).val();
                            price = $('#priceInput-' + id1).val();
                            var ekokk = $(this).data('s_price');
                            total = total + qty * price;
                        });

                        tot = total;

                        var discount = $('#dis_id').val();
                        var gross = tot - discount;
                        $('#editSaleForm').find('[name="subtotal"]').val(tot).end()
                        $('#editSaleForm').find('[name="grsss"]').val(gross)
                    });
                });





                var curr_val = $('#priceInput-' + id).val() * $('#idinput-' + id).val();
                tot = tot + curr_val;

            });
            var discount = $('#dis_id').val();
            var gross = tot - discount;
            $('#editSaleForm').find('[name="subtotal"]').val(tot).end()
            $('#editSaleForm').find('[name="grsss"]').val(gross)
        });
    });
    $(document).ready(function () {
        $('#dis_id').keyup(function () {
            var val_dis = 0;
            var amount = 0;
            var ggggg = 0;
            amount = $('#subtotal').val();
            val_dis = this.value;
            ggggg = amount - val_dis;
            $('#editSaleForm').find('[name="grsss"]').val(ggggg)
        });
    });

</script> 

<script>
    $.ajax({
        $('#friends').selectpicker('refresh');
                url: 'client/searchClientByJason', //this returns object data
        data: 'user_id=' + user_id,
        type: 'POST',
        datatype: 'json',
        success: function (data) { //data = {"0":{"id":1,"name":"Jason"},"1":{"id":2,"name":"Will"},"length":2 }
            data = JSON.parse(data);
            var options;
            for (var i = 0; i < data['length']; i++) {
                options += "<option value='" + data[i]['id'] + "'>" + data[i]['name'] + "</option>";
            }
            $("#friends").append(options);
        }
    });

</script>

<!-- Add Client Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>  <?php  echo lang('client_registration'); ?> </h4>
            </div>
            <div class="modal-body">
                <form role="form" action="client/addNew?redirect=sale" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('name'); ?> </label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('email'); ?> </label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('phone'); ?> </label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('photo'); ?> </label>
                        <input type="file" class="form-control" name="img_url" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <input type="hidden" name="from_pos" value='from_pos'>

                    <input type="hidden" name="id" value=''>

                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"> <?php  echo lang('submit'); ?> </button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Client Modal-->


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>