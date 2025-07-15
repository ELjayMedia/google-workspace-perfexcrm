<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="google-workspace-dashboard">
                    <h4 class="mbot15"><?php echo _l('google_workspace'); ?></h4>
                    <ul class="google-workspace-list">
                        <li><a href="<?php echo admin_url('google_workspace/email'); ?>"><?php echo _l('google_workspace_email'); ?></a></li>
                        <li><a href="<?php echo admin_url('google_workspace/calendar'); ?>"><?php echo _l('google_workspace_calendar'); ?></a></li>
                        <li><a href="<?php echo admin_url('google_workspace/meet'); ?>"><?php echo _l('google_workspace_meet'); ?></a></li>
                        <li><a href="<?php echo admin_url('google_workspace/drive'); ?>"><?php echo _l('google_workspace_drive'); ?></a></li>
                        <li><a href="<?php echo admin_url('google_workspace/docs'); ?>"><?php echo _l('google_workspace_docs'); ?></a></li>
                        <li><a href="<?php echo admin_url('google_workspace/settings'); ?>"><?php echo _l('google_workspace_settings'); ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
