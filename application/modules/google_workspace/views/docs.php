<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<h1><?php echo _l('google_workspace_docs'); ?></h1>
<?php if (!empty($docs)) { ?>
<ul class="google-workspace-list">
    <?php foreach ($docs as $doc) { ?>
    <li>
        <a href="<?php echo htmlspecialchars($doc['webViewLink']); ?>" target="_blank">
            <?php echo htmlspecialchars($doc['name']); ?>
        </a>
    </li>
    <?php } ?>
</ul>
<?php } else { ?>
<p><?php echo _l('no_data_found'); ?></p>
<?php } ?>
