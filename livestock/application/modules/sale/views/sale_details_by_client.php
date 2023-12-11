<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel"> 
            <header class="panel-heading">
                <i class="fa fa-money"></i>
                <?php  echo lang('client_report'); ?>
                <?php
                 $this->client_model->getClientById($client_id)->name;
                
                ?> 
            </header>
            <div class="panel-body">

                <div class="col-md-3 total_title payable" > <p>  <?php  echo lang('receivable'); ?></p> <?php echo $settings->currency; ?>  <?php echo number_format($total_receivable, 2, '.', ','); ?>  </div>
                <div class="col-md-3 total_title paid" > <p>  <?php  echo lang('paid'); ?></p> <?php echo $settings->currency; ?> <?php echo number_format($total_paid, 2, '.', ','); ?> </div>
                <div class="col-md-3 total_title due_payable" > <p>  <?php  echo lang('due'); ?></p> <?php echo $settings->currency; ?> <?php echo number_format($total_receivable - $total_paid, 2, '.', ','); ?>   </div>
            </div>
            
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix new">
                        <a href="sale/addSaleView?type=<?php echo $type; ?>">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i>  <?php  echo lang('new_sale'); ?> 
                                </button>
                            </div>
                        </a>
                       
                        <a class="btn btn-xs export green" onclick="javascript:window.print();">  <i class="fa fa-print"> </i>  <?php  echo lang('print'); ?></a>   
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th>  <?php  echo lang('invoice_id'); ?></th>
                                <th> <?php  echo lang('date'); ?> </th>
                                <th>  <?php  echo lang('product'); ?></th>
                                <th> <?php  echo lang('reference'); ?></th>
                                <th>  <?php  echo lang('quantity'); ?></th>
                                <th>  <?php  echo lang('sale_status'); ?></th>
                                <th>  <?php  echo lang('total'); ?></th>
                                <th> <?php  echo lang('paid'); ?> </th>
                                <th><?php  echo lang('due_balance'); ?> </th>
                                <th> <?php  echo lang('payment_status'); ?> </th>
                                <th class="option_th"> <?php  echo lang('options'); ?></th>
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
                            .option_th{
                                width:18%;
                            }
                        </style>
                        <?php foreach ($sales as $sale) { ?>
                            <tr class="">
                                <td><?php
                                    echo '00' . $sale->id;
                                    ?>
                                </td>
                                <td><?php echo date($settings->date_format, $sale->date); ?></td>
                                <td>
                                    <?php
                                    $products = explode(',', $sale->category_name);
                                    foreach ($products as $key => $value) {
                                        $product_detail = explode('*', $value);
                                        $product_ids[] = $product_detail[0];
                                        $product_qtys[] = $product_detail[2];
                                    }

                                    foreach ($product_ids as $key1 => $value1) {
                                        $product_names[] = $this->product_model->getProductById($value1)->name;
                                    }
                                    $product_namess = implode(',', $product_names);

                                    $product_ids = NULL;
                                    $product_names = NULL;
                                    echo $product_namess;
                                    ?>



                                </td>
                                <td>  <?php echo $sale->reference; ?></td>
                                <td>
                                    <?php
                                    foreach ($product_qtys as $key2 => $value2) {
                                        $total_qty[] = $value2;
                                    }
                                    if (!empty($total_qty)) {
                                        echo array_sum($total_qty);
                                        $product_qtys = NULL;
                                        $total_qty = NULL;
                                    } else {
                                        echo '0';
                                    }
                                    ?> <?php echo $settings->unit; ?>
                                </td>
                                <td> <?php
                                    if ($sale->sale_status == 'delivered') {
                                        echo "<div class='btn-info' style='width:85px; padding:5px;'>". lang('delivered') ."</div>";
                                    } else {
                                        echo "<div class='btn-info' style='background: #B2204B; width:85px; padding:5px;'>". lang('ordered') ."</div>";
                                    }
                                    ?> </td>
                                <td>  <?php
                                    $gross = $sale->gross_total;
                                    echo number_format($gross, 2, '.', ',');
                                    ?>
                                </td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    $total = array();
                                    foreach ($payments as $payment) {
                                        if ($payment->sale_id == $sale->id) {
                                            $total[] = $payment->amount;
                                        }
                                    }

                                    if (!empty($total)) {
                                        $total = array_sum($total);
                                    } else {
                                        $total = 0;
                                    }

                                    echo number_format($total, 2, '.', ',');
                                    ?>
                                </td>

                                <td> <?php echo $settings->currency; ?> <?php
                                    $due = $gross - $total;
                                    if (!empty($due)) {
                                        $due;
                                    } else {
                                        $due = 0;
                                    }
                                    echo number_format($due, 2, '.', ',');
                                    ?>
                                </td>
                                <td>  <?php
                                    if ($due > 0) {
                                        echo "<div class='btn-info' style='background: #B2204B; width:85px; padding:5px;'>". lang('pending') ."</div>";
                                    } else {
                                        echo "<div class='btn-info' style='width:85px; padding:5px;'>". lang('paid') ."</div>";
                                    }
                                    ?></td>
                                <td class="option">   
                                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                                        <a class="btn btn-xs " href="sale/editSale?id=<?php echo $sale->id; ?>"><i class="fa fa-edit"> </i> <?php  echo lang('edit'); ?></a> 
                                    <?php } ?>
                                    <a class="btn btn-xs viewPayment" data-toggle="modal" data-id="<?php echo $sale->id; ?>" href="#modal1"><i class="fa fa-eye"></i>  <?php  echo lang('view_payments'); ?></a>
                                    <?php // payment/paymentsForSaleId?id=<?php echo $sale->id;           ?>
                                    <a class="btn btn-xs addPayment" data-toggle="modal" data-id="<?php echo $sale->id; ?>" href="#modal"><i class="fa fa-plus-circle"></i>  <?php  echo lang('add_payment'); ?></a>   
                                    <a class="btn btn-xs" href="sale/invoice?id=<?php echo $sale->id; ?>"><i class="fa fa-file-text"></i>  <?php  echo lang('invoice'); ?></a>
                                    <?php if ($this->ion_auth->in_group('admin')) { ?> 
                                        <a class="btn btn-xs" href="sale/delete?id=<?php echo $sale->id; ?>&client_id=<?php echo $client_id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i> <?php  echo lang('delete'); ?></a>
                                    <?php } ?>
                                    </button>
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


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
                                    $(document).ready(function () {
                                        $(".flashmessage").delay(3000).fadeOut(100);
                                    });
