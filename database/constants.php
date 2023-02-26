<?php 
// Mail configurations
if (!defined('SEND_EMAIL')) define('SEND_EMAIL', TRUE);

// Google API Configuration
if(!defined('GOOGLE_CLIENT_ID')) define('GOOGLE_CLIENT_ID', '641668011497-pplovioa7m0emjn2depnsqav3rgumrf6.apps.googleusercontent.com');
if(!defined('GOOGLE_CLIENT_SECRET')) define('GOOGLE_CLIENT_SECRET', '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');
if(!defined('GOOGLE_OAUTH_SCOPE')) define('GOOGLE_OAUTH_SCOPE', 'https://www.googleapis.com/auth/calendar');
if(!defined('REDIRECT_URI')) define('REDIRECT_URI', 'http://localhost/examcell/admin/google_calendar_event_sync.php');

// Google OAuth URL
$googleOauthURL = 'https://accounts.google.com/o/oauth2/auth?scope='.urlencode(GOOGLE_OAUTH_SCOPE).'&redirect_uri='.REDIRECT_URI.'&response_type=code&client_id='.GOOGLE_CLIENT_ID.'&access_type=online';
