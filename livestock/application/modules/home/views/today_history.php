<!--sidebar end-->
<!--main content start-->
<section id="main-content"> 
    <section class="wrapper site-min-height"> 

        <header class="panel-heading">
            <i class="fa fa-money"></i>   <?php echo lang('today_report'); ?> 
        </header>
        <!--state overview start-->
        <div class="col-md-12">
            <?php if (!$this->ion_auth->in_group('Client')) { ?>

                <div class="">
                    <div class="col-md-3 total_title payable"> <h3><?php echo lang('purchase_today'); ?> </h3>  <?php echo $settings->currency; ?> <?php echo number_format($today_purchase, 2, '.', ','); ?>  </div> 
                    <div class="col-md-3 total_title paid"> <h3><?php echo lang('sale_today'); ?>  </h3> <?php echo $settings->currency; ?> <?php echo number_format($today_sale, 2, '.', ','); ?> </div> 
                    <div class="col-md-3 total_title due_payable"> <h3> <?php echo lang('expense_today'); ?> </h3> <?php echo $settings->currency; ?> <?php echo number_format($today_expense, 2, '.', ','); ?>   </div> 
                </div>



            <?php } ?>
        </div>

        <div class="col-md-12">



        </div>



        <!--state overview end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
<!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->

</body>
</html>
