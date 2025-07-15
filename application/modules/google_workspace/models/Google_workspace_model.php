<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Google_workspace_model extends App_Model
{
    public function get_settings()
    {
        return $this->db->get(db_prefix() . 'google_workspace_settings')->row_array();
    }

    public function update_settings($data)
    {
        $this->db->where('id', 1);
        $this->db->update(db_prefix() . 'google_workspace_settings', [
            'api_key' => $data['api_key'],
            'service_account_credentials' => $data['service_account_credentials'],
            'enabled_features' => json_encode($data['enabled_features']),
        ]);
    }

    public function get_emails($staff_id)
    {
        $this->load->library('google_api');
        $gmail = $this->google_api->get_gmail_service();
        $mapping = $this->get_user_mapping($staff_id);
        $label = $mapping['google_label'] ?? null;

        $query = $label ? "label:$label" : '';
        $messages = $gmail->users_messages->listUsersMessages('me', ['q' => $query]);
        $result = [];

        foreach ($messages->getMessages() as $message) {
            $msg = $gmail->users_messages->get('me', $message->getId());
            $result[] = [
                'id' => $msg->getId(),
                'snippet' => $msg->getSnippet(),
                'subject' => $this->get_header($msg, 'Subject'),
                'from' => $this->get_header($msg, 'From'),
                'date' => $this->get_header($msg, 'Date'),
            ];
        }
        return $result;
    }

    public function get_calendar_events($staff_id)
    {
        $this->load->library('google_api');
        $calendar = $this->google_api->get_calendar_service();
        $events = $calendar->events->listEvents('primary', [
            'timeMin' => date('c'),
            'maxResults' => 50,
        ]);
        $result = [];

        foreach ($events->getItems() as $event) {
            $result[] = [
                'id' => $event->getId(),
                'summary' => $event->getSummary(),
                'start' => $event->getStart()->getDateTime(),
                'end' => $event->getEnd()->getDateTime(),
            ];
        }
        return $result;
    }

    public function get_drive_files($staff_id)
    {
        $this->load->library('google_api');
        $drive = $this->google_api->get_drive_service();
        $files = $drive->files->listFiles([
            'q' => "trashed=false",
            'fields' => 'files(id,name,mimeType,webViewLink)',
        ]);
        $result = [];

        foreach ($files->getFiles() as $file) {
            $result[] = [
                'id' => $file->getId(),
                'name' => $file->getName(),
                'mimeType' => $file->getMimeType(),
                'webViewLink' => $file->getWebViewLink(),
            ];
        }
        return $result;
    }

    public function get_docs($staff_id)
    {
        $this->load->library('google_api');
        $docs = $this->google_api->get_docs_service();
        $files = $this->google_api->get_drive_service()->files->listFiles([
            'q' => "mimeType='application/vnd.google-apps.document' or mimeType='application/vnd.google-apps.spreadsheet'",
            'fields' => 'files(id,name,webViewLink)',
        ]);
        $result = [];

        foreach ($files->getFiles() as $file) {
            $result[] = [
                'id' => $file->getId(),
                'name' => $file->getName(),
                'webViewLink' => $file->getWebViewLink(),
            ];
        }
        return $result;
    }

    public function get_meetings($staff_id)
    {
        // Placeholder for Google Meet API (not fully public, may require Calendar API for meeting links)
        return [];
    }

    public function get_user_mapping($staff_id)
    {
        $this->db->where('staff_id', $staff_id);
        return $this->db->get(db_prefix() . 'google_workspace_mappings')->row_array();
    }

    private function get_header($message, $header_name)
    {
        foreach ($message->getPayload()->getHeaders() as $header) {
            if ($header->getName() === $header_name) {
                return $header->getValue();
            }
        }
        return '';
    }
}
?>