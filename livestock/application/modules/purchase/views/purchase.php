<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">

            <header class="panel-heading">
                <i class="fa fa-money"></i>   <?php  echo lang('all_purchases'); ?>
            </header>





            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix new">
                        <a href="purchase/addPurchaseView">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i> <?php  echo lang('new_purchase'); ?>
                                </button>
                            </div>
                        </a>
                        <button class="export" onclick="javascript:window.print();"> <?php  echo lang('print'); ?> </button>     
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th> <?php  echo lang('date'); ?> </th>
                                <th> <?php  echo lang('supplier'); ?></th>
                                <th> <?php  echo lang('product'); ?></th>
                                <th> <?php  echo lang('reference'); ?> </th>
                                <th> <?php  echo lang('quantity'); ?> </th>
                                <th> <?php  echo lang('purchase_status'); ?> </th>
                                <th> <?php  echo lang('grand_total'); ?> </th>
                                <th> <?php  echo lang('paid_amount'); ?> </th>
                                <th><?php  echo lang('due_balance'); ?> </th>
                                <th> <?php  echo lang('payment_status'); ?> </th>
                                <th class="option_th"><?php  echo lang('options'); ?> </th>
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

                        <?php foreach ($purchases as $purchase) { ?>


                            <tr class="">
                                <td> <?php echo date($settings->date_format, $purchase->date); ?> </td>
                                 <td><?php echo $this->supplier_model->getSupplierById($purchase->supplier)->name; ?></td>
                                <td><?php echo $this->product_model->getProductById($purchase->product)->code; ?></td>              
                                <td><?php echo $purchase->reference; ?></td>
                                <td><?php echo $purchase->quantity; ?> <?php echo $settings->unit; ?></td>
                                <td><?php
                                    if ($purchase->status == 'received') {
                                        echo "<div class='btn-info' style='width:90px; padding:5px;'>". lang('received') ."</div>";
                                    } else {
                                        echo "<div class='btn-info' style='background-color: #B2204B; width:90px; padding:5px;'>". lang('ordered') ."</div>";
                                    }
                                    ?>
                                </td>
                                <td><?php echo $settings->currency; ?> <?php echo number_format($purchase->amount_payable, 2, '.', ','); ?></td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    $total = array();

                                    foreach ($payments as $payment) {
                                        if ($payment->purchase_id == $purchase->id) {
                                            $total[] = $payment->amount;
                                        }
                                    }

                                    if (!empty($total)) {
                                        $total_paid = array_sum($total);
                                    } else {
                                        $total_paid = 0;
                                    }
                                    echo number_format($total_paid, 2, '.', ',');
                                    ?>
                                </td>
                                <td><?php echo $settings->currency; ?> <?php
                                    $due = $purchase->amount_payable - $total_paid;
                                    echo number_format($due, 2, '.', ',')
                                    ?></td>
                                <td> <?php
                                    if ($due > 0) {
                                       echo "<div class='btn-info' style='background: #B2204B; width:90px; padding:5px;'> ". lang('pending') ."  </div>"; 
                                    } else {
                                       echo "<div class='btn-info' style='width:90px; padding:5px;'>". lang('paid') ."</div>";
                                    }
                                    ?></td>
                                
                               <td class="option"> 
                                    <a class="btn btn-xs viewPurchase" data-toggle="modal" data-id="<?php echo $purchase->id; ?>" href="#modal2"><i class="fa fa-eye"></i>  <?php  echo lang('view_purchase'); ?></a>
                                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                                        <a class="btn btn-xs " href="purchase/editPurchase?id=<?php echo $purchase->id; ?>"><i class="fa fa-edit"> </i> <?php  echo lang('edit_purchase'); ?></a>
                                    <?php } ?>
                                    <a class="btn btn-xs viewPayment" data-toggle="modal" data-id="<?php echo $purchase->id; ?>" href="#modal1"><i class="fa fa-eye"></i>  <?php  echo lang('view_payments'); ?></a>
                                    <?php // payment/paymentsForPurchaseId?id=<?php echo $purchase->id;      ?>
                                    <a class="btn btn-xs addPayment" data-toggle="modal" data-id="<?php echo $purchase->id; ?>" data-supplier_id="<?php echo $purchase->supplier; ?>" href="#modal"><i class="fa fa-plus-circle"></i>  <?php  echo lang('add_payment'); ?></a>                                   
                                    <?php if ($this->ion_auth->in_group('admin')) { ?> 
                                        <a class="btn btn-xs" href="purchase/delete?id=<?php echo $purchase->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i>  <?php  echo lang('delete'); ?></a>
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
        padding: 6px;
    }
</style>


