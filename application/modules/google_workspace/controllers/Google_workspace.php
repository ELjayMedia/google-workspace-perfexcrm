<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Google_workspace extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('google_workspace/google_workspace_model');
    }

    public function index()
    {
        $data['title'] = _l('google_workspace');
        $this->load->view('google_workspace/dashboard', $data);
    }

    public function email()
    {
        $data['title']  = _l('google_workspace_email');
        $data['emails'] = $this->google_workspace_model->get_emails(get_staff_user_id());
        $this->load->view('google_workspace/email', $data);
    }

    public function calendar()
    {
        $data['title']  = _l('google_workspace_calendar');
        $data['events'] = $this->google_workspace_model->get_calendar_events(get_staff_user_id());
        $this->load->view('google_workspace/calendar', $data);
    }

    public function meet()
    {
        $data['title']    = _l('google_workspace_meet');
        $data['meetings'] = $this->google_workspace_model->get_meetings(get_staff_user_id());
        $this->load->view('google_workspace/meet', $data);
    }

    public function drive()
    {
        $data['title'] = _l('google_workspace_drive');
        $data['files'] = $this->google_workspace_model->get_drive_files(get_staff_user_id());
        $this->load->view('google_workspace/drive', $data);
    }

    public function docs()
    {
        $data['title'] = _l('google_workspace_docs');
        $data['docs']  = $this->google_workspace_model->get_docs(get_staff_user_id());
        $this->load->view('google_workspace/docs', $data);
    }

    public function settings()
    {
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
