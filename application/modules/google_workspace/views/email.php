<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mbot15"><?php echo _l('google_workspace_email'); ?></h4>
                <?php if (!empty($emails)) { ?>
                    <table class="table table-google" id="google-workspace-email-table">
                        <thead>
                            <tr>
                                <th><?php echo _l('email_from'); ?></th>
                                <th><?php echo _l('email_subject'); ?></th>
                                <th><?php echo _l('email_date'); ?></th>
                                <th><?php echo _l('email_snippet'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($emails as $email) { ?>
                            <tr>
                                <td><?php echo html_escape($email['from']); ?></td>
                                <td><?php echo html_escape($email['subject']); ?></td>
                                <td><?php echo html_escape($email['date']); ?></td>
                                <td><?php echo html_escape($email['snippet']); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <p><?php echo _l('no_data_found'); ?></p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
