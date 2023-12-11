<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-money"></i>   <?php echo lang('expense_history'); ?>   : <span> <?php echo $this->expense_model->getExpenseCategoryById($category_id)->category; ?> </span>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix new">
                        <a href="expense/addExpenseView?category_id=<?php echo $category_id; ?>">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i>  <?php echo lang('add_expense'); ?>
                                </button>
                            </div>
                        </a>
                        <a href="expense/addExpensePayment?category_id=<?php echo $category_id; ?>">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i>   <?php echo lang('pay'); ?>
                                </button>
                            </div>
                        </a>
                        <button class="export" onclick="javascript:window.print();"> <?php echo lang('print'); ?> </button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                 <th>   <?php echo lang('date'); ?></th>
                                
                                <th>   <?php echo lang('voucher_no'); ?></th>
                                <th>  <?php echo lang('note'); ?> </th>
                                <th>  <?php echo lang('paid'); ?></th>
                                <th>   <?php echo lang('expensed'); ?></th>
                                <th>   <?php echo lang('balance'); ?></th>
                                
                                <?php if ($this->ion_auth->in_group('admin')) { ?>
                                    <th class="option_th"> <?php echo lang('options'); ?> </th>
                                <?php } ?>
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
                                <td> <?php echo date('d/m/y', $expense->date); ?></td>
                                <td> <?php echo $expense->voucher_no; ?></td>
                                <td> <?php echo $expense->note; ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $expense->paid; ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $expense->amount; ?></td>  


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


                                <td> <?php echo $settings->currency; ?> <?php echo $pdd - $amnt; ?></td>  

                                <?php if ($this->ion_auth->in_group('admin')) { ?>
                                    <td class="option">
                                        <a class="btn btn-info btn-xs editbutton width_auto" href="expense/editExpense?id=<?php echo $expense->id; ?>"><i class="fa fa-edit"></i>  <?php echo lang('edit'); ?></a>
                                        <a class="btn btn-info btn-xs delete_button width_auto" href="expense/deleteExpense?id=<?php echo $expense->id; ?>&category_id=<?php echo $category_id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i>  <?php echo lang('delete'); ?></a>
                                    </td>
                                <?php } ?>
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
                            <td class="medici_name total">Total</td>
                            <td class="medici_name total"><?php echo $settings->currency; ?> <?php echo $total_pdd; ?></td>
                            <td class="medici_name total"><?php echo $settings->currency; ?> <?php echo $total_amnt; ?></td>
                            <td class="medici_name total"><?php echo $settings->currency; ?> <?php echo $total_pdd - $total_amnt; ?></td>
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
