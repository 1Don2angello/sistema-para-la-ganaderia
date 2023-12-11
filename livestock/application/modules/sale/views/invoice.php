<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- invoice start-->
        <section>
            <div class="panel panel-primary">
                <!--<div class="panel-heading navyblue"> INVOICE</div>-->
                <div class="panel-body col-md-5 panel-moree" style="font-size: 10px;">
                    <div class="row invoice-list">

                        <div class="text-center corporate-id">
                            <h1>
                                <?php echo $settings->title ?>
                            </h1>
                            <h4>
                                <?php echo $settings->address ?>
                            </h4>
                            <h4>
                                <?php  echo lang('tel'); ?>: <?php echo $settings->phone ?>
                            </h4>
                        </div>

                        <div class="col-lg-4 col-sm-4 list_item">
                            <h4>  <?php  echo lang('payment_to'); ?>:</h4>
                            <p>
                                <?php echo $settings->title; ?> <br>
                                <?php echo $settings->address; ?><br>
                                <?php  echo lang('tel'); ?>:  <?php echo $settings->phone; ?>
                            </p>
                        </div>
                        <?php if (!empty($sale->client)) { ?>
                            <div class="col-lg-4 col-sm-4 list_item">
                                <h4>  <?php  echo lang('bill_to'); ?>:</h4>
                                <p>
                                    <?php
                                    $client_info = $this->db->get_where('client', array('id' => $sale->client))->row();
                                    echo $client_info->name . ' <br>';
                                    echo $client_info->address . '  <br/>';
                                    P: echo $client_info->phone
                                    ?>
                                </p>
                            </div>
                        <?php } ?>
                        <div class="col-lg-4 col-sm-4 list_item">
                            <h4>  <?php  echo lang('invoice_info'); ?></h4>
                            <ul class="unstyled">
                                <li>  <?php  echo lang('invoice_number'); ?>		: <strong>00<?php echo $sale->id; ?></strong></li>
                            </ul>
                        </div>

                        <div class="col-lg-4 col-sm-4 list_item">
                            <h4>  <?php  echo lang('date'); ?></h4>
                            <ul class="unstyled"> 
                                <li><?php echo date($settings->date_format, $sale->date); ?></li>    
                            </ul>
                        </div>
                    </div>

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> <?php  echo lang('description'); ?> </th>
                                <th> <?php  echo lang('unit_price'); ?></th>
                                <th> <?php  echo lang('quantity'); ?> </th>
                                <th> <?php  echo lang('total_per_item'); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($sale->x_ray)) { ?>
                                <tr>
                                    <td><?php echo $i = 1 ?></td>
                                    <td><?php  echo lang('x_ray'); ?></td>
                                    <td class=""><?php echo $settings->currency; ?> <?php echo $sale->x_ray; ?> </td>
                                </tr>
                            <?php } ?>
                            <?php
                            if (!empty($sale->category_name)) {
                                $category_name = $sale->category_name;
                                $category_name1 = explode(',', $category_name);
                                if (empty($sale->x_ray)) {
                                    $i = 0;
                                }
                                foreach ($category_name1 as $category_name2) {
                                    $category_name3 = explode('*', $category_name2);
                                    if ($category_name3[1] > 0) {
                                        ?>                
                                        <tr>
                                            <td><?php echo $i = $i + 1; ?></td>
                                            <td><?php echo $this->db->get_where('product', array('id' => $category_name3[0]))->row()->name; ?> </td>
                                            <td class=""><?php echo $settings->currency; ?> <?php echo $category_name3[1]; ?> </td>
                                            <td class=""> <?php echo $category_name3[2]; ?> </td>
                                            <td class=""><?php echo $settings->currency; ?> <?php echo $category_name3[1] * $category_name3[2]; ?> </td>
                                        </tr> 
                                        <?php
                                    }
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-lg-4 invoice-block pull-right">
                            <ul class="unstyled amounts">
                                <li><strong>  <?php  echo lang('sub_total_amount'); ?> : </strong><?php echo $settings->currency; ?> <?php echo $sale->amount; ?></li>
                                <?php if (!empty($sale->discount)) { ?>
                                    <li><strong><?php  echo lang('discount'); ?></strong> <?php
                                        if ($discount_type == 'percentage') {
                                            echo '(%) : ';
                                        } else {
                                            echo ': ' . $settings->currency;
                                        }
                                        ?> <?php
                                        $discount = explode('*', $sale->discount);
                                        if (!empty($discount[1])) {
                                            echo $discount[0] . ' %  =  ' . $settings->currency . ' ' . $discount[1];
                                        } else {
                                            echo $discount[0];
                                        }
                                        ?></li>
                                <?php } ?>
                                <?php if (!empty($sale->vat)) { ?>
                                    <li><strong> Vat  :</strong>   <?php
                                        if (!empty($sale->vat)) {
                                            echo $sale->vat;
                                        } else {
                                            echo '0';
                                        }
                                        ?> % = <?php echo $settings->currency . ' ' . $sale->flat_vat; ?></li>
                                <?php } ?>
                                <li><strong>   <?php  echo lang('grand_total'); ?>: </strong><?php echo $settings->currency; ?> <?php echo $sale->gross_total; ?></li>
                            </ul>
                        </div>
                    </div>


                    <div class="text-center invoice-btn">
                        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                            <a href="sale/editSale?id=<?php echo $sale->id; ?>" class="btn btn-info btn-lg invoice_button" style="width:150px;"><i class="fa fa-edit"></i>  <?php  echo lang('edit_inventory'); ?></a>
                        <?php } ?>

                        <a class="btn btn-info btn-lg invoice_button" onclick="javascript:window.print();"><i class="fa fa-print"></i> <?php  echo lang('print'); ?> </a>
                    </div>


                </div>

                
            </div>
        </section>
        <!-- invoice end-->
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

