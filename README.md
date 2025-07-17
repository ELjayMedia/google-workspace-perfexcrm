# Google Workspace PerfexCRM Module

This repository relies on Composer for dependency management. After cloning the project, run:

```bash
composer install
```

Running this command downloads the required packages and creates the `vendor/` directory used by the application.

## Usage

1. Copy the `application/modules/google_workspace` directory into the `modules` folder of your Perfex CRM installation.
2. From the Perfex CRM admin area, go to **Setup &rarr; Modules** and activate the **Google Workspace** module. The installation process creates the required database tables.
3. After activation navigate to **Google Workspace &rarr; Settings** to configure the integration.

## Configuration

The settings page allows you to provide the details required for Google API access:

- **API Key** – optional key for certain Google services.
- **Service Account Credentials** – paste the JSON contents of your service account key here. Generate the key from Google Cloud and enable the required Workspace APIs for the project.
- **Admin Google Email** – the Workspace account that will be impersonated when making API calls.
- **Enabled Features** – check or uncheck individual features (Email, Calendar, Meet, Drive and Docs) to enable or disable them in the module.

Changes are saved by clicking **Save** on the settings page.
