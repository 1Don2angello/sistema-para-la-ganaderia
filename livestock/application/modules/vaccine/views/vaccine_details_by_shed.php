<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">

            <header class="panel-heading">
                <i class="fa fa-money"></i>  Shed History : <?php echo $this->shed_model->getShedById($shed_id)->no; ?>  
            </header>

           




            <div class="panel-body"> 
                <div class="adv-table editable-table ">
                    <div class="clearfix new">
                       
                        

                        <a class="btn btn-xs export green" onclick="javascript:window.print();">  <i class="fa fa-print"> </i> Print </a>

                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Vaccine Name</th>                        
                                <th>Vaccine Date</th>
                                <th>Vaccine Duration (days)</th>
                                <th class="option_th"> Options </th>
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

                        <?php foreach ($vaccines as $vaccine) { ?>


                            <tr class="">
                                <td> <?php echo date($settings->date_format, $vaccine->date); ?> </td>
                                             
                                <td><?php echo $vaccine->name; ?></td>
                                <td><?php echo $vaccine->duration; ?> </td>
                                
                               
                               
                               
                               
                                <td class="option"> 
                                    <a class="btn btn-xs viewPurchase" data-toggle="modal" data-id="<?php echo $purchase->id; ?>" href="#modal2"><i class="fa fa-eye"></i>  View Purchase</a>
                                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                                        <a class="btn btn-xs " href="purchase/editPurchase?id=<?php echo $purchase->id; ?>"><i class="fa fa-edit"> </i> Edit Purchase</a>
                                    <?php } ?>
                                    <a class="btn btn-xs viewPayment" data-toggle="modal" data-id="<?php echo $purchase->id; ?>" href="#modal1"><i class="fa fa-eye"></i>  View Payments</a>
                                    <?php // payment/paymentsForPurchaseId?id=<?php echo $purchase->id;      ?>
                                    <a class="btn btn-xs addPayment" data-toggle="modal" data-id="<?php echo $purchase->id; ?>" href="#modal"><i class="fa fa-plus-circle"></i>  Add Payment</a>                                   
                                    <?php if ($this->ion_auth->in_group('admin')) { ?> 
                                        <a class="btn btn-xs" href="purchase/delete?id=<?php echo $purchase->id; ?>&supplier_id=<?php echo $supplier_id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i>  Delete</a>
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


<!--   Add Payment Modal  -->

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>  Add Payment</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="paymentForm" action="payment/addPayment" method="post" enctype="multipart/form-data">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Reference</label>
                            <input type="text" class="form-control" name="reference" id="exampleInputEmail1" value=''>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> Date</label>
                            <input type="text" class="form-control default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Amount</label>
                            <input type="text" class="form-control" name="amount" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Paid By</label>
                            <select id="paid_by" class="form-control m-bot15" name="paid_by" value=''>
                                <option value="cash">Cash </option>
                                <option value="cheque">Cheque</option>
                                <option value="other">Other </option>
                            </select>
                        </div>
                        <input type="hidden" name="purchase_id" value=''>
                        <input type="hidden" name="supplier_id" value='<?php echo $supplier_id; ?>'>
                    </div>

                    <div class="form-group col-md-12">
                        <div class="form-group" id="cheque_no" style="display: none;">
                            <label for="exampleInputEmail1"> Cheque No</label>
                            <input type="text" class="form-control" name="cheque_no" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <label class="control-label col-md-3 note">Note</label>
                        <div class="col-md-12 note">
                            <textarea class="ckeditor form-control" name="note" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info">Submit</button>
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
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> View Payments</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                    <thead>
                        <tr>
                            <th> Date </th>
                            <th> Reference </th>
                            <th>Amount </th>
                            <th>Paid By </th>
                            <th class="option_th"> Options </th>
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
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> View Purchase</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                    <thead>
                        <tr>
                            <th> Title </th>
                            <th> Value </th>
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

                var $tr6 = $('<tr>').append(
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