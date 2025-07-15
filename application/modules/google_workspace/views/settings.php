<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mbot15"><?php echo _l('google_workspace_settings'); ?></h4>
                <form method="post">
                    <div class="form-group">
                        <label for="api_key">API Key</label>
                        <input type="text" class="form-control" name="api_key" value="<?php echo html_escape($settings['api_key'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="service_account_credentials">Service Account Credentials (JSON)</label>
                        <textarea class="form-control" name="service_account_credentials" rows="5"><?php echo html_escape($settings['service_account_credentials'] ?? ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="google_email">Admin Google Email</label>
                        <input type="text" class="form-control" name="google_email" value="<?php echo html_escape($settings['google_email'] ?? ''); ?>">
                    </div>
                    <?php $features = json_decode($settings['enabled_features'] ?? '{}', true); ?>
                    <div class="form-group">
                        <label>Enabled Features</label><br>
                        <?php foreach(['email','calendar','meet','drive','docs'] as $feat){ ?>
                        <label><input type="checkbox" name="enabled_features[<?php echo $feat; ?>]" value="1" <?php echo !empty($features[$feat]) ? 'checked' : ''; ?>> <?php echo _l('google_workspace_'.$feat); ?></label><br>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
