<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$linkPrefix = ($currentPage === 'index.php') ? '' : 'index.php';
?>
<header id="header">
    <div class="container-fluid d-flex align-items-center justify-content-between">

       <div class="logo-container" id="logo-menu-toggler">
            <a href="index.php?lang=<?= $current_lang ?>">
                <svg class="header-logo-svg" viewBox="250 300 650 350" xmlns="http://www.w3.org/2000/svg">
                    <g class="flipper">
                        <g class="logo-wrapper">
                            <path fill="var(--accent-purple)" d="M516.74,326.75l-88.5,166.51c-9.3,17.47-34.54,16.89-43-1l-78-164.81a24.06,24.06,0,0,0-21.75-13.77H272.23a24.07,24.07,0,0,0-21.87,34.12L384.48,639.57c8.48,18.44,34.58,18.75,43.49.51l124.31-254.3a24.07,24.07,0,0,1,21-13.49l96.43-2.61-.36.77-76.05,163c-8.61,18.44-34.79,18.54-43.54.17l-4.85-10.2c-9-18.8-35.94-18.13-43.95,1.09h0a24.06,24.06,0,0,0,.72,20.07l50.91,101.17a24.07,24.07,0,0,0,42.84.31l154.91-297.1a24.07,24.07,0,0,0-21.38-35.2L538,314A24.07,24.07,0,0,0,516.74,326.75ZM691.82,344v0h0Zm0-13.43h0Z"/>
                        </g>
                        <g class="menu-icon-wrapper">
                            <line class="menu-line line-1" x1="350" y1="400" x2="550" y2="400"/>
                            <line class="menu-line line-2" x1="350" y1="470" x2="550" y2="470"/>
                            <line class="menu-line line-3" x1="350" y1="540" x2="550" y2="540"/>
                        </g>
                    </g>
                </svg>
            </a>
        </div>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto <?= ($currentPage === 'index.php' || $currentPage === '') ? 'active' : '' ?>" href="<?= $linkPrefix ?>#hero"><?= $lang['home_link'] ?? 'Home' ?></a></li>
                <li class="dropdown"><a href="<?= $linkPrefix ?>#about"><span><?= $lang['about_link'] ?? 'About' ?></span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="<?= $linkPrefix ?>#features"><?= $lang['features_link'] ?? 'Features' ?></a></li>
                        <li><a href="<?= $linkPrefix ?>#team"><?= $lang['team_link'] ?? 'Team' ?></a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="<?= $linkPrefix ?>#services"><?= $lang['services_link'] ?? 'Services' ?></a></li>
                <li><a class="nav-link <?= ($currentPage === 'project.php') ? 'active' : '' ?>" href="project.php"><?= $lang['project_link'] ?? 'Projects' ?></a></li>
                <li><a class="nav-link scrollto" href="<?= $linkPrefix ?>#contact"><?= $lang['contact_link'] ?? 'Contact' ?></a></li>
                <li class="dropdown language-dropdown-desktop">
                    <a ><span><i class="bi bi-globe"></i> <?= $lang['lang'] ?? 'lang' ?></span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="?lang=en">English</a></li>
                        <li><a href="?lang=ar">العربية</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div class="mobile-nav-toggle language-toggle-mobile">
            <i class="bi bi-globe"></i>
            <ul class="language-dropdown-mobile">
                <li><a href="?lang=en">English</a></li>
                <li><a href="?lang=ar">العربية</a></li>
            </ul>
        </div>
        
    </div>
</header>