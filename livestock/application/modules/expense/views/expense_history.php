<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-money"></i>      <?php echo lang('expense_history'); ?> 
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix new">
                        <a href="expense/addExpenseView">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i>    <?php echo lang('add_expense'); ?>
                                </button>
                            </div>
                        </a>
                        <button class="export" onclick="javascript:window.print();">  <?php echo lang('print'); ?> </button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th>   <?php echo lang('category'); ?></th>
                                <th>   <?php echo lang('paid'); ?></th>
                                <th>   <?php echo lang('bill'); ?></th>
                                <th>   <?php echo lang('cash_in_hand'); ?></th>

                                <th class="option_th"> Options  <?php echo lang('options'); ?></th>

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

                        <?php foreach ($categories as $category) { ?>
                            <tr class="">
                                <td><?php echo $category->category ?></td>
                                <td><?php echo $settings->currency; ?> 


                                    <?php
                                    foreach ($expenses as $expense) {
                                        if ($expense->category == $category->id) {
                                            $paid[] = $expense->paid;
                                        }
                                    }
                                    if (!empty($paid)) {
                                        $pdd = array_sum($paid);
                                    } else {
                                        $pdd = '0';
                                    }

                                    echo number_format($pdd, 2, '.', ',');

                                    $total_paid[] = $pdd;
                                    $paid = NULL;
                                    ?>


                                </td>


                                <td><?php echo $settings->currency; ?>

                                    <?php
                                    foreach ($expenses as $expense) {
                                        if ($expense->category == $category->id) {
                                            $expensed[] = $expense->amount;
                                        }
                                    }
                                    if (!empty($expensed)) {
                                        $expd = array_sum($expensed);
                                    } else {
                                        $expd = '0';
                                    }
                                    echo number_format($expd, 2, '.', ',');

                                    $total_expensed[] = $expd;
                                    $expensed = NULL;
                                    ?>
                                </td> 

                                <td><?php echo $settings->currency; ?>

                                    <?php
                                    echo number_format($pdd - $expd, 2, '.', ',');
                                    ?>
                                </td> 



                                <td class="option">
                                    <a class="btn btn-info btn-xs details" href="expense/expenseDetails?id=<?php echo $category->id; ?>"><i class="fa fa-eye"></i> Details <?php echo lang('details'); ?></a>

                                </td>

                            </tr>
                        <?php } ?>

                        <tr>
                            <td class="medici_name total">  <?php echo lang('total'); ?></td>
                            <td class="medici_name total"> <?php echo $settings->currency; ?>  <?php
                                $total_pdd = array_sum($total_paid);
                                echo number_format($total_pdd, 2, '.', ',');
                                ?> 
                            </td>
                            <td class="medici_name total"> <?php echo $settings->currency; ?>  <?php
                                $total_expd = array_sum($total_expensed);
                                echo number_format($total_expd, 2, '.', ',');
                                ?>
                            </td>
                            <td class="medici_name total"> <?php echo $settings->currency; ?>  <?php echo number_format($total_pdd - $total_expd, 2, '.', ','); ?></td>
                            <td class="medici_name total"></td>
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