<!--   Add Payment Modal  -->

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
                            <label for="exampleInputEmail1"><?php  echo lang('reference'); ?></label>
                            <input type="text" class="form-control" name="reference" id="exampleInputEmail1" value=''>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php  echo lang('date'); ?></label>
                            <input type="text" class="form-control default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php  echo lang('amount'); ?></label>
                            <input type="text" class="form-control" name="amount" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php  echo lang('paid_by'); ?></label>
                            <select id="paid_by" class="form-control m-bot15" name="paid_by" value=''>
                                <option value="cash"><?php  echo lang('cash'); ?></option>
                                <option value="cheque"><?php  echo lang('cheque'); ?> </option>
                                <option value="other"><?php  echo lang('other'); ?> </option>
                            </select>
                        </div>
                        <input type="hidden" name="view" value='purchase'>
                        <input type="hidden" name="purchase_id" value=''>
                        <input type="hidden" name="supplier_id" value='<?php echo $supplier_id; ?>'>
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
                        <button type="submit" name="submit" class="btn btn-info"><?php  echo lang('submit'); ?> </button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!--   Add Payment Modal  -->

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

    .viewP td{
        font-weight: bold;
    }

</style>


<!--   View Payments Modal  -->

<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-eye"></i>  <?php  echo lang('view_payments'); ?></h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                    <thead>
                        <tr>
                            <th><?php  echo lang('date'); ?> </th>
                            <th><?php  echo lang('reference'); ?> </th>
                            <th> <?php  echo lang('amount'); ?> </th>
                            <th> <?php  echo lang('paid_by'); ?> </th>
                            <th class="option_th"> <?php  echo lang('options'); ?> </th>
                        </tr>
                    </thead>
                    <tbody class="viewP">



                    </tbody>
                </table>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!--   View Payments Modal  -->




<!--   View Purchase Modal  -->

<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-eye"></i> <?php  echo lang('view_purchase'); ?></h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                    <thead>
                        <tr>
                            <th> <?php  echo lang('title'); ?> </th>
                            <th> <?php  echo lang('value'); ?> </th>
                        </tr>
                    </thead>
                    <tbody class="viewP">



                    </tbody>
                </table>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!--   View Purchase Modal  -->

<script>

    $(document).ready(function () {
        $('#paid_by').on('change', function () {
            if ($(this).val() === "cheque") {
                $("#cheque_no").delay(500).fadeIn(100);
            }
            else {
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
            var supplier_id = $(this).attr('data-supplier_id');
            $('#paymentForm').trigger("reset");
            $('#modal').modal('show');

            // Populate the form fields with the data returned from server
            $('#paymentForm').find('[name="purchase_id"]').val(iid).end()
            $('#paymentForm').find('[name="supplier_id"]').val(supplier_id).end()
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
                    var de = value.date * 1000;
                    var d = new Date(de);
                    var da = d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear();
                    var $tr = $('<tr>').append(
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




<script type="text/javascript">
    $(document).ready(function () {
        $(".viewPurchase").click(function (e) {
            e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            $('.viewP').html("");
            $('#modal2').modal('show');
            $.ajax({
                url: 'purchase/getPurchaseByIdByJason?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                var purchase_details = response.purchase;
                var de = purchase_details.date * 1000;
                var d = new Date(de);
                var da = d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear();
                var $tr = $('<tr>').append(
                        $('<td>').text('Date'),
                        $('<td>').text(da)
                        );
                $(".viewP").append($tr);
                var $tr1 = $('<tr>').append(
                        $('<td>').text('Reference No'),
                        $('<td>').text(purchase_details.reference)
                        );
                $(".viewP").append($tr1);
                var $tr2 = $('<tr>').append(
                        $('<td>').text('Product'),
                        $('<td>').text(response.product_name)
                        );
                $(".viewP").append($tr2);
                var $tr3 = $('<tr>').append(
                        $('<td>').text('Quantity'),
                        $('<td>').text(purchase_details.quantity)
                        );
                $(".viewP").append($tr3);

                var $tr4 = $('<tr>').append(
                        $('<td>').text('Price'),
                        $('<td>').text(purchase_details.unit_price)
                        );
                $(".viewP").append($tr4);
                
                 var $tr5 = $('<tr>').append(
                        $('<td>').text('Sub Total'),
                        $('<td>').text(purchase_details.quantity * purchase_details.unit_price)
                        );
                $(".viewP").append($tr5);
                
                var $tr6= $('<tr>').append(
                        $('<td>').text('Discount'),
                        $('<td>').text(purchase_details.discount)
                        );
                $(".viewP").append($tr6);

                var $tr7 = $('<tr>').append(
                        $('<td>').text('Amount payable'),
                        $('<td>').text(purchase_details.amount_payable)
                        );
                $(".viewP").append($tr7);

            });
        });
    });
</script>