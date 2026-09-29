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


// echo file_get_contents(__DIR__ . "/public/assets/css/commun.css/styles.css");
echo file_get_contents(__DIR__ . "/public/components/head.html");
echo "<link rel=\"stylesheet\" href=\"assets/css/special.css/". $_GET['page'] . ".css\">";
echo file_get_contents(__DIR__ . "/public/components/header.html");
$chemin = __DIR__ . "/public/Acceuil/". $_GET['page'] . ".html";
if (!file_exists($chemin)) {
    echo "Page not found";
} else {
    echo file_get_contents($chemin);
}
echo "<link rel=\"stylesheet\" href=\"assets/css/special.css/". $_GET['page'] . ".css\">";
$css = __DIR__ . "/public/assets/css/special.css/". $_GET['page'] . ".css";
if (!file_exists($css)) {
    echo "css not found";
} else {
echo "<link rel=\"stylesheet\" href=\"assets/css/special.css/". $_GET['page'] . ".css\">";
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $pdo = new PDO("sqlite:wonka.sqlite");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT name FROM products WHERE slug = :slug");
    $stmt->execute(['slug' => 'wonka-bar']);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    $title = $product['name'] ?? 'Boutique Wonka';
    
    echo "Titre de la page : " . htmlspecialchars($title);

} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