</script>

<style>

    .note{
        padding-left: 0px;
        padding-right: 0px;
    }

    #cke_1_contents{
        height: 88px !important;
    }
    .modal-body{
        padding: 0px;
    }
</style>


<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>  <?php  echo lang('add_payment'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="paymentForm" action="payment/addPayment" method="post" enctype="multipart/form-data">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php  echo lang('reference'); ?></label>
                            <input type="text" class="form-control" name="reference" id="exampleInputEmail1" value=''>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php  echo lang('date'); ?></label>
                            <input type="text" class="form-control default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="">
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php  echo lang('paid_by'); ?></label>
                            <select id="paid_by" class="form-control m-bot15" name="paid_by" value=''>
                                <option value="cash"> <?php  echo lang('cash'); ?></option>
                                <option value="cheque"> <?php  echo lang('cheque'); ?></option>
                                <option value="other"> <?php  echo lang('other'); ?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php  echo lang('amount'); ?></label>
                            <input type="text" class="form-control" name="amount" id="exampleInputEmail1" value='' placeholder="">
                        </div>


                        <input type="hidden" name="sale_id" value=''>
                        <input type="hidden" name="client_id" value='<?php echo $sale->client_id; ?>'>
                    </div>

                    <div class="form-group col-md-12">
                        <div class="form-group" id="cheque_no" style="display: none;">
                            <label for="exampleInputEmail1"> <?php  echo lang('cheque_no'); ?></label>
                            <input type="text" class="form-control" name="cheque_no" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <label class="control-label col-md-3 note"><?php  echo lang('note'); ?></label>
                        <div class="col-md-12 note">
                            <textarea class="ckeditor form-control" name="note" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info">  <?php  echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



<style>
    .img_url{
        height:20px;
        width:20px;
        background-size: contain; 
        max-height:20px;
        border-radius: 100px;
    }
    .option_th{
        width:18%;
    }

    .form-control { 
        height: 32px !important;
    }

    .note{
        padding-left: 0px;
        padding-right: 0px;
    }

</style>



<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-eye"></i>  <?php  echo lang('view_payments'); ?></h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                    <thead>
                        <tr>
                            <th>  <?php  echo lang('id'); ?></th>
                            <th>  <?php  echo lang('date'); ?></th>
                            <th>  <?php  echo lang('reference'); ?></th>
                            <th> <?php  echo lang('amount'); ?> </th>
                            <th> <?php  echo lang('paid_by'); ?></th>
                            <th class="option_th">  <?php  echo lang('options'); ?></th>
                        </tr>
                    </thead>
                    <tbody class="viewP">



                    </tbody>
                </table>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



<script>

    $(document).ready(function () {
        $('#paid_by').on('change', function () {
            if ($(this).val() === "cheque") {
                $("#cheque_no").delay(500).fadeIn(100);
            } else {
                $("#cheque_no").hide()
            }
        });

    });

    $(document).ready(function () {
        $('#currency').on('change', function () {
            if ($(this).val() === "dollar") {
                $("#dollar_rate").delay(500).fadeIn(100);
            } else {
                $("#dollar_rate").hide()
            }
        });

    });

</script>

<script type="text/javascript">
    $(document).ready(function () {
        $(".addPayment").click(function (e) {
            e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            $('#paymentForm').trigger("reset");
            $('#modal').modal('show');

            // Populate the form fields with the data returned from server
            $('#paymentForm').find('[name="sale_id"]').val(iid).end()
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $(".viewPayment").click(function (e) {
            e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            $('.viewP').html("");
            $('#modal1').modal('show');
            $.ajax({
                url: 'payment/getPaymentBySaleIdByJason?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                var all_payments = response.paymentsBySaleId;
                $.each(all_payments, function (key, value) {


                    var de = value.date * 1000;
                    var d = new Date(de);
                    var da = (d.getDate() + 1) + '-' + (d.getMonth() + 1) + '-' + d.getFullYear();


                    var $tr = $('<tr>').append(
                            $('<td>').text(value.id),
                            $('<td>').text(da),
                            $('<td>').text(value.reference_no),
                            $('<td><strong>').text(value.amount),
                            $('<td>').text(value.paid_by),
                            $('<td>').html('<a href="payment/deletePayment?id=' + value.id + '"onclick="return confirm("Are you sure you want to remove the item?");" >delete</a>')

                            );
                    $(".viewP").append($tr);

                });

            });
        });
    });
</script>