<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<h1><?php echo _l('google_workspace_meet'); ?></h1>
<?php if (!empty($meetings)) { ?>
<ul class="google-workspace-list">
    <?php foreach ($meetings as $meeting) { ?>
    <li><?php echo htmlspecialchars($meeting['summary'] ?? ''); ?></li>
    <?php } ?>
</ul>
<?php } else { ?>
<p><?php echo _l('no_data_found'); ?></p>
<?php } ?>
