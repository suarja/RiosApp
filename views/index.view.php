<!DOCTYPE html>
<html lang="en" class="dark-mode">

<head>
  <style>
    html {
      background-color: black;
    }

    body {
      padding: 25px;
      background-color: white;
      color: black;
      font-size: 25px;
    }

    .dark-mode {
      background-color: black;
      color: white;
    }

    .light-mode {
      background-color: white;
      color: black;
    }
  </style>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $heading; ?></title>
</head>

<body class="dark-mode">
  
  <?php require './partials/landing.view.php'; ?>
  <?php require './partials/player.view.php'; ?>
</body>

</html>