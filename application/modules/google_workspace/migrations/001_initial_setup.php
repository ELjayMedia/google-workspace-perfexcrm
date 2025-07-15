<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Initial_setup extends CI_Migration
{
    public function up()
    {
        if (!$this->db->table_exists(db_prefix() . 'google_workspace_settings')) {
            $this->dbforge->add_field([
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                    'auto_increment' => true,
                ],
                'api_key' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],
                'service_account_credentials' => [
                    'type' => 'LONGTEXT',
                    'null' => true,
                ],
                'google_email' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null' => true,
                ],
                'enabled_features' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],
            ]);
            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table(db_prefix() . 'google_workspace_settings');
        }

        if (!$this->db->table_exists(db_prefix() . 'google_workspace_mappings')) {
            $this->dbforge->add_field([
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                    'auto_increment' => true,
                ],
                'staff_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                ],
                'google_email' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null' => true,
                ],
                'google_label' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null' => true,
                ],
            ]);
            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table(db_prefix() . 'google_workspace_mappings');
        }
    }

    public function down()
    {
        $this->dbforge->drop_table(db_prefix() . 'google_workspace_settings', true);
        $this->dbforge->drop_table(db_prefix() . 'google_workspace_mappings', true);
    }
}
