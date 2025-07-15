<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mbot15"><?php echo _l('google_workspace_drive'); ?></h4>
                <?php if (!empty($files)) { ?>
                    <ul class="google-workspace-list">
                        <?php foreach ($files as $file) { ?>
                        <li>
                            <a href="<?php echo html_escape($file['webViewLink']); ?>" target="_blank">
                                <?php echo html_escape($file['name']); ?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                <?php } else { ?>
                    <p><?php echo _l('no_data_found'); ?></p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
