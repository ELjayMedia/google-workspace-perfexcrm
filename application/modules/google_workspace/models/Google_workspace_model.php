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
        // Basic validation
        if (!is_array($data)
            || !isset($data['api_key'])
            || !isset($data['service_account_credentials'])
            || !isset($data['enabled_features'])
            || !is_array($data['enabled_features'])) {
            return false;
        }

        $record = [
            'api_key' => $data['api_key'],
            'service_account_credentials' => $data['service_account_credentials'],
            'enabled_features' => json_encode($data['enabled_features']),
        ];

        try {
            // Check if the settings row exists
            $this->db->where('id', 1);
            $exists = $this->db->get(db_prefix() . 'google_workspace_settings')->row();

            if ($exists) {
                $this->db->where('id', 1);
                $this->db->update(db_prefix() . 'google_workspace_settings', $record);
            } else {
                $record['id'] = 1;
                $this->db->insert(db_prefix() . 'google_workspace_settings', $record);
            }

            return $this->db->affected_rows() >= 0;
        } catch (Exception $e) {
            log_message('error', 'Failed to update Google Workspace settings: ' . $e->getMessage());
            return false;
        }
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
        $pageToken = null;
        $result = [];
        $optParams = [
            'q' => "trashed=false",
            'fields' => 'nextPageToken, files(id,name,mimeType,webViewLink)',
        ];

        try {
            do {
                if ($pageToken) {
                    $optParams['pageToken'] = $pageToken;
                }
                $files = $drive->files->listFiles($optParams);
                foreach ($files->getFiles() as $file) {
                    $result[] = [
                        'id' => $file->getId(),
                        'name' => $file->getName(),
                        'mimeType' => $file->getMimeType(),
                        'webViewLink' => $file->getWebViewLink(),
                    ];
                }
                $pageToken = $files->getNextPageToken();
            } while ($pageToken);
        } catch (Google_Service_Exception $e) {
            log_message('error', 'Google Drive query failed: ' . $e->getMessage());
        }

        return $result;
    }

    public function get_docs($staff_id)
    {
        $this->load->library('google_api');
        $drive = $this->google_api->get_drive_service();
        $pageToken = null;
        $result = [];
        $optParams = [
            'q' => "mimeType='application/vnd.google-apps.document' or mimeType='application/vnd.google-apps.spreadsheet'",
            'fields' => 'nextPageToken, files(id,name,webViewLink)',
        ];

        try {
            do {
                if ($pageToken) {
                    $optParams['pageToken'] = $pageToken;
                }
                $files = $drive->files->listFiles($optParams);
                foreach ($files->getFiles() as $file) {
                    $result[] = [
                        'id' => $file->getId(),
                        'name' => $file->getName(),
                        'webViewLink' => $file->getWebViewLink(),
                    ];
                }
                $pageToken = $files->getNextPageToken();
            } while ($pageToken);
        } catch (Google_Service_Exception $e) {
            log_message('error', 'Google Drive query failed: ' . $e->getMessage());
        }

        return $result;
    }

    public function get_meetings($staff_id)
    {
        // Google currently exposes Meet features through the Calendar API.
        // Use events with conference data to manage meeting links.
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