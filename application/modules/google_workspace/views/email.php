<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<h1><?php echo _l('google_workspace_email'); ?></h1>
<?php if (!empty($emails)) { ?>
<ul class="google-workspace-list">
    <?php foreach ($emails as $email) { ?>
    <li>
        <strong><?php echo htmlspecialchars($email['subject']); ?></strong>
        <div><?php echo htmlspecialchars($email['snippet']); ?></div>
    </li>
    <?php } ?>
</ul>
<?php } else { ?>
<p><?php echo _l('no_data_found'); ?></p>
<?php } ?>
