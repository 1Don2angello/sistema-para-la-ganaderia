<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
               <i class="fa fa-wrench"></i> <?php  echo lang('language_settings'); ?>
            </header>
            <div class="panel-body col-md-6">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo validation_errors(); ?>
                                    <form role="form" action="settings/language" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php  echo lang('language'); ?></label>
                                           
                                            <select name="language" class="form-control js-example-basic-single" style="width: 100%;">                                  
                                                <option value="english" <?php
                                                if (!empty($settings->language)) {
                                                    if ($settings->language == 'english') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>><?php  echo lang('english'); ?></option>
                                                
                                                <option value="arabic" <?php
                                                if (!empty($settings->language)) {
                                                    if ($settings->language == 'arabic') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>><?php  echo lang('arabic'); ?></option>
                                                
                                                <option value="portuguese" <?php
                                                if (!empty($settings->language)) {
                                                    if ($settings->language == 'portuguese') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>><?php  echo lang('portuguese'); ?></option>
                                                
                                                <option value="spanish" <?php
                                                if (!empty($settings->language)) {
                                                    if ($settings->language == 'spanish') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>><?php  echo lang('spanish'); ?></option>
                                                
                                                <option value="french" <?php
                                                if (!empty($settings->language)) {
                                                    if ($settings->language == 'french') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>><?php  echo lang('french'); ?></option>
                                            </select>
                                        </div>

                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($settings->id)) {
                                            echo $settings->id;
                                        }
                                        ?>'>
                                        <button type="submit" name="submit" class="btn btn-info submit_button"><?php  echo lang('submit'); ?></button>
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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
