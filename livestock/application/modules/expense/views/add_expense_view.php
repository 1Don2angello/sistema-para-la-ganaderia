<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($expense->id))
                    echo '<i class="fa fa-edit"></i> ' . lang('edit_expense');
                else
                    echo '<i class="fa fa-plus-circle"></i> ' . lang('add_expense');
                ?>
            </header>
            <div class="panel">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-md-6">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo validation_errors(); ?>
                                    <form role="form" action="expense/addExpense" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                                            <input type="text" class="form-control default-date-picker" name="date" id="exampleInputEmail1" value='<?php
                                            if (!empty($expense->date)) {
                                                echo date($settings->date_format, $expense->date);
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('category'); ?></label>
                                            <select class="form-control m-bot15" name="category" value=''>
                                                <?php foreach ($categories as $category) { ?>
                                                    <option value="<?php echo $category->id; ?>" <?php
                                                    if (!empty($expense->category)) {
                                                        if ($category->id == $expense->category) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?> > <?php echo $category->category; ?> </option>
                                                        <?php } ?> 
                                            </select>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label for="exampleInputEmail1">  <?php echo lang('sub_category'); ?></label>
                                            <select class="form-control m-bot15" name="sub_category" value=''>
                                                <?php foreach ($sub_categories as $sub_category) { ?>
                                                 <option value="">Select Sub Category ---</option>
                                                    <option value="<?php echo $sub_category->id; ?>" <?php
                                                    if (!empty($expense->sub_category)) {
                                                        if ($sub_category->id == $expense->sub_category) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?> > <?php echo $sub_category->name; ?> </option>
                                                        <?php } ?> 
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('vouchar_no'); ?></label>
                                            <input type="text" class="form-control" name="voucher_no" id="exampleInputEmail1" value='<?php
                                            if (!empty($expense->voucher_no)) {
                                                echo $expense->voucher_no;
                                            }
                                            ?>' placeholder="">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">  <?php echo lang('amount'); ?></label>
                                            <input type="text" class="form-control" name="amount" id="exampleInputEmail1" value='<?php
                                            if (!empty($expense->amount)) {
                                                echo $expense->amount;
                                            }
                                            ?>' placeholder="<?php echo $settings->currency; ?>">
                                        </div>
                                        
                                         <div class="form-group">
                                            <label for="exampleInputEmail1">  <?php echo lang('note'); ?></label>
                                            <input type="text" class="form-control" name="note" id="exampleInputEmail1" value='<?php
                                            if (!empty($expense->note)) {
                                                echo $expense->note;
                                            }
                                            ?>' placeholder="">
                                        </div>

                                        <input type="hidden" name="category_id" value='<?php
                                        if (!empty($category_id)) {
                                            echo $category_id;
                                        }
                                        ?>'>
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($expense->id)) {
                                            echo $expense->id;
                                        }
                                        ?>'>
                                        <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?> </button>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
