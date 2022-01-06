<?php 
require_once 'vendor/autoload.php';

//start session
session_start();

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


if (isset($_GET['code'])) {
   $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
   $client->setAccessToken($token);

   // getting user profile
   $gauth = new Google_Service_Oauth2($client);
   $google_info = $gauth->userinfo->get();
   $email = $google_info->email;
   $name = $google_info->email;

   echo "Welcome $name | email: $email";
   echo '<a href="/google-login/sign_in.php?logout=">login with google</a>';
} else if (isset($_GET['logout'])){
   unset($_SESSION["auto"]);
	unset($_SESSION['token']);
	$client->revokeToken();
	header('Location: ' . filter_var($redirectURI, FILTER_SANITIZE_URL)); //redirect user back to pag
}else {
   echo "<a href=" .$client->createAuthUrl().">login with google</a>";
}