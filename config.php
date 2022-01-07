<?php
require_once 'vendor/autoload.php';

$clientID = '772140768562-kilm2j37bjucefm525pdv9lu9r19oc2m.apps.googleusercontent.com';
$clientSecret = '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';
$redirectURI = 'http://localhost/google-login/sign_in.php';

// CREATE CLIENT REQUEST TO GOOGLE
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectURI);
$client->addScope('profile');
$client->addScope('email');