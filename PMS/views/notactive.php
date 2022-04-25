<?php

if (!isLoggedIn()) {
  header("location: " . URLROOT . "users");
}
if (isActive()) {
  header("location: " . URLROOT . "Home");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <base href="<?php echo URLROOT ?>">
  <meta charset="utf-8">
  <title>Account Disabled</title>

  <link rel="stylesheet" href="views/style/notactive.css">
  <link rel="icon" href="views/images/index/favpng_logo-pharmacy.ico">
</head>

<body>


  <div class="overlay"></div>
  <div class="title">

    <h3 class="not-active-title">Your Account is Not Activate Please Contact With Admin</h3>
    <a href="users/signout">Sign out</a>
  </div>

</body>

</html>