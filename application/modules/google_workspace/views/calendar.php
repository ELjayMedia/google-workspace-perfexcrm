<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mbot15"><?php echo _l('google_workspace_calendar'); ?></h4>
                <div id="google-workspace-calendar"></div>
                <?php if (empty($events)) { ?>
                    <p><?php echo _l('no_data_found'); ?></p>
                <?php } ?>
                <script>
                    var calendar_events = <?php echo json_encode($events); ?>;
                </script>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
