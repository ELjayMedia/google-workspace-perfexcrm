<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="google-workspace-dashboard">
    <h1><?php echo _l('google_workspace'); ?></h1>
    <ul class="google-workspace-list">
        <li><a href="<?php echo admin_url('google_workspace/email'); ?>"><?php echo _l('google_workspace_email'); ?></a></li>
        <li><a href="<?php echo admin_url('google_workspace/calendar'); ?>"><?php echo _l('google_workspace_calendar'); ?></a></li>
        <li><a href="<?php echo admin_url('google_workspace/meet'); ?>"><?php echo _l('google_workspace_meet'); ?></a></li>
        <li><a href="<?php echo admin_url('google_workspace/drive'); ?>"><?php echo _l('google_workspace_drive'); ?></a></li>
        <li><a href="<?php echo admin_url('google_workspace/docs'); ?>"><?php echo _l('google_workspace_docs'); ?></a></li>
        <li><a href="<?php echo admin_url('google_workspace/settings'); ?>"><?php echo _l('google_workspace_settings'); ?></a></li>
    </ul>
</div>
