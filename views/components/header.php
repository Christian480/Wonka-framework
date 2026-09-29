<header class="site">

    <div class="wrap">

        <p class="logo">
            <a href="<?= $basePath ?>/" aria-label="Wonka Chocolate Factory - Accueil">

                <img
                    src="<?= $basePath ?>/public/assets/images/logo-wonka.png"
                    alt="Wonka Chocolate Factory"
                    width="200"
                >

            </a>
        </p>

        <input
            type="checkbox"
            id="menu-toggle"
            class="menu-toggle"
        >

        <label
            for="menu-toggle"
            class="burger"
            aria-label="Ouvrir le menu"
        >
            ☰
        </label>

        <?php require __DIR__ . '/navigation.php'; ?>

    </div>

</header>