<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Google_workspace extends Module
{
    public function __construct()
    {
        $this->module_name    = 'google_workspace';
        $this->module_version = '1.0.0';
        $this->app_version    = '1.0.0';

        parent::__construct();

        hooks()->add_action('admin_init', [$this, 'add_sidebar_menu']);
        hooks()->add_action('admin_init', [$this, 'load_language']);
        hooks()->add_action('app_admin_head', [$this, 'add_assets']);
    }

    public function install()
    {
        $CI = get_instance();
        $CI->load->library('migration');
        $CI->migration->latest();

        $default = [
            'id'                        => 1,
            'api_key'                   => '',
            'service_account_credentials' => '',
            'google_email'              => '',
            'enabled_features'          => json_encode([
                'email'    => true,
                'calendar' => true,
                'meet'     => true,
                'drive'    => true,
                'docs'     => true,
            ]),
        ];
        $CI->db->insert(db_prefix() . 'google_workspace_settings', $default);
        return true;
    }

    public function uninstall()
    {
        $CI = get_instance();
        $CI->db->query('DROP TABLE IF EXISTS ' . db_prefix() . 'google_workspace_settings');
        $CI->db->query('DROP TABLE IF EXISTS ' . db_prefix() . 'google_workspace_mappings');
        return true;
    }

    public function add_sidebar_menu()
    {
        $CI = get_instance();
        if (!isset($CI->app_menu)) {
            return;
        }
        $CI->app_menu->add_sidebar_menu_item('google_workspace', [
            'slug'     => 'google_workspace',
            'name'     => _l('google_workspace'),
            'href'     => admin_url('google_workspace'),
            'icon'     => 'fa fa-google',
            'position' => 40,
        ]);

        $children = [
            'email'    => 'email',
            'calendar' => 'calendar',
            'meet'     => 'meet',
            'drive'    => 'drive',
            'docs'     => 'docs',
            'settings' => 'settings',
        ];

        foreach ($children as $slug => $uri) {
            $CI->app_menu->add_sidebar_children_item('google_workspace', [
                'slug'     => 'google_workspace_' . $slug,
                'name'     => _l('google_workspace_' . $slug),
                'href'     => admin_url('google_workspace/' . $uri),
                'position' => 5,
            ]);
        }
    }

    public function load_language()
    {
        $CI = get_instance();
        $CI->lang->load('google_workspace/google_workspace', $CI->config->item('language'));
    }

    public function add_assets()
    {
        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" />';
        echo '<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />';
        echo '<link rel="stylesheet" type="text/css" href="' . module_dir_url('google_workspace', 'assets/css/google_workspace.css') . '" />';
        echo '<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>';
        echo '<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>';
        echo '<script src="' . module_dir_url('google_workspace', 'assets/js/google_workspace.js') . '"></script>';
    }
}
