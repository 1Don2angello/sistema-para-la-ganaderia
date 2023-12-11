<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-money"></i>   Shed History 
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix new">
                       
                        <button class="export green" onclick="javascript:window.print();"> Print</button>     
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th> Shed </th>
                                <th> Vaccine Name </th>
                                <th> Vaccine Date </th>
                                <th> Vaccine Duration (days)</th>
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

                        <?php foreach ($sheds as $shed) { ?>
                            <tr class="">
                                <td><?php echo $shed->no; ?></td>  
                                <td> 
                                    <?php
                                    
                                       echo $vaccine->name;
                                 
                                    ?>
                                </td>
                                <td> 
                                     <?php
                                   
                                       echo $vaccine->date;
                                   
                                    ?>
                                </td>
                                <td>
                                     <?php
                                   
                                       echo $vaccine->duration;
                                 
                                    ?>
                                </td>


                                <td class="option"> 

                                    <a style="width:90px;"class="btn btn-info btn-xs green" href="vaccine/vaccineDetailsByShed?shed_id=<?php echo $shed->id; ?>"><i class="fa fa-eye"> </i> Details</a>

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