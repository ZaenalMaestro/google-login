<?php 
//start session
session_start();
require_once 'config.php';

if (isset($_GET['code'])) {
   $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
   $client->setAccessToken($token);

   // getting user profile
   $gauth = new Google_Service_Oauth2($client);
   $google_info = $gauth->userinfo->get();

   $_SESSION['info'] = [
      'name' => $google_info->name, 
      'email' => $google_info->email, 
      'picture' => $google_info->picture
   ];
   header('Location: /google-login');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>
   <div class="container">
      <a href="<?= $client->createAuthUrl()?>" class="btn btn-primary">login with google</a>
   </div>
</body>
</html>