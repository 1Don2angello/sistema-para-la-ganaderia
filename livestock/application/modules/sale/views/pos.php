<!--sidebar end-->
<!--main content start-->
<section id="main-content"> 
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="">
            <header class="panel-heading">

                <?php
                if (!empty($type)) {
                    echo '<span class="title_new_span">' . lang('local') . ' ' . lang('sale') . '</span>';
                }
                ?> 

                <br>
                <?php
                if (!empty($sale->id)) {
                    echo '<i class="fa fa-edit"></i> ' . lang('edit_sale');
                } else {
                    echo '<i class="fa fa-plus-circle"></i> ' . lang('poss');
                }
                ?>

                <?php
                $message = $this->session->flashdata('quantity_check');
                if (!empty($message)) {
                    ?>
                    <div class="quantity_check pull-left"> <?php echo $message; ?></div>
                <?php }
                ?> 

            </header>
            <div class="">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <!--  <div class="col-lg-12"> -->
                        <div class="">
                           <!--   <section class="panel"> -->
                            <section class="">
                                <!--   <div class="panel-body"> -->
                                <div class="">
                                    <style> 
                                        .sale{
                                            padding-top: 20px;
                                            padding-bottom: 20px;
                                            border: none;

                                        }
                                        .pad_bot{
                                            padding-bottom: 10px;
                                        }  

                                        form{
                                            border: 1px solid #ccc;
                                            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
                                            background: transparent;
                                        }
                                        .pos{
                                            padding-left:0px;
                                        }
                                        .form-control{
                                            font-size: 14px;
                                            font-weight: 600;
                                            border-radius: 0px;
                                        }
                                    </style>

                                    <form role="form" class="clearfix pos form1"  id="editSaleForm" action="sale/addSale" method="post" enctype="multipart/form-data">
                                        <div class="col-md-6">     
                                            <?php if (!empty($sale->id)) { ?>
                                                <div class="col-md-8 sale pad_bot">
                                                    <div class="col-md-3 sale_label"> 
                                                        <label for="exampleInputEmail1">  <?php echo lang('invoice_id'); ?> :</label>
                                                    </div>
                                                    <div class="col-md-6">                                                   
                                                        <?php echo '00' . $sale->id; ?>                                                                                                       
                                                    </div>                                              
                                                </div>                                           
                                            <?php } ?>

                                            <div class="form-group">
                                                <div class="col-md-2 sale_label">
                                                    <label class="" for="exampleInputEmail1"> <?php echo lang('client'); ?></label>
                                                </div>
                                                <div class="col-md-6 sale_label">
                                                    <select class="form-control m-bot15" name="client" value=''>
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

                                                <div class="clearfix col-md-2">
                                                    <a data-toggle="modal" class="btn btn-xs addSale" href="#myModal">
                                                        <div class="btn-group">  
                                                            <i class="fa fa-plus-circle"></i>  <?php echo lang('add_client'); ?>         
                                                        </div>
                                                    </a>  
                                                </div>
                                            </div>

                                            <div class="col-md-8 sale">
                                                <div class="form-group last">
                                                    <div class="col-md-3 sale_label"> 
                                                        <label for="exampleInputEmail1"> Select Item</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" name="search" id="search">   
                                                        <div class="search_item clearfix">
                                                            
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <div class="qfloww">
                                                        <select name="category_name[]" id="" class="" multiple="" id="" >   
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="col-md-12 sale right-six">
                                                <div class="col-md-3 sale_label"> 
                                                    <label for="exampleInputEmail1"> <?php echo lang('sub_total'); ?></label>
                                                </div>
                                                <div class="col-md-9"> 
                                                    <input type="text" class="form-control pay_in" name="subtotal" id="subtotal" value='<?php
                                                    if (!empty($sale->amount)) {

                                                        echo $sale->amount;
                                                    }
                                                    ?>' placeholder=" " disabled>
                                                </div>

                                            </div>
                                            <div class="col-md-12 sale right-six">
                                                <div class="col-md-3 sale_label"> 
                                                    <label for="exampleInputEmail1"> <?php echo lang('discount'); ?><?php
                                                        if ($discount_type == 'percentage') {
                                                            echo ' (%)';
                                                        }
                                                        ?> </label>
                                                </div>
                                                <div class="col-md-9"> 
                                                    <input type="text" class="form-control pay_in" name="discount" id="dis_id" value='<?php
                                                    if (!empty($sale->discount)) {
                                                        $discount = explode('*', $sale->discount);
                                                        echo $discount[0];
                                                    }
                                                    ?>' placeholder="Discount">
                                                </div>
                                            </div>

                                            <div class="col-md-12 sale right-six">
                                                <div class="col-md-3 sale_label"> 
                                                    <label for="exampleInputEmail1"> <?php echo lang('gross_total'); ?></label>
                                                </div>
                                                <div class="col-md-9"> 
                                                    <input type="text" class="form-control pay_in" name="grsss" id="gross" value='<?php
                                                    if (!empty($sale->gross_total)) {

                                                        echo $sale->gross_total;
                                                    }
                                                    ?>' placeholder=" " disabled>
                                                </div>

                                            </div>
                                            <div class="col-md-12 sale right-six">
                                                <div class="col-md-3 sale_label"> 
                                                    <label for="exampleInputEmail1"> <?php echo lang('reference'); ?></label>
                                                </div>
                                                <div class="col-md-9"> 
                                                    <input type="text" class="form-control pay_in" name="reference" id="" value='<?php
                                                    if (!empty($sale->reference)) {

                                                        echo $sale->reference;
                                                    }
                                                    ?>' placeholder="">
                                                </div>

                                            </div>
                                            <div class="col-md-12 sale right-six">
                                                <div class="col-md-3 sale_label"> 
                                                    <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                                                </div>
                                                <div class="col-md-9"> 
                                                    <input type="text" class="form-control pay_in default-date-picker" name="date" id="" value='<?php
                                                    if (!empty($sale->date)) {

                                                        echo date($settings->date_format, $sale->date);
                                                    } else {
                                                        echo date($settings->date_format);
                                                    }
                                                    ?>' placeholder="">
                                                </div>

                                            </div>
                                            <div class="col-md-12 sale right-six">
                                                <div class="col-md-3 sale_label"> 
                                                    <label for="exampleInputEmail1"> <?php echo lang('sale_status'); ?> </label>
                                                </div>
                                                <div class="col-md-9"> 
                                                    <select id="paid_by" class="form-control m-bot15" name="sale_status" value=''>
                                                        <option value="delivered"><?php echo lang('delivered'); ?> </option>
                                                        <option value="ordered"><?php echo lang('ordered'); ?> </option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-12 sale right-six">
                                                <div class="col-md-12">
                                                    <div class="col-md-3"> 
                                                    </div>  
                                                    <div class="col-md-6"> 
                                                        <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                                                    </div>
                                                    <div class="col-md-3"> 
                                                    </div> 
                                                </div>
                                            </div>
                                            <!--
                                            <div class="col-md-12 sale">
                                                <div class="col-md-3 sale_label"> 
                                                  <label for="exampleInputEmail1">Vat (%)</label>
                                                </div>
                                                <div class="col-md-9"> 
                                                  <input type="text" class="form-control pay_in" name="vat" id="exampleInputEmail1" value='<?php
                                            if (!empty($sale->vat)) {
                                                echo $sale->vat;
                                            }
                                            ?>' placeholder="%">
                                                </div>
                                            </div>
                                            -->

                                            <input type="hidden" name="id" value='<?php
                                            if (!empty($sale->id)) {
                                                echo $sale->id;
                                            }
                                            ?>'>


                                            <input type="hidden" name="type" value='<?php
                                            if (!empty($type)) {
                                                echo $type;
                                            }
                                            ?>'>


                                            <div class="row">
                                            </div>
                                            <div class="form-group">
                                            </div>

                                        </div>



                                        <div class="col-md-6">

                                        </div>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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

        var i = 5;
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

                    $("#editSaleForm .qfloww").append('<div class="remove1" id="id-div' + id + '"> <div class="name col-md-4">Name: ' + $(this).data("m_name") + '</div><div class="price y' + i + ' col-md-3">Price / Kg:</div><div class="quantity x' + i + ' col-md-3">quantity:</div>')
                }
                var input2 = $('<input>').attr({
                    type: 'text',
                    class: "remove",
                    id: 'idinput-' + id,
                    name: 'quantity[]',
                    value: qtity,
                }).appendTo('#editSaleForm .x' + i + '');

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
                    //  placeholder: 'e.g. 10 kg',
                }).appendTo('#editSaleForm .y' + i + '');
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
            i = i + 5;
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
            var i = 5;
            $.each($('select.multi-select option:selected'), function () {

                var id = $(this).data('id');
                if ($('#idinput-' + id).length)
                {

                } else {
                    if ($('#id-div' + id).length)
                    {

                    } else {

                        $("#editSaleForm .qfloww").append('<div class="remove1" id="id-div' + id + '"> <div class="name col-md-4">Name: ' + $(this).data("m_name") + '</div><div class="price y' + i + ' col-md-3">Price / Kg:</div><div class="quantity x' + i + ' col-md-3">quantity:</div>')
                    }
                    var input2 = $('<input>').attr({
                        type: 'text',
                        class: "remove",
                        id: 'idinput-' + id,
                        name: 'quantity[]',
                        //  value: '0',
                    }).appendTo('#editSaleForm .x' + i + '');

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
                        // value: '0',
                        //  placeholder: 'e.g. 10 kg',
                    }).appendTo('#editSaleForm .y' + i + '');

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





                i = i + 5;
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
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Client Registration</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="client/addNew?redirect=sale" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="file" class="form-control" name="img_url" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <input type="hidden" name="from_pos" value='from_pos'>

                    <input type="hidden" name="id" value=''>

                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info">Submit</button>
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

<script>
    $(document).ready(function () {
        $("#search").keyup(function () {

            var keyword = this.value;

            $(".search_item").html("");

            
           
            $.ajax({
                url: 'sale/getProductForPos?keyword=' + keyword,
                method: 'POST',
                data: '',
                dataType: 'json',
            }).success(function (response) {

                $.each(response.items, function (key, value) {
                    $(".search_item").append(value);
                });
               
            });


        });
    });

</script> 