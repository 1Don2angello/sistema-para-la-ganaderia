<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-money"></i> <?php echo lang('products'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green btn_hover">
                                    <i class="fa fa-plus-circle"></i>    <?php echo lang('add_new_product'); ?> 
                                </button>
                            </div>
                        </a>
                        <button class="export" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('product_id'); ?></th>
                                <th><?php echo lang('product_code'); ?></th>                        
                                <th><?php echo lang('product_name'); ?></th>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('category'); ?></th>
                                <th><?php echo lang('cost'); ?></th>
                                <th><?php echo lang('product_price'); ?></th>                                
                                <th><?php echo lang('quantity'); ?></th>
                                <th><?php echo lang('type'); ?></th>
                                <th><?php echo lang('note'); ?></th>
                                <th><?php echo lang('options'); ?></th>
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
                        <?php foreach ($products as $product) { ?>
                            <tr class="">
                                <td> <?php echo $product->product_id; ?></td>
                                <td> <?php echo $product->code; ?></td>                               
                                <td> <?php echo $product->name; ?></td>
                                <td><?php echo $product->add_date; ?></td>
                                <td> <?php echo $product->category; ?></td>
                                <td> <?php echo $product->cost; ?></td>
                                <td> <?php echo $product->price; ?></td>                              
                                <td><?php echo $product->quantity; ?></td>
                                <td><?php echo $product->type; ?></td>
                                <td><?php echo $product->note; ?></td>

                                <td>
                                    <button type="button" class="btn btn-xs editbutton" data-toggle="modal" data-id="<?php echo $product->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>                                 
                                    <a class="" href="product/delete?id=<?php echo $product->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><button type="button" class="btn btn-xs"><i class="fa fa-times"></i> <?php echo lang('delete'); ?></button></i></a>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><strong><i class="fa fa-plus-circle"></i> <?php echo lang('add_new_product'); ?></strong></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="product/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('product_code'); ?></label>
                        <input type="text" class="form-control" name="code" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('product_name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('category'); ?></label>
                        <select name="category" class="form-control js-example-basic-single" id="exampleInputEmail1" placeholder="" style="width: 100%;" required>
                            <?php foreach ($categorys as $category) { ?>
                                <option  value="<?php echo $category->category; ?>"> <?php echo $category->category; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('cost'); ?></label>
                        <input type="text" class="form-control" name="cost" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('product_price'); ?></label>
                        <input type="text" class="form-control" name="price" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('quantity'); ?></label>
                        <input type="text" class="form-control" name="quantity" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('type'); ?></label>
                        <input type="text" class="form-control" name="type" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('note'); ?></label>
                        <input type="text" class="form-control" name="note" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value=''>

                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Car -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><strong><i class="fa fa-edit"></i> <?php echo lang('edit_product'); ?></strong></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="productEditForm" action="product/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('product_code'); ?></label>
                        <input type="text" class="form-control" name="code" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('product_name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('category'); ?></label>
                        <select name="category" class="form-control js-example-basic-single " id="exampleInputEmail1" style="width: 100%;">
                            <?php foreach ($categorys as $category) { ?>
                                <option  value="<?php echo $category->category; ?>" <?php
                                if ($category->category == $category->category) {
                                    echo 'selected';
                                }
                                ?>> <?php echo $category->category; ?></option>  
                                     <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('cost'); ?></label>
                        <input type="text" class="form-control" name="cost" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('product_price'); ?></label>
                        <input type="text" class="form-control" name="price" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('quantity'); ?></label>
                        <input type="text" class="form-control" name="quantity" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('type'); ?></label>
                        <input type="text" class="form-control" name="type" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('note'); ?></label>
                        <input type="text" class="form-control" name="note" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value=''>

                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Payment To That Car -->

<!-- Javascript For Edit Trip -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">


                                    $(document).ready(function () {
                                        $(".editbutton").click(function (e) {
                                            e.preventDefault(e);
                                            // Get the record's ID via attribute  
                                            var iid = $(this).attr('data-id');
                                            $.ajax({
                                                url: 'product/editProductByJason?id=' + iid,
                                                method: 'GET',
                                                data: '',
                                                dataType: 'json',
                                            }).success(function (response) {
                                                // Populate the form fields with the data returned from server
                                                $('#productEditForm').find('[name="id"]').val(response.product.id).end()
                                                $('#productEditForm').find('[name="code"]').val(response.product.code).end()
                                                $('#productEditForm').find('[name="name"]').val(response.product.name).end()
                                                $('#productEditForm').find('[name="price"]').val(response.product.price).end()
                                                $('#productEditForm').find('[name="note"]').val(response.product.note).end()
                                                $('#productEditForm').find('[name="cost"]').val(response.product.cost).end()
                                                $('#productEditForm').find('[name="type"]').val(response.product.type).end()
                                                $('#productEditForm').find('[name="quantity"]').val(response.product.quantity).end()
                                                $('#productEditForm').find('[name="category"]').val(response.product.category).end()
                                                $('#productEditForm').find('[name="p_id"]').val(response.product.product_id).end()
                                                $('#myModal2').modal('show');
                                            });

                                        });
                                    });

</script>


<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>


