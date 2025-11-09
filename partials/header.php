<header id="header">
    <div class="container-fluid d-flex align-items-center justify-content-between">

        <!-- LOGO (will also be the mobile menu toggle) -->
        <h1 class="logo">
            <a href="index.php?lang=<?= $current_lang ?>" id="mobile-menu-toggle-logo">
                <img src="assets/img/CompanyInfo/<?= htmlspecialchars($settings['company_logo'] ?? 'Artboard 8-8.png') ?>" alt="<?= htmlspecialchars($settings['company_name'] ?? 'Logo') ?>" class="logo">
            </a>
        </h1>

        <!-- DESKTOP NAVIGATION -->
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="index.php#hero"><?= $lang['home_link'] ?? 'Home' ?></a></li>
                <li class="dropdown"><a href="index.php#about"><span><?= $lang['about_link'] ?? 'About' ?></span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="index.php#features"><?= $lang['features_link'] ?? 'Features' ?></a></li>
                        <li><a href="index.php#team"><?= $lang['team_link'] ?? 'Team' ?></a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="index.php#services"><?= $lang['services_link'] ?? 'Services' ?></a></li>
                <li><a class="nav-link scrollto" href="index.php#project"><?= $lang['project_link'] ?? 'Projects' ?></a></li>
                <li><a class="nav-link scrollto" href="index.php#contact"><?= $lang['contact_link'] ?? 'Contact' ?></a></li>
                <!-- Language dropdown for desktop -->
                <li class="dropdown language-dropdown-desktop">
                    <a href="#"><span><i class="bi bi-globe"></i> <?= $lang['lang'] ?? 'lang' ?></span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="?lang=en">English</a></li>
                        <li><a href="?lang=ar">العربية</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- NEW: MOBILE LANGUAGE TOGGLE (Replaces the old hamburger icon) -->
        <div class="mobile-nav-toggle language-toggle-mobile">
            <i class="bi bi-globe"></i>
            <ul class="language-dropdown-mobile">
                <li><a href="?lang=en">English</a></li>
                <li><a href="?lang=ar">العربية</a></li>
            </ul>
        </div>
        
    </div>
</header>