<?php

// error_reporting(E_ERROR);

// Mail configurations
define('SEND_EMAIL', TRUE);
define('EMAIL_HOST', 'smtp.gmail.com');
define('EMAIL_AUTH', TRUE);
define('EMAIL_USERNAME', 'ngpasc.examcell@gmail.com');
define('EMAIL_PASSWORD', 'aysesarllmjhtzrm');
define('EMAIL_SECURE', 'ssl');
define('EMAIL_PORT', 465);

// Google API Configuration
define('GOOGLE_CLIENT_ID', '641668011497-pplovioa7m0emjn2depnsqav3rgumrf6.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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');
define('GOOGLE_OAUTH_SCOPE', 'https://www.googleapis.com/auth/calendar');
define('REDIRECT_URI', 'http://localhost/examcell/admin/google_calendar_event_sync.php');

// Google OAuth URL
$googleOauthURL = 'https://accounts.google.com/o/oauth2/auth?scope='.urlencode(GOOGLE_OAUTH_SCOPE).'&redirect_uri='.REDIRECT_URI.'&response_type=code&client_id='.GOOGLE_CLIENT_ID.'&access_type=online';

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'examcell';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    echo "Connection Failed";
    exit();
}
