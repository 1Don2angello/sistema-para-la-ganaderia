<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-money"></i>   <?php echo lang('expenses_details'); ?> 
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix new">
                        <a href="expense/addExpenseView">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i>  <?php echo lang('add_expense'); ?>
                                </button>
                            </div>
                        </a>
                        <a href="expense/addExpensePayment">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i> <?php echo lang('payment'); ?>
                                </button>
                            </div>
                        </a>
                        <button class="export" onclick="javascript:window.print();"> <?php echo lang('print'); ?></button>    
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('date'); ?></th>
                                <th> <?php echo lang('category'); ?></th>
                                <th> <?php echo lang('sector'); ?></th>
                                <th>  <?php echo lang('voucher_no'); ?></th>
                                <th><?php echo lang('note'); ?></th>
                                <th> <?php echo lang('paid'); ?> </th>
                                <th>  <?php echo lang('expensed'); ?></th>
                                <th>  <?php echo lang('balance'); ?></th>

                                <th class="option_th"> <?php echo lang('options'); ?></th>

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

                        <?php foreach ($expenses as $expense) { ?>
                            <tr class="">
                                <td> <?php echo date($settings->date_format, $expense->date); ?></td>
                                <td> <?php
                                    if (!empty($expense->category)) {
                                        echo $this->expense_model->getExpenseCategoryById($expense->category)->category;
                                    }
                                    ?></td>
                                <td> <?php
                                    if (!empty($expense->sub_category)) {
                                        echo $this->expense_model->getExpenseSubCategoryById($expense->sub_category)->name;
                                    }
                                    ?></td>
                                <td> <?php echo $expense->voucher_no; ?></td>
                                <td> <?php echo $expense->note; ?></td>
                                <td><?php
                                    if (!empty($expense->paid)) {
                                        echo $settings->currency;
                                        ?> <?php
                                        echo number_format($expense->paid, 2, '.', ',');
                                    }
                                    ?></td>
                                <td><?php
                                    if (!empty($expense->amount)) {
                                        echo $settings->currency;
                                        ?> <?php
                                        echo number_format($expense->amount, 2, '.', ',');
                                    }
                                    ?></td>  


                                <?php
                                $paid[] = $expense->paid;
                                if (!empty($paid)) {
                                    $pdd = array_sum($paid);
                                } else {
                                    $pdd = '0';
                                }
                                $amount[] = $expense->amount;
                                if (!empty($amount)) {
                                    $amnt = array_sum($amount);
                                } else {
                                    $amnt = '0';
                                }
                                ?>


                                <td> <?php echo $settings->currency; ?> <?php echo number_format($pdd - $amnt, 2, '.', ','); ?></td>  


                                <td class="option">
                                    <a class="btn btn-xs editbutton" href="expense/<?php
                                    if (!empty($expense->paid)) {
                                        echo 'editExpensePayment';
                                    } else {
                                        echo 'editExpense';
                                    }
                                    ?>?id=<?php echo $expense->id; ?>"><i class="fa fa-edit"></i>  <?php echo lang('edit'); ?></a>
                                    <a class="btn btn-xs" href="expense/deleteExpense?id=<?php echo $expense->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i>  <?php echo lang('delete'); ?></a>
                                </td>

                            </tr>
                        <?php } ?>


                        <?php
                        if (!empty($paid)) {
                            $total_pdd = array_sum($paid); 
                        } else {
                            $total_pdd = '0';
                        }
                        if (!empty($amount)) {
                            $total_amnt = array_sum($amount);
                        } else {
                            $total_amnt = '0';
                        }
                        ?>

                        <tr>
                            <td class="medici_name total"></td>
                            <td class="medici_name total"></td>
                            <td class="medici_name total"></td>
                            <td class="medici_name total"></td>
                            <td class="medici_name total"><?php echo lang('total'); ?></td>
                            <td class="medici_name total"><?php echo $settings->currency; ?> <?php echo number_format($total_pdd, 2, '.', ','); ?></td>
                            <td class="medici_name total"><?php echo $settings->currency; ?> <?php echo number_format($total_amnt, 2, '.', ','); ?></td>
                            <td class="medici_name total"><?php echo $settings->currency; ?> <?php echo number_format($total_pdd - $total_amnt, 2, '.', ','); ?></td>
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
