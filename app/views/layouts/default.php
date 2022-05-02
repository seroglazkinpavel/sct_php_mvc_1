<?php
/**@var $content */
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
          integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn"
          crossorigin="anonymous"
    >
    <link rel="stylesheet" href="/app/web/css/styles.css">
    <title><?= $this->title;?></title>
</head>
<body>
<header class="header">

</header>
<div class="contents">
    <?= $content; ?>
</div>
<footer class="footer">

</footer>

</body>
</html>
