<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>#19d0ae

<section id="main-content">
    <section class="wrapper site-min-height">
        <section class="">
            <div class="">
                <aside class="right-side">		
                    <section class="content">
                        <div class="">
                            <div class="panel panel-primary">

                                <header class="panel-heading">
                                    <i class="livicon" data-name="download" data-loop="true" data-color="#fff" data-hovercolor="#fff" data-size="18"></i>
                                    <i class="fa fa-cloud-download"></i> <?php  echo lang('backup_database'); ?>
                                </header>
                                <!---div class="row animated zoomIn"--->
                                <div class="panel-body">
                                    <div class="">
                                        <h4><i class="livicon" data-name="servers" data-loop="true" data-color="#000" data-hovercolor="#000" data-size="20"></i> <a href="<?= site_url('settings/backup_database'); ?>" id="backup_databse" class="btn btn-primary"><i class="livicon" data-name="servers" data-loop="true" data-color="#fff" data-hovercolor="#fff" data-size="20"></i> <?php  echo lang('backup_database'); ?></a></h4>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="content-panel">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <?php
                                                        if (!empty($dbs)) {
                                                            echo '<ul class="list-group">';
                                                            foreach ($dbs as $file) {
                                                                $file = basename($file);
                                                                echo '<li class="list-group-item">';
                                                                $date_string = substr($file, 13, 10);
                                                                $time_string = substr($file, 24, 8);
                                                                $date = $date_string . ' ' . str_replace('-', ':', $time_string);
                                                                $bkdate = $this->sma->hrld($date);
                                                                //echo $bkdate;
                                                                echo '<strong>' . lang('backup_on') . ' <span class="text-primary">' . $bkdate . '</span><div class="btn-group pull-right" style="margin-top:-7px;">' . anchor('settings/download_database/' . substr($file, 0, -4), '<i class="fa fa-cloud-download livicon" data-name="download" data-loop="true" data-color="#fff" data-hovercolor="#fff" data-size="18" ></i> ' . lang('download'), 'class="btn btn-primary"') . ' ' . anchor('settings/restore_database/' . substr($file, 0, -4), '<i class="livicon" data-name="recycled" data-loop="true" data-color="#fff" data-hovercolor="#fff" data-size="20"></i> ' . lang('restore'), 'class="btn btn-warning restore_db"') . ' ' . anchor('settings/delete_database/' . substr($file, 0, -4), '<i class="fa fa-times livicon" data-name="trash" data-loop="true" data-color="#fff" data-hovercolor="#fff" data-size="18"></i> ' . lang('delete'), 'class="btn btn-danger delete_file"') . ' </div></strong>';
                                                                echo '</li>';
                                                            }
                                                            echo '</ul>';
                                                        }
                                                        ?>
                                                    </div>
                                                    <i class="livicon" data-name="download" data-size="50" data-c="#fff" data-hc="#fff" data-loop="true" id="livicon-96" style="width: 50px; height: 50px;" ></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="content-panel"> 


                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <?php
                                                        if (!empty($files)) {
                                                            echo '<ul class="list-group">';
                                                            foreach ($files as $file) {
                                                                $file = basename($file);
                                                                echo '<li class="list-group-item">';
                                                                $date_string = substr($file, 12, 10);
                                                                $time_string = substr($file, 23, 8);
                                                                $date = $date_string . ' ' . str_replace('-', ':', $time_string);
                                                                $bkdate = $this->sma->hrld($date);
                                                                echo '<strong>' . lang('backup_on') . ' <span class="text-primary">' . $bkdate . '</span><div class="btn-group pull-right" style="margin-top:-7px;">' . anchor('settings/download_backup/' . substr($file, 0, -4), '<i class="livicon" data-name="download" data-loop="true" data-color="#fff" data-hovercolor="#fff" data-size="18" "fa fa-cloud-download"></i> ' ,'Download', 'class="btn btn-primary"') . ' ' . anchor('settings/restore_backup/' . substr($file, 0, -4), '<i class="livicon" data-name="recycled" data-loop="true" data-color="#fff" data-hovercolor="#fff" data-size="20"></i> ' . lang('restore'), 'class="btn btn-warning restore_backup"') . ' ' . anchor('settings/delete_backup/' . substr($file, 0, -4), '<i class="livicon" data-name="trash" data-loop="true" data-color="#fff" data-hovercolor="#fff" data-size="18"></i> ' . 'delete', 'class="btn btn-danger delete_file"') . ' </div></strong>';
                                                                echo '</li>';
                                                            }
                                                            echo '</ul>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </section>
                </aside>


            </div>
        </section>
        <!-- page end-->
    </section>
</section>

<style>


    .restore_db{
        display: none;
    }


    #backup_database{
        margin-bottom: 10px;
        float: left !important;
    }

</style>

<div class="modal fade" id="wModal" tabindex="-1" role="dialog" aria-labelledby="wModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="wModalLabel"><?= lang('please_wait'); ?></h4>
            </div>
            <div class="modal-body">
                <?= lang('backup_modal_msg'); ?>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $('#backup_files').click(function (e) {
            e.preventDefault();
            $('#wModalLabel').text('<?= lang('backup_modal_heading'); ?>');
            $('#wModal').modal({backdrop: 'static', keyboard: true}).appendTo('body').modal('show');
            window.location.href = '<?= site_url('settings/backup_files'); ?>';
        });
        $('.restore_backup').click(function (e) {
            e.preventDefault();
            var href = $(this).attr('href');
            var r = confirm("<?= lang('restore_confirm'); ?>");
            if (r == true) {
                $('#wModalLabel').text('<?= lang('restore_modal_heading'); ?>');
                $('#wModal').modal({backdrop: 'static', keyboard: true}).appendTo('body').modal('show');
                window.location.href = href;
            } else {
                return false;
            }
        });
        $('.restore_db').click(function (e) {
            e.preventDefault();
            var href = $(this).attr('href');
            var r = confirm("<?= lang('restore_confirm'); ?>");
            if (r == true) {
                window.location.href = href;
            } else {
                return false;
            }
        });
        $('.delete_file').click(function (e) {
            e.preventDefault();
            var href = $(this).attr('href');
            var r = confirm("<?= lang('delete_confirm'); ?>");
            if (r == true) {
                window.location.href = href;
            } else {
                return false;
            }
        });
    });
</script>