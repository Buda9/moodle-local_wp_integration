<?php
defined('MOODLE_INTERNAL') || die();

/**
 * Automatic user login to Moodle after account creation.
 *
 * @param int $moodleUserId Moodle user ID.
 */
function local_wp_integration_auto_login_user($moodleUserId) {
    // Moodle system settings
    $moodle_base_url = 'https://my.moodle.com';
    $moodle_api_token = 'enter-moodle-token-here';

    // Parameters for retrieving user via Moodle API
    $user_params = array(
        'wstoken' => $moodle_api_token,
        'wsfunction' => 'core_user_get_users',
        'moodlewsrestformat' => 'json',
        'userids[0]' => $moodleUserId,
    );

    // Call Moodle API to retrieve user information
    $response = \core\network\http::post($moodle_base_url . '/webservice/rest/server.php', $user_params);
    $result = json_decode($response, true);

    // Check if the user exists
    if (isset($result[0]['username'])) {
        $moodleUsername = $result[0]['username'];
        $moodlePassword = wp_hash_password($result[0]['password']); // Adjust based on how passwords are stored in WordPress

        // Parameters for authentication via Moodle API
        $auth_params = array(
            'username' => $moodleUsername,
            'password' => $moodlePassword,
            'service' => 'moodle_mobile_app',
        );

        // Call Moodle API for authentication
        $response = \core\network\http::post($moodle_base_url . '/login/token.php', $auth_params);
        $result = json_decode($response, true);

        // Check if authentication is successful
        if (isset($result['token'])) {
            global $SESSION;
            $SESSION->wantsurl = $moodle_base_url; // Set the desired URL for user login and redirect
            complete_user_login($moodleUserId);

            // Comment if you don't want to set the Moodle auto-login token in a cookie
            set_user_preference('MoodleAutoLoginToken', $result['token']);
        } else {
            error_log('Error authenticating user in Moodle: ' . print_r($result, true));
        }
    }
}