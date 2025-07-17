<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Google_workspace extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('google_workspace/google_workspace_model');
    }

    private function feature_enabled($feature)
    {
        $settings = $this->google_workspace_model->get_settings();
        $features = json_decode($settings['enabled_features'] ?? '{}', true);
        return !empty($features[$feature]);
    }

    private function feature_disabled_redirect()
    {
        set_alert('warning', _l('google_workspace_feature_disabled'));
        redirect(admin_url('google_workspace'));
    }

    public function index()
    {
        if (!has_permission('google_workspace', '', 'view')) {
            access_denied('google_workspace');
        }
        $data['title'] = _l('google_workspace');
        $this->load->view('google_workspace/dashboard', $data);
    }

    public function email()
    {
        if (!has_permission('google_workspace', '', 'view')) {
            access_denied('google_workspace');
        }
        if (!$this->feature_enabled('email')) {
            $this->feature_disabled_redirect();
        }
        $data['title']  = _l('google_workspace_email');
        $data['emails'] = $this->google_workspace_model->get_emails(get_staff_user_id());
        $this->load->view('google_workspace/email', $data);
    }

    public function calendar()
    {
        if (!has_permission('google_workspace', '', 'view')) {
            access_denied('google_workspace');
        }
        if (!$this->feature_enabled('calendar')) {
            $this->feature_disabled_redirect();
        }
        $data['title']  = _l('google_workspace_calendar');
        $data['events'] = $this->google_workspace_model->get_calendar_events(get_staff_user_id());
        $this->load->view('google_workspace/calendar', $data);
    }

    public function meet()
    {
        if (!has_permission('google_workspace', '', 'view')) {
            access_denied('google_workspace');
        }
        if (!$this->feature_enabled('meet')) {
            $this->feature_disabled_redirect();
        }
        $data['title']    = _l('google_workspace_meet');
        $data['meetings'] = $this->google_workspace_model->get_meetings(get_staff_user_id());
        $this->load->view('google_workspace/meet', $data);
    }

    public function drive()
    {
        if (!has_permission('google_workspace', '', 'view')) {
            access_denied('google_workspace');
        }
        if (!$this->feature_enabled('drive')) {
            $this->feature_disabled_redirect();
        }
        $data['title'] = _l('google_workspace_drive');
        $data['files'] = $this->google_workspace_model->get_drive_files(get_staff_user_id());
        $this->load->view('google_workspace/drive', $data);
    }

    public function docs()
    {
        if (!has_permission('google_workspace', '', 'view')) {
            access_denied('google_workspace');
        }
        if (!$this->feature_enabled('docs')) {
            $this->feature_disabled_redirect();
        }
        $data['title'] = _l('google_workspace_docs');
        $data['docs']  = $this->google_workspace_model->get_docs(get_staff_user_id());
        $this->load->view('google_workspace/docs', $data);
    }

    public function settings()
    {
        if (!has_permission('google_workspace', '', 'edit')) {
            access_denied('google_workspace');
        }
        $data['title'] = _l('google_workspace_settings');
        if ($this->input->post()) {
            $this->google_workspace_model->update_settings($this->input->post());
            set_alert('success', _l('updated_successfully'));
            redirect(admin_url('google_workspace/settings'));
        }
        $data['settings'] = $this->google_workspace_model->get_settings();
        $this->load->view('google_workspace/settings', $data);
    }
}
