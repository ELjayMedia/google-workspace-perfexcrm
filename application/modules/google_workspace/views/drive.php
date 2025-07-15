<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<h1><?php echo _l('google_workspace_drive'); ?></h1>
<?php if (!empty($files)) { ?>
<ul class="google-workspace-list">
    <?php foreach ($files as $file) { ?>
    <li>
        <a href="<?php echo htmlspecialchars($file['webViewLink']); ?>" target="_blank">
            <?php echo htmlspecialchars($file['name']); ?>
        </a>
    </li>
    <?php } ?>
</ul>
<?php } else { ?>
<p><?php echo _l('no_data_found'); ?></p>
<?php } ?>
