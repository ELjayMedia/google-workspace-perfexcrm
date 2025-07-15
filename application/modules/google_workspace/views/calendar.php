<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<h1><?php echo _l('google_workspace_calendar'); ?></h1>
<?php if (!empty($events)) { ?>
<ul class="google-workspace-list">
    <?php foreach ($events as $event) { ?>
    <li>
        <strong><?php echo htmlspecialchars($event['summary']); ?></strong>
        <div><?php echo htmlspecialchars($event['start']); ?> - <?php echo htmlspecialchars($event['end']); ?></div>
    </li>
    <?php } ?>
</ul>
<?php } else { ?>
<p><?php echo _l('no_data_found'); ?></p>
<?php } ?>
