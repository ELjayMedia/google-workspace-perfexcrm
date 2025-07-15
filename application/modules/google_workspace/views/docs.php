<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mbot15"><?php echo _l('google_workspace_docs'); ?></h4>
                <?php if (!empty($docs)) { ?>
                    <ul class="google-workspace-list">
                        <?php foreach ($docs as $doc) { ?>
                        <li>
                            <a href="<?php echo html_escape($doc['webViewLink']); ?>" target="_blank">
                                <?php echo html_escape($doc['name']); ?>
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
