<?php

$dbFile = __DIR__ . '/wonka.sqlite';

try {
    $pdo = new PDO('sqlite:' . $dbFile);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $pdo->exec('PRAGMA foreign_keys = ON');

} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

echo file_get_contents(__DIR__ . "/public/components/head.html");
echo file_get_contents(__DIR__ . "/public/components/header.html");
$chemin = __DIR__ . "/public/Acceuil/contact.html";
print_r($chemin);
if (!file_exists($chemin)) {
    echo "Page not found";
} else {
    echo file_get_contents($chemin);
}
echo file_get_contents(__DIR__ . "/public/components/footer.html");
