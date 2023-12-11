<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="<?php echo base_url(); ?>">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Rizvi">
        <meta name="keyword" content="Php, Livestock, Chicken, Management, Software, Php, CodeIgniter, Accounting">
        <link rel="shortcut icon" href="uploads/logo1.png">
        <title><?php echo $this->router->fetch_class(); ?> | <?php echo lang('livestock'); ?> </title>
        <!-- Bootstrap core CSS -->
        <link href="common/css/bootstrap.min.css" rel="stylesheet">
        <link href="common/css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="common/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link rel="stylesheet" href="common/assets/data-tables/DT_bootstrap.css" />
        <!-- Custom styles for this template -->
        <link href="common/css/style.css" rel="stylesheet">
        <link href="common/css/style-responsive.css" rel="stylesheet" />

        <link rel="stylesheet" href="common/assets/bootstrap-datepicker/css/datepicker.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-datetimepicker/css/datetimepicker.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/jquery-multi-select/css/multi-select.css" />
        <link href="common/css/invoice-print.css" rel="stylesheet" media="print">
        <link rel="stylesheet" type="text/css" href="common/assets/select2/select2.min.css"/>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <section id="container" class="">
            <!--header start-->
            <header class="header white-bg">
                <div class="sidebar-toggle-box">
                    <div data-original-title="Toggle Navigation" data-placement="right" class="fa fa-bars tooltips"></div>
                </div>

                <!--logo start-->
                <a href="" class="logo"><?php echo lang('live'); ?><span><?php echo lang('stock'); ?></span></a>
                <!--logo end-->
                <div class="nav notify-row">
                    <header class="panel-heading top_menu_title">
                        <?php echo $settings->system_vendor; ?>
                    </header>
                </div>
                <div class="top-nav ">
                    <?php
                    $message = $this->session->flashdata('feedback');
                    if (!empty($message)) {
                        ?>
                        <div class="flashmessage pull-left"><i class="fa fa-check"></i> <?php echo $message; ?></div>
                    <?php } ?> 
                    <ul class="nav pull-right top-menu">
                        <!-- user login dropdown start-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <img alt="" src="uploads/logo3.png" width="21" height="23">
                                <span class="username"><?php echo $this->ion_auth->user()->row()->username; ?></span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
                                <div class="log-arrow-up"></div>
                                <?php if (!$this->ion_auth->in_group('admin')) { ?> 
                                    <li><a href=""><i class="fa fa-dashboard"></i> <?php echo lang('dashboard'); ?></a></li>
                                <?php } ?>
                                <li><a href="profile"><i class=" fa fa-suitcase"></i><?php echo lang('profile'); ?></a></li>
                                <?php if ($this->ion_auth->in_group('admin')) { ?> 
                                    <li><a href="settings"><i class="fa fa-cog"></i> <?php echo lang('settings'); ?></a></li>
                                <?php } ?>

                                <li><a><i class="fa fa-user"></i> <?php echo $this->ion_auth->get_users_groups()->row()->name ?></a></li>
                                <li><a href="auth/logout"><i class="fa fa-key"></i> <?php echo lang('logout'); ?></a></li>
                            </ul>
                        </li>
                        <!-- user login dropdown end -->
                    </ul>
                </div>
            </header>
            <!--header end-->
            <!--sidebar start-->
            <aside>
                <div id="sidebar"  class="nav-collapse ">
                    <!-- sidebar menu start-->
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a href="">
                                <i class="fa fa-dashboard"></i>
                                <span><?php echo lang('dashboard'); ?></span>
                            </a>
                        </li>
                         <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <li class="treeview">
                                <a href="">
                                    <i class="fa fa-hdd-o"></i>
                                    <span><?php echo lang('livestock'); ?></span>
                                    <span class="pull-right-container">                                        
                                    </span>
                                </a>
                                <ul class="treeview-menu">                                   

                                    <li><a href="livestock"><i class="fa fa-list"></i><?php echo lang('livestock'); ?><?php echo lang('list'); ?></a></li> 
                                    <li><a href="livestock/addNewView"><i class="fa fa-plus-circle"></i><span><?php echo lang('add'); ?> <?php echo lang('livestock'); ?></span></a></li>  
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <li class="treeview">
                                <a href="">
                                    <i class="fa fa-home"></i>
                                    <span><?php echo lang('shed'); ?></span>
                                    <span class="pull-right-container">                                        
                                    </span>
                                </a>
                                <ul class="treeview-menu">                                   

                                    <li><a href="shed"><i class="fa fa-list"></i><?php echo lang('shed'); ?> <?php echo lang('list'); ?></a></li> 
                                    <li><a href="shed/addNewView"><i class="fa fa-plus-circle"></i><span><?php echo lang('add'); ?> <?php echo lang('shed'); ?></span></a></li>  
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <li class="treeview">
                                <a href="">
                                    <i class="fa fa-medkit"></i>
                                    <span><?php echo lang('vaccine'); ?></span>
                                    <span class="pull-right-container">                                        
                                    </span>
                                </a>
                                <ul class="treeview-menu">                                   

                                    <li><a href="vaccine"><i class="fa fa-list"></i><?php echo lang('vaccine'); ?> <?php echo lang('list'); ?></a></li> 
                                    <li><a href="vaccine/addNewView"><i class="fa fa-plus-circle"></i><span><?php echo lang('add'); ?> <?php echo lang('vaccine'); ?></span></a></li>  
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <li class="treeview">
                                <a href="">
                                    <i class="fa fa-sitemap"></i>
                                    <span><?php echo lang('food_history'); ?></span>
                                    <span class="pull-right-container">                                         
                                    </span>
                                </a>
                                <ul class="treeview-menu">                                   

                                    <li><a href="food"><i class="fa fa-users"></i><?php echo lang('food_history'); ?> <?php echo lang('list'); ?></a></li>
                                    <li><a href="food/addNewView"><i class="fa fa-plus-circle"></i><span><?php echo lang('add_new'); ?> <?php echo lang('food_history'); ?></span></a></li>  
                                </ul>
                            </li>
                        <?php } ?>


                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <li class="treeview">
                                <a href="">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span><?php echo lang('product'); ?></span>
                                    <span class="pull-right-container">                                        
                                    </span>
                                </a>
                                <ul class="treeview-menu">                                   

                                    <li><a href="product"><i class="fa fa-list"></i><?php echo lang('product'); ?> <?php echo lang('list'); ?></a></li> 
                                    <li><a href="product/addNewView"><i class="fa fa-plus-circle"></i><span><?php echo lang('add'); ?> <?php echo lang('product'); ?></span></a></li> 
                                    <li><a href="product/categoryList"><i class="fa fa-plus-circle"></i><span><?php echo lang('category'); ?></span></a></li>
                                </ul>
                            </li>
                        <?php } ?>


                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <li class="treeview">
                                <a href="">
                                    <i class="fa fa-money"></i>
                                    <span><?php echo lang('purchase'); ?></span>
                                    <span class="pull-right-container">                                        
                                    </span>
                                </a>
                                <ul class="treeview-menu">                                   

                                    <li><a href="purchase"><i class="fa fa-users"></i><?php echo lang('purchase'); ?> <?php echo lang('list'); ?></a></li>
                                    <li><a href="purchase/addPurchaseView"><i class="fa fa-plus-circle"></i><span><?php echo lang('add'); ?> <?php echo lang('purchase'); ?></span></a></li>  
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <li class="treeview">
                                <a href="">
                                    <i class="fa fa-money"></i>
                                    <span><?php echo lang('sales'); ?></span>
                                    <span class="pull-right-container">                                        
                                    </span>
                                </a>
                                <ul class="treeview-menu">                                   

                                    <li><a href="sale"><i class="fa fa-users"></i><?php echo lang('sales'); ?> <?php echo lang('list'); ?></a></li>
                                    <li><a href="sale/addSaleView"><i class="fa fa-plus-circle"></i><span><?php echo lang('add'); ?> <?php echo lang('sales'); ?></span></a></li>  
                                </ul>
                            </li>
                        <?php } ?>


                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <li class="treeview">
                                <a href="">
                                    <i class="fa fa-money"></i>
                                    <span><?php echo lang('expenses'); ?></span>
                                    <span class="pull-right-container">                                        
                                    </span>
                                </a>
                                <ul class="treeview-menu">                                   

                                    <li><a href="expense"><i class="fa fa-money"></i><?php echo lang('expenses'); ?> <?php echo lang('list'); ?></a></li>
                                    <li><a href="expense/addExpenseView"><i class="fa fa-plus-circle"></i><span><?php echo lang('add'); ?> <?php echo lang('expenses'); ?></span></a></li>
                                    <li><a href="expense/addExpensePayment"><i class="fa fa-plus-circle"></i><span><?php echo lang('pay'); ?></span></a></li> 
                                    <li><a href="expense/expenseCategory"><i class="fa fa-plus-circle"></i><span><?php echo lang('category'); ?></span></a></li> 
                                    <li><a href="expense/expenseSubCategory"><i class="fa fa-plus-circle"></i><span><?php echo lang('sub'); ?> <?php echo lang('category'); ?></span></a></li>  
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <li class="treeview">
                                <a href="">
                                    <i class="fa fa-hospital-o"></i>
                                    <span><?php echo lang('report'); ?></span>
                                    <span class="pull-right-container">                                        
                                    </span>
                                </a>
                                <ul class="treeview-menu">                                   

                                    <li><a href="purchase/supplierHistory"><i class="fa fa-list"></i><?php echo lang('supplier'); ?> <?php echo lang('reoprt'); ?></a></li> 
                                    <li><a href="sale/clientHistory"><i class="fa fa-list"></i><span><?php echo lang('client'); ?> <?php echo lang('reoprt'); ?></span></a></li>
                                    <li><a href="home/todayHistory"><i class="fa fa-list"></i><span><?php echo lang('today'); ?> <?php echo lang('reoprt'); ?></span></a></li>
                                    <li><a href="finance/financialReport"><i class="fa fa-list"></i><span><?php echo lang('financial'); ?> <?php echo lang('reoprt'); ?></span></a></li>

                                </ul>
                            </li>
                        <?php } ?>
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <li class="treeview">
                                <a href="">
                                    <i class="fa fa-users"></i>
                                    <span><?php echo lang('supplier'); ?></span>
                                    <span class="pull-right-container">                                        
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="supplier"><i class="fa fa-users"></i><?php echo lang('supplier'); ?> <?php echo lang('list'); ?></a></li> 
                                    <li><a href="supplier/addNewView"><i class="fa fa-plus-circle"></i><span><?php echo lang('add'); ?> <?php echo lang('supplier'); ?></span></a></li>                                    

                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <li class="treeview">
                                <a href="">
                                    <i class="fa fa-user"></i>
                                    <span><?php echo lang('client'); ?></span>
                                    <span class="pull-right-container">                                        
                                    </span>
                                </a>
                                <ul class="treeview-menu">                                   

                                    <li><a href="client"><i class="fa fa-users"></i><?php echo lang('client'); ?> <?php echo lang('list'); ?></a></li>
                                    <li><a href="client/addNewView"><i class="fa fa-plus-circle"></i><span><?php echo lang('add'); ?> <?php echo lang('client'); ?></span></a></li>  
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <li class="treeview">
                                <a href="">
                                    <i class="fa fa-smile-o"></i>
                                    <span><?php echo lang('staff'); ?></span>
                                    <span class="pull-right-container">                                        
                                    </span>
                                </a>
                                <ul class="treeview-menu">                                   

                                    <li><a href="staff"><i class="fa fa-list"></i><?php echo lang('staff'); ?> <?php echo lang('list'); ?></a></li> 
                                    <li><a href="staff/addNewView"><i class="fa fa-plus-circle"></i><span><?php echo lang('add'); ?> <?php echo lang('staff'); ?></span></a></li>  
                                </ul>
                            </li>
                        <?php } ?>





                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <li class="treeview">
                                <a href="">
                                    <i class="fa fa-gears"></i>
                                    <span><?php echo lang('settings'); ?></span>
                                    <span class="pull-right-container">                                        
                                    </span>
                                </a>
                                <ul class="treeview-menu">                                   
                                    <li><a href="settings"><i class="fa fa-gear "></i><span><?php echo lang('settings'); ?></span></a></li>                                    
                                    <li><a href="settings/language"><i class="fa fa-wrench"></i><?php echo lang('language'); ?> <?php echo lang('settings'); ?></a></li>
                                    <li><a href="settings/backups"><i class="fa fa-cloud-download"></i><?php echo lang('backups'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <li>
                            <a href="profile" >
                                <i class="fa fa-user"></i>
                                <span> <?php echo lang('profile'); ?> </span>
                            </a>
                        </li>

                    </ul>
                    <!-- sidebar menu end-->
                </div>
            </aside>
            <!--sidebar end-->




