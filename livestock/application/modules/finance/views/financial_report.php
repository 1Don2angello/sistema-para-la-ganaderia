<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <header class="panel-heading"> 
            <i class="fa fa-user"></i> <?php echo lang('financial_report'); ?> 
        </header>
        <div class="col-md-12 panel-body no-print">
            <div class="col-md-7">
                <section>
                    <form role="form" class="f_report" action="finance/financialReport" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <!--     <label class="control-label col-md-3">Date Range</label> -->
                            <div class="col-md-6">
                                <div class="input-group input-large">
                                    <input type="text" class="form-control dpd1" name="date_from" value="<?php
                                    if (!empty($from)) {
                                        echo $from;
                                    }
                                    ?>" placeholder="<?php echo lang('date_from'); ?>">
                                    <span class="input-group-addon"><?php echo lang('to'); ?></span>
                                    <input type="text" class="form-control dpd2" name="date_to" value="<?php
                                    if (!empty($to)) {
                                        echo $to;
                                    }
                                    ?>" placeholder="<?php echo lang('date_to'); ?>">
                                </div>
                                <div class="row"></div>
                                <span class="help-block"></span> 
                            </div>
                            <div class="col-md-6 no-print">
                                <button type="submit" name="submit" class="btn btn-info range_submit"><?php echo lang('submit'); ?></button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
            <div class="col-md-5">
                <button class="btn btn-info green no-print pull-right" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>
            </div>
        </div>

        <?php
        if (!empty($sales)) {
            $paid_number = 0;
            foreach ($sales as $sale) {
                $paid_number = $paid_number + 1;
            }
        }
        ?>
        <div class="row">
            <div class="col-lg-12">

                <section class="panel">
                    <header class="panel-heading">
                        <i class="fa fa-money"></i> <?php echo lang('sales_report'); ?> 
                    </header>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th><i class="fa fa-bullhorn"></i> <?php echo lang('product'); ?></th>
                                <th>#<?php echo lang('quantity'); ?> </th>
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> <?php echo lang('amount'); ?></th>

                            </tr>
                        </thead>
                        <tbody>


                            <?php foreach ($sales as $sale) { ?>
                                <tr class="">


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

                                    <td>  <?php
                                        $gross = $sale->amount;
                                        echo number_format($gross, 2, '.', ',');
                                        ?>
                                    </td>





                                </tr>
                            <?php } ?>
                        </tbody>
                        <tbody>
                            <tr>
                                <td><h3><?php echo lang('sub_total'); ?> </h3></td>
                                <td></td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    $sub_total = array();
                                    foreach ($sales as $sale) {
                                        $sub_total[] = $sale->amount;
                                    }
                                    if (!empty($sub_total)) {
                                        echo array_sum($sub_total);
                                    } else {
                                        echo '0';
                                    }
                                    ?> 
                                </td>
                            </tr>


                            <tr>
                                <td><h5><?php echo lang('total_discount'); ?></h5></td>
                                <td></td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($sales)) {
                                        foreach ($sales as $sale) {
                                            $discount[] = $sale->discount;
                                        }
                                        if ($paid_number > 0) {
                                            echo array_sum($discount);
                                        } else {
                                            echo '0';
                                        }
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <!--
                            <tr>
                                <td><h5><?php echo lang('total'); ?> <?php echo lang('vat'); ?></h5></td>
                                <td>
                            <?php echo $settings->currency; ?>
                            <?php
                            if (!empty($sales)) {
                                foreach ($sales as $sale) {
                                    $vat[] = $sale->flat_vat;
                                }
                                if ($paid_number > 0) {
                                    echo array_sum($vat);
                                } else {
                                    echo '0';
                                }
                            } else {
                                echo '0';
                            }
                            ?>
                                </td>
                            </tr>
                            -->
                            <tr>
                                <td><h5><i class="fa fa-money"></i> <?php echo lang('gross_total'); ?></h5></td>
                                <td></td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($sales)) {
                                        if ($paid_number > 0) {
                                            $gross = array_sum($sub_total) - array_sum($discount) + array_sum($vat);
                                            echo $gross;
                                        } else {
                                            echo '0';
                                        }
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </td>
                            </tr>



                        </tbody>
                    </table>
                </section>

                <?php
                if (!empty($purchases)) {
                    $paid_number = 0;
                    foreach ($purchases as $purchase) {
                        $paid_number = $paid_number + 1;
                    }
                }
                ?>
                <section class="panel">
                    <header class="panel-heading">
                        <i class="fa fa-money"></i>  <?php echo lang('purchase_report'); ?>
                    </header>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th><i class="fa fa-bullhorn"></i> <?php echo lang('product'); ?></th>
                                <th></th>
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> <?php echo lang('amount'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($purchases as $purchase) { ?>
                                <tr> 


                                    <td><?php echo $this->product_model->getProductById($purchase->product)->name; ?></td> 
                                    <td></td>

                                    <td><?php echo $purchase->amount_payable; ?></td></tr>
                            <?php } ?>

                            <tr> <td><h3><?php echo lang('sub_total'); ?></h3></td>
                                <td></td>
                                <td> 

                                    <?php echo $settings->currency; ?>
                                    <?php
                                    $sub_total = array();
                                    foreach ($purchases as $purchase) {
                                        $sub_total[] = $purchase->amount_payable;
                                    }
                                    if (!empty($sub_total)) {
                                        echo array_sum($sub_total);
                                    } else {
                                        echo '0';
                                    }
                                    ?> </td></tr>



                        </tbody>
                    </table>
                </section>







            </div>


            <style>
                .billl{
                    background: #39B24F !important;
                }

                .due{
                    background: #39B1D1 !important;
                }
            </style>







        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
