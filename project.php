<?php
require_once 'error_handler.php';
require_once 'admin/Database/db.php';

session_start();

// --- Language Logic ---
if (!isset($_SESSION['lang'])) {
  $_SESSION['lang'] = 'en';
}
if (isset($_GET['lang'])) {
  $_SESSION['lang'] = $_GET['lang'];
}
$current_lang = $_SESSION['lang'];
if (file_exists('lang/' . $current_lang . '.php')) {
  include 'lang/' . $current_lang . '.php';
} else {
  include 'lang/en.php';
}

$settings = $dbcon->query("SELECT * FROM company_settings WHERE id=1")->fetch_assoc();
$contact = $dbcon->query("SELECT * FROM contact_information WHERE id=1")->fetch_assoc();

$products_query = $dbcon->query("
    SELECT 
        p.id, p.name, p.name_ar, p.image, p.details_url, p.description, p.description_ar,
        GROUP_CONCAT(DISTINCT c.name SEPARATOR ', ') as category_names
    FROM 
        products p
    LEFT JOIN 
        product_category_map pcm ON p.id = pcm.product_id
    LEFT JOIN 
        product_categories c ON pcm.category_id = c.id
    GROUP BY 
        p.id
    ORDER BY 
        p.id DESC
");

$products_array = [];
if ($products_query) {
  while ($row = $products_query->fetch_assoc()) {
    $products_array[] = $row;
  }
}
?>
<!DOCTYPE html>
<html lang="<?= $current_lang ?>" dir="<?= ($current_lang == 'ar' ? 'rtl' : 'ltr') ?>">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?= htmlspecialchars($settings['company_name'] ?? 'Company Name') ?> - <?= $lang['project_link'] ?? 'Projects' ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="assets/img/Artboard-8-8.png" rel="icon">
  <link href="assets/img/Artboard-8-8.png" rel="apple-touch-icon">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
  <canvas id="cosmic-canvas"></canvas>
  <div id="preloader">
    <div class="preloader-logo-container">
      <svg width="40" height="40" viewBox="0 0 1000 97" fill="none" xmlns="http://www.w3.org/2000/svg">
        <defs>
          <linearGradient id="light-flare" x1="0%" y1="0%" x2="100%" y2="0%">
            <stop offset="0%" stop-color="rgba(138, 79, 255, 0)" />
            <stop offset="50%" stop-color="rgba(255, 255, 255, 0.8)" />
            <stop offset="100%" stop-color="rgba(138, 79, 255, 0)" />
          </linearGradient>
        </defs>
        <path class="logo-path light-flare-path " d="M516.74,326.75l-88.5,166.51c-9.3,17.47-34.54,16.89-43-1l-78-164.81a24.06,24.06,0,0,0-21.75-13.77H272.23a24.07,24.07,0,0,0-21.87,34.12L384.48,639.57c8.48,18.44,34.58,18.75,43.49.51l124.31-254.3a24.07,24.07,0,0,1,21-13.49l96.43-2.61-.36.77-76.05,163c-8.61,18.44-34.79,18.54-43.54.17l-4.85-10.2c-9-18.8-35.94-18.13-43.95,1.09h0a24.06,24.06,0,0,0,.72,20.07l50.91,101.17a24.07,24.07,0,0,0,42.84.31l154.91-297.1a24.07,24.07,0,0,0-21.38-35.2L538,314A24.07,24.07,0,0,0,516.74,326.75ZM691.82,344v0h0Zm0-13.43h0Z" />
      </svg>
    </div>
  </div>

  <canvas id="particle-canvas"></canvas>
  <?php include 'partials/header.php'; ?>

  <main id="main">
    <section id="portal-showcase" class="section-bg"
      data-projects='<?= htmlspecialchars(json_encode($products_array, JSON_UNESCAPED_UNICODE)); ?>'
      data-lang="<?= $current_lang; ?>">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2><?= $lang['project_title'] ?? 'Our Projects' ?></h2>
          <p><?= $lang['project_description'] ?? 'Check out our beautiful projects.' ?></p>
        </div>

        <div class="portal-grid">
          <?php if (!empty($products_array)): ?>
            <?php foreach ($products_array as $index => $product): ?>
              <div class="portal-card" data-index="<?= $index ?>" data-product-id="<?= $product['id'] ?>" tabindex="0">
                <div class="card-background" style="background-image: url('assets/img/portfolio/<?= htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8') ?>');"></div>
                <div class="card-overlay"></div>
                <div class="card-content">
                  <h3><?= ($current_lang == 'ar' && !empty($product['name_ar'])) ? htmlspecialchars($product['name_ar']) : htmlspecialchars($product['name']); ?></h3>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </section>
  </main>

  <div class="portal-slideshow">
    <button class="slideshow-close-btn"><i class='bx bx-x'></i></button>
    <div class="slideshow-nav prev"><i class='bx bx-chevron-left'></i></div>
    <div class="slideshow-nav next"><i class='bx bx-chevron-right'></i></div>
    <div class="slideshow-track">
    </div>
  </div>


  <?php include 'partials/footer.php'; ?>


  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/js/main.js"></script>

</body>

</html>