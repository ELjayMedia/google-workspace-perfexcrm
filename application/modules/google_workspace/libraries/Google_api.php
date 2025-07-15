<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Google_api
{
    private $client;
    private $services = [];

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->initialize_client();
    }

    private function initialize_client()
    {
        require_once APPPATH . 'vendor/autoload.php';

        $settings = $this->CI->google_workspace_model->get_settings();
        $credentials = json_decode($settings['service_account_credentials'], true);

        $this->client = new Google_Client();
        $this->client->setAuthConfig($credentials);
        $this->client->setScopes([
            Google_Service_Gmail::GMAIL_MODIFY,
            Google_Service_Calendar::CALENDAR,
            Google_Service_Drive::DRIVE,
            Google_Service_Docs::DOCUMENTS
            // Google Meet does not have a dedicated API scope.
            // Calendar scope provides access to create conference links.
        ]);
        $this->client->setSubject($settings['google_email']); // Impersonate admin email
    }

    public function get_gmail_service()
    {
        if (!isset($this->services['gmail'])) {
            $this->services['gmail'] = new Google_Service_Gmail($this->client);
        }
        return $this->services['gmail'];
    }

    public function get_calendar_service()
    {
        if (!isset($this->services['calendar'])) {
            $this->services['calendar'] = new Google_Service_Calendar($this->client);
        }
        return $this->services['calendar'];
    }

    public function get_drive_service()
    {
        if (!isset($this->services['drive'])) {
            $this->services['drive'] = new Google_Service_Drive($this->client);
        }
        return $this->services['drive'];
    }

    public function get_docs_service()
    {
        if (!isset($this->services['docs'])) {
            $this->services['docs'] = new Google_Service_Docs($this->client);
        }
        return $this->services['docs'];
    }

    // Meet functionality is handled via the Calendar service
    // by generating conference links when creating events.
}
?>