<?php

session_start();

$verify = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $captcha = $_POST['captcha'];
  $session_captcha = $_SESSION['captcha'];

  if ($captcha == $session_captcha) {
    $verify = true;
  } else {
    $error = 'Captcha tidak valid!';
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Captcha - Backend Development</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php if ($verify) : ?>
    <h1>Berhasil, captcha terverifikasi</h1>
  <?php else : ?>
    <form action="." method="POST">
      <h1>Verify Captcha</h1>
      <input type="text" name="captcha" placeholder="Enter captcha code">
      <img src="./captcha.php" alt="captcha image">
      <?php if ($error) : ?>
        <small><?= $error ?></small>
      <?php endif ?>
      <button type="submit">Submit</button>
    </form>
  <?php endif ?>
</body>

</html>