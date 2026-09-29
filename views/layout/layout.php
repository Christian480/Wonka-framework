<?php

$basePath = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/');

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        <?= htmlspecialchars($title ?? 'Wonka Chocolate Factory') ?>
    </title>

    <link rel="stylesheet"
          href="<?= $basePath ?>/public/assets/css/styles.css">
</head>

<body>

    <?php require dirname(__DIR__) . '/components/header.php'; ?>

    <main>
        <?= $content ?>
    </main>

    <?php require dirname(__DIR__) . '/components/footer.php'; ?>

    <script src="<?= $basePath ?>/public/assets/js/app.js"></script>

</body>

</html> Déjà si on part du principe de l'exercice je me dis déjà que même si le code est brouillon il est il est déjà fonctionnel