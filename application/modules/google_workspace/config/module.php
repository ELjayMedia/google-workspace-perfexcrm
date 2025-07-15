<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config['module_name']    = 'google_workspace';
$config['module_version'] = '1.0.0';

$config['google_workspace_default_features'] = [
    'email'    => true,
    'calendar' => true,
    'meet'     => true,
    'drive'    => true,
    'docs'     => true,
];
