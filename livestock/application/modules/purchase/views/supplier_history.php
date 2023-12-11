<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-money"></i>   <?php echo lang('supplier_history'); ?> 
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix new">
                        <a href="purchase/addPurchaseView">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i>  <?php echo lang('new_purchase'); ?> 
                                </button>
                            </div>
                        </a>
                        <button class="export green" onclick="javascript:window.print();"> <?php echo lang('print'); ?></button>     
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th> <?php echo lang('supplier'); ?> </th>
                                <th><?php echo lang('purchase_payable'); ?>  </th>
                                <th> <?php echo lang('purchase_paid'); ?> </th>
                                <th> <?php echo lang('purchase_due_payable'); ?> </th>
                                <th class="option_th"> <?php echo lang('options'); ?> </th>
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

                            .note{
                                padding-left: 0px;
                                padding-right: 0px;
                            }

                        </style>

                        <?php foreach ($suppliers as $supplier) { ?>
                            <tr class="">
                                <td><?php echo $supplier->name; ?></td>  
                                <td> <?php echo $settings->currency; ?> 
                                    <?php
                                    foreach ($purchases as $purchase) {
                                        if ($purchase->supplier == $supplier->id) {
                                            $total_purchase[] = $purchase->amount_payable;
                                        }
                                    }
                                    if (!empty($total_purchase)) {
                                        $total = array_sum($total_purchase);
                                    } else {
                                        $total = 0;
                                    }

                                    echo number_format($total, 2, '.', ',');

                                    $tp[] = $total;

                                    $total_purchase = NULL;
                                    ?>
                                </td>
                                <td> <?php echo $settings->currency; ?> 
                                    <?php
                                    foreach ($purchases as $purchase) {
                                        if ($purchase->supplier == $supplier->id) {
                                            foreach ($payments as $payment) {
                                                if ($payment->purchase_id == $purchase->id) {
                                                    $total_purchase_paid[] = $payment->amount;
                                                }
                                            }
                                        }
                                    }
                                    if (!empty($total_purchase_paid)) {
                                        $total_paid = array_sum($total_purchase_paid);
                                    } else {
                                        $total_paid = 0;
                                    }

                                    echo number_format($total_paid, 2, '.', ',');

                                    $tpp[] = $total_paid;
                                    $total_purchase_paid = NULL;
                                    ?>
                                </td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    $due = $total - $total_paid;
                                    echo number_format($due, 2, '.', ',');
                                    $total_due[] = $due;
                                    ?>
                                </td>


                                <td class="option"> 

                                    <a style="width:90px;"class="btn btn-info btn-xs green" href="purchase/purchaseDetailsBySupplier?supplier_id=<?php echo $supplier->id; ?>"><i class="fa fa-eye"> </i><?php echo lang('details'); ?> </a>

                                    </button>
                                </td>
                            </tr>
                        <?php } ?>


                        <tr>
                            <td class="medici_name total">   <?php echo lang('total'); ?> </td>
                            <td class="medici_name total">
                                <?php echo $settings->currency; ?>
                                <?php
                                if (!empty($tp)) {
                                    $tp_format = array_sum($tp);
                                } else {
                                    $tp_format = 0;
                                }
                                echo number_format($tp_format, 2, '.', ',');
                                ?>
                            </td>
                            <td class="medici_name total">
                                <?php echo $settings->currency; ?>
                                <?php
                                if (!empty($tpp)) {
                                    $tpp_format = array_sum($tpp);
                                } else {
                                    $tpp_format = 0;
                                }
                                echo number_format($tpp_format, 2, '.', ',');
                                ?>


                            </td>
                            <td class="medici_name total"> 
                                <?php echo $settings->currency; ?> 
                                <?php
                                if (!empty($total_due)) {
                                    $total_due_format = array_sum($total_due);
                                } else {
                                    $total_due_format = 0;
                                }
                                echo number_format($total_due_format, 2, '.', ',');
                                ?>
                            </td>
                            <td class="medici_name total option"></td>           
                        </tr>
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
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('add_payment'); ?> </h4>
            </div>
            <div class="modal-body">
                <form role="form" id="paymentForm" action="payment/addPayment" method="post" enctype="multipart/form-data">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang('reference'); ?> </label>
                            <input type="text" class="form-control" name="reference" id="exampleInputEmail1" value=''>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                            <input type="text" class="form-control default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang('amount'); ?> </label>
                            <input type="text" class="form-control" name="amount" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang('paid_by'); ?></label>
                            <select id="paid_by" class="form-control m-bot15" name="paid_by" value=''>
                                <option value="cash"><?php echo lang('cash'); ?> </option>
                                <option value="cheque"><?php echo lang('cheque'); ?> </option>
                                <option value="other"><?php echo lang('other'); ?> </option>
                            </select>
                        </div>
                        <input type="hidden" name="purchase_id" value=''>
                    </div>

                    <div class="form-group col-md-12">
                        <div class="form-group" id="cheque_no" style="display: none;">
                            <label for="exampleInputEmail1"> <?php echo lang('cheque_no'); ?></label>
                            <input type="text" class="form-control" name="cheque_no" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <label class="control-label col-md-3 note"><?php echo lang('note'); ?></label>
                        <div class="col-md-12 note">
                            <textarea class="ckeditor form-control" name="note" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
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

    .note{
        padding-left: 0px;
        padding-right: 0px;
    }

</style>



<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i><?php echo lang('view_payments'); ?> </h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                    <thead>
                        <tr>
                            <th> <?php echo lang('id'); ?></th>
                            <th> <?php echo lang('date'); ?> </th>
                            <th> <?php echo lang('reference'); ?> </th>
                            <th><?php echo lang('amount'); ?>  </th>
                            <th><?php echo lang('paid_by'); ?>  </th>
                            <th class="option_th"><?php echo lang('options'); ?>  </th>
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
            $('#paymentForm').find('[name="purchase_id"]').val(iid).end()
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
                url: 'payment/getPaymentByPurchaseIdByJason?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                var all_payments = response.paymentsByPurchaseId;
                $.each(all_payments, function (key, value) {
                    var $tr = $('<tr>').append(
                            $('<td>').text(value.id),
                            $('<td>').text(value.date),
                            $('<td>').text(value.reference_no),
                            $('<td><strong>').text(value.amount),
                            $('<td>').text(value.paid_by),
                            $('<td>').text(value.amount)

                            );
                    $(".viewP").append($tr);

                });

            });
        });
    });
</script>