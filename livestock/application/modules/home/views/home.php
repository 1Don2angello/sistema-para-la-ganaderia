<!--sidebar end-->
<!--main content start-->


<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->

         <div class="row state-overview">
            <a href="purchase">
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol blue">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="value">


                            <h1> <?php echo $settings->currency; ?> <?php echo number_format($total_purchase_payable); ?> <br>
                                <!--
                                <?php echo lang('paid'); ?> : <?php echo $settings->currency; ?> <?php echo number_format($total_purchase_paid, 2, '.', ','); ?> <br>
                                <?php echo lang('due'); ?> :  <?php echo $settings->currency; ?> <?php echo number_format($total_purchase_payable - $total_purchase_paid, 2, '.', ','); ?>
                                --> </h1>
                            <strong><?php echo lang('purchase'); ?> </strong>
                        </div>
                    </section>
                </div></a>
            <a href="sale">
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol yellow">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="value">
                            <h1 class=" count2">  <?php echo $settings->currency; ?> <?php echo number_format($total_international_sale); ?> </br>
                                <!--
                                <?php echo lang('received'); ?> :  <?php echo $settings->currency; ?> <?php echo number_format($total_international_payment, 2, '.', ','); ?> </br>
                                <?php echo lang('due'); ?> : <?php echo $settings->currency; ?>  <?php echo number_format($total_international_sale - $total_international_payment, 2, '.', ','); ?>
                                --></h1>
                            <strong> <?php echo lang('sale'); ?> </strong>
                        </div>
                    </section>
                </div></a>
             <a href="expense">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol red">
                        <i class="fa fa-money"></i>
                    </div>
                    <div class="value">
                        <h1 class="count"> <?php echo $settings->currency; ?> <?php echo number_format($expensed_amount); ?> </br>
                            <!--
                            <?php echo lang('paid'); ?>  : <?php echo $settings->currency; ?> <?php echo number_format($expenses_paid, 2, '.', ','); ?> <br>      
                            <?php echo lang('cash_in_hand'); ?>  : <?php echo $settings->currency; ?> <?php echo number_format($expenses_paid - $expensed_amount, 2, '.', ','); ?>
                            --> </h1>
                        <strong><?php echo lang('expense'); ?> </strong>
                    </div>
                </section>
            </div></a>
            
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol terques">
                            <i class="fa fa-money"></i> 
                        </div>
                        <div class="value">
                            <h1 class=" count2">  <?php echo $settings->currency; ?> <?php echo number_format($today_sale); ?></h1> 
                            <strong><?php echo lang('sale'); ?> <?php echo lang('today'); ?></strong>
                        </div>
                    </section>
                </div>
        </div>
        
        
        <div class="row state-overview">
            <a href="client">
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol terques">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="value">
                            <h1> <?php echo $this->db->count_all('client'); ?></h1>
                            <strong><?php echo lang('total_clients'); ?> </strong>
                        </div>
                    </section>
                </div></a>
            <a href="shed">
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol red">
                            <i class="fa fa-suitcase"></i>
                        </div>
                        <div class="value">
                            <h1 class=" count2"> <?php
                                echo $this->home_model->getSum();
                                ?></h1>
                            <strong><?php echo lang('total_livestock'); ?> </strong>
                        </div>
                    </section>
                </div></a>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol terques">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="value">
                        <h1 class="count"> <?php
                            $new_client = 0;
                            foreach ($clients as $client) {
                                if ($client->add_date == date('m/d/y')) {
                                    $new_client = $new_client + 1;
                                }
                            }
                            echo $new_client;
                            ?></h1>
                        <strong><?php echo lang('today_new_client'); ?> </strong>
                    </div>
                </section>
            </div>
            <a href="staff">
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol red">
                            <i class="fa fa-suitcase"></i>
                        </div>
                        <div class="value">
                            <h1 class=" count2"> <?php echo $this->db->count_all('staff'); ?></h1>
                            <strong><?php echo lang('total_staff'); ?></strong>
                        </div>
                    </section>
                </div></a>
        </div>


       



        <div class="row state-overview">
            <a href="product">
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol yellow">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <div class="value">
                            <h1 class=" count4"> <?php echo $this->db->count_all('product'); ?></h1>
                            <strong><?php echo lang('total_products'); ?> </strong>
                        </div>
                    </section>
                </div></a>
            <a href="supplier">
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol blue">
                            <i class="fa fa-road"></i>
                        </div>
                        <div class="value">
                            <h1 class=" count3"> <?php echo $this->db->count_all('supplier'); ?></h1>
                            <strong><?php echo lang('total_supplier'); ?> </strong> 
                        </div>
                    </section>
                </div></a>
            <a href="shed">
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol yellow">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <div class="value">
                            <h1 class=" count4"> <?php echo $this->db->count_all('shed'); ?></h1>
                            <strong><?php echo lang('total_shed'); ?> </strong>
                        </div>
                    </section>
                </div></a>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol blue">
                        <i class="fa fa-road"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count3"> <?php
                            $new_supplier = 0;
                            foreach ($suppliers as $supplier) {
                                if ($supplier->add_date == date('m/d/y')) {
                                    $new_supplier = $new_supplier + 1;
                                }
                            }
                            echo $new_supplier;
                            ?></h1>
                        <strong><?php echo lang('today_new_supplier'); ?> </strong>
                    </div>
                </section>
            </div>
        </div>

        <section class="panel">

            <div class="panel-body">
                <div class="adv-table editable-table ">

                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="">
                        <thead>
                            <tr>
                                <th><?php echo lang('shed_id'); ?></th>
                                <th><?php echo lang('shed_no'); ?></th> 
                                <th><?php echo lang('livestock_type'); ?></th>                        
                                <th><?php echo lang('purchase_date'); ?></th>
                                <th><?php echo lang('age'); ?></th>
                                <th><?php echo lang('quantity'); ?></th>

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
                        </style>
                        <?php foreach ($sheds as $shed) { ?>
                            <tr class="">
                                <td><?php echo $shed->shed_id; ?></td>
                                <td><?php echo $shed->no; ?></td>
                                <td><?php echo $shed->chicken_type; ?></td>
                                <td><?php echo $shed->date; ?></td>
                                <td><?php echo $shed->age; ?></td>
                                <td><?php echo $shed->quantity; ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="5"><?php echo lang('total_livestock_quantity'); ?></td>
                            <td><?php echo $this->home_model->getSum(); ?></td>
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
