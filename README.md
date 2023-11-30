# Edwiser Bridge 3.x Extender Plugin for Moodle

## Moodle Auto-Login Integration Plugin

### Overview:

The Moodle Auto-Login Integration Plugin is designed to automate the user login process in Moodle after the creation of a user account in WordPress. This integration enhances the user experience by seamlessly connecting WordPress and Moodle platforms. You need to have Edwiser Bridge installed.

### Key Features:

- **Automated User Login:**
  - Automatically logs in users to Moodle upon the creation of a WordPress account.

- **Secure Authentication:**
  - Utilizes secure authentication methods through the Moodle API for a seamless and safe login experience.

- **Efficient Integration:**
  - Integrates with Moodle's web services, allowing for quick and efficient communication between WordPress and Moodle.

### Configuration:

To enable this plugin, ensure the following configurations:

1. **Moodle Base URL:**
   - Set the base URL of your Moodle instance in the `$moodle_base_url` variable in lib.php before installing plugin.

2. **Moodle API Token:**
   - Provide the Moodle API token in the `$moodle_api_token` variable in lib.php before installing plugin.

3. **WordPress Integration:**
   - Integrate [this Wordpress plugin](https://github.com/Buda9/edwiser-bridge-link-trigger-wordpress). into your WordPress function.php file, ensuring the Moodle details are correctly entered in a function.php file.

### Usage:

Once configured, the Moodle Auto-Login Integration Plugin works silently in the background. After a user account is created in WordPress, it seamlessly logs in the user to their corresponding Moodle account, enhancing the overall user experience.
