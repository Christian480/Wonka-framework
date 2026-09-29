<?php

require_once __DIR__ . '/../index.php';

try {

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS categories (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL UNIQUE
        )
    ");
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS products (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            category_id INTEGER NOT NULL,
            name TEXT NOT NULL,
            slug TEXT NOT NULL UNIQUE,
            description TEXT,
            price REAL NOT NULL,
            image TEXT,
            availability TEXT,
            rarity TEXT,
            reference TEXT UNIQUE,
            composition TEXT,
            theme TEXT,

            FOREIGN KEY (category_id)
            REFERENCES categories(id)
        )
    ");
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS product_attributes (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            product_id INTEGER NOT NULL,
            name TEXT NOT NULL,
            value TEXT NOT NULL,

            FOREIGN KEY (product_id)
            REFERENCES products(id)
            ON DELETE CASCADE
        )
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS faqs (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            product_id INTEGER NOT NULL,
            question TEXT NOT NULL,
            answer TEXT NOT NULL,

            FOREIGN KEY (product_id)
            REFERENCES products(id)
            ON DELETE CASCADE
        )
    ");

    $categories = [
        'Barres classiques',
        'Confiseries expérimentales',
        'Boissons expérimentales',
        'Collection & objets',
        'Décoration comestible',
        'Barres signature'
    ];

    $stmt = $pdo->prepare("
        INSERT OR IGNORE INTO categories (name)
        VALUES (:name)
    ");

    foreach ($categories as $category) {
        $stmt->execute([
            'name' => $category
        ]);
    }

    $stmt = $pdo->prepare("
        INSERT OR IGNORE INTO products (
            category_id,
            name,
            slug,
            description,
            price,
            image,
            availability,
            rarity,
            reference,
            composition,
            theme
        )
        VALUES (
            :category_id,
            :name,
            :slug,
            :description,
            :price,
            :image,
            :availability,
            :rarity,
            :reference,
            :composition,
            :theme
        )
    ");

    // Wonka Bar
    $stmt->execute([
        'category_id' => 1,
        'name' => 'Wonka Bar',
        'slug' => 'wonka-bar',
        'description' => 'La barre qui a rendu cinq enfants célèbres.',
        'price' => 3.50,
        'image' => 'wonka-bar.png',
        'availability' => 'Disponible toute l’année',
        'rarity' => 'Courante',
        'reference' => 'WB-1971-001',
        'composition' => 'Chocolat au lait, caramel et nougatine.',
        'theme' => 'pink'
    ]);


    // Everlasting Gobstopper
    $stmt->execute([
        'category_id' => 2,
        'name' => 'Everlasting Gobstopper',
        'slug' => 'everlasting-gobstopper',
        'description' => 'Le bonbon qui ne fond jamais.',
        'price' => 12.00,
        'image' => 'everlasting-gobstopper.png',
        'availability' => 'Rupture expérimentale depuis 1998',
        'rarity' => 'Très rare',
        'reference' => 'EG-1984-007',
        'composition' => 'Sucre dur compressé.',
        'theme' => 'purple'
    ]);

    $stmt = $pdo->prepare("
        INSERT INTO product_attributes (
            product_id,
            name,
            value
        )
        VALUES (
            :product_id,
            :name,
            :value
        )
    ");
    $product = $pdo->query("
        SELECT id
        FROM products
        WHERE slug = 'wonka-bar'
    ")->fetch();

    if ($product) {

        $stmt->execute([
            'product_id' => $product['id'],
            'name' => 'Poids net',
            'value' => '62 g'
        ]);

        $stmt->execute([
            'product_id' => $product['id'],
            'name' => 'Conservation',
            'value' => '18 mois'
        ]);
    }

    echo "<h2>Base de données créée avec succès !</h2>";

    echo "<p>Tables créées :</p>";

    echo "<ul>";
    echo "<li>categories</li>";
    echo "<li>products</li>";
    echo "<li>product_attributes</li>";
    echo "<li>faqs</li>";
    echo "</ul>";


} catch (PDOException $e) {

    echo "Erreur lors de la création de la base : "
        . htmlspecialchars($e->getMessage());
}
var_dump($pdo->query("SELECT * FROM categories")->fetchAll());