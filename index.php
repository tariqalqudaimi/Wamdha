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
$team_members_query = $dbcon->query("SELECT name, position, image_file, website_url, facebook_url, instagram_url, linkedin_url FROM team_members ORDER BY display_order ASC");
$services_homepage = $dbcon->query("SELECT box_color_class, image_file, title, title_ar, description, description_ar FROM services ORDER BY id DESC LIMIT 6");
$total_services_count = $dbcon->query("SELECT COUNT(id) as count FROM services")->fetch_assoc()['count'];
$features_query = $dbcon->query("SELECT * FROM features ORDER BY display_order ASC");
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
    LIMIT 3
");

$products_array = [];
if ($products_query) {
  while ($row = $products_query->fetch_assoc()) {
    $products_array[] = $row;
  }
}
$about_main_description = null;
$about_nodes = [];
$about_query = $dbcon->query("SELECT * FROM about_sections ORDER BY id ASC");
if ($about_query) {
  while ($row = $about_query->fetch_assoc()) {
    if ($row['section_key'] === 'main_description') {
      $about_main_description = $row;
    } else {
      $about_nodes[] = $row;
    }
  }
}


?>

<!DOCTYPE html>
<html lang="<?= $current_lang ?>" dir="<?= ($current_lang == 'ar' ? 'rtl' : 'ltr') ?>">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?= htmlspecialchars($current_lang == 'en' ? ($settings['company_name'] ?? '') : ($settings['company_name_ar'] ?? '')) ?> <?= htmlspecialchars($current_lang == 'en' ? ($settings['hero_title'] ?? '') : ($settings['hero_title_ar'] ?? '')) ?></title>
  <meta content="<?php htmlspecialchars($current_lang == 'en' ? ($settings['hero_subtitle'] ?? '') : ($settings['hero_subtitle_ar'] ?? ''))?>" name="description">
  <meta content="" name="keywords">
  <link href="assets/img/Artboard-8-8.png" rel="icon">
  <link href="assets/img/Artboard-8-8.png" rel="aArtboard 8-8">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css?v=<?php echo filemtime('assets/css/style.css'); ?>">

 
  <!-- اختياري: يمكنك إضافته إذا أردت، لكنه ليس مهماً لجوجل -->
  <meta name="keywords" content="ومضة تك,ومضة, wamdhatach, wamdha, شركة برمجة, تصميم مواقع, تطوير تطبيقات, حلول برمجية">

  <!-- Open Graph / Facebook (للمظهر عند المشاركة) -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://www.wamdhatach.com/">
  <meta property="og:title" content="WamdhaTech | شركة ومضة تك للحلول البرمجية وتصميم المواقع">
  <meta property="og:description" content="نقدم في ومضة تك خدمات برمجية مبتكرة تشمل تصميم وتطوير المواقع الإلكترونية، تطبيقات الجوال، والأنظمة المخصصة.">
 
  <!-- Twitter Card -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="https://www.wamdhatach.com/">
  <meta property="twitter:title" content="WamdhaTech | شركة ومضة تك للحلول البرمجية وتصميم المواقع">
  <meta property="twitter:description" content="نقدم في ومضة تك خدمات برمجية مبتكرة تشمل تصميم وتطوير المواقع الإلكترونية، تطبيقات الجوال، والأنظمة المخصصة.">
  


</head>

<body>


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

 <!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
  <div class="container-fluid" data-aos="fade-up">
    <div class="row align-items-center justify-content-center">

      <!-- Text Content Column -->
      <div class="col-lg-5 col-md-12 hero-content text-center text-lg-start order-2 order-lg-1" data-aos="fade-right">
        <h1><?= htmlspecialchars($current_lang == 'en' ? ($settings['hero_title'] ?? '') : ($settings['hero_title_ar'] ?? '')) ?></h1>
        <div class="hero-content-disc"><?= htmlspecialchars($current_lang == 'en' ? ($settings['hero_subtitle'] ?? '') : ($settings['hero_subtitle_ar'] ?? '')) ?></div>
        <div>
          <a href="#about" class="btn-get-started scrollto"><?= $lang['get_started_btn'] ?? 'Get Started' ?></a>
        </div>
      </div>

    <!-- Image Column with SVG Animation -->
<div class="col-lg-6 col-md-8 hero-img text-center order-1 order-lg-2" data-aos="fade-left">
    <div class="hero-logo-container">
        <!-- The light beam that will travel and trigger the drawing -->
        <div class="light-beam"></div>
        
        <!-- The SVG Logo that will be drawn -->
        <svg class="hero-animated-svg" viewBox="150 300 850 370" xmlns="http://www.w3.org/2000/svg">
            <path class="hero-logo-path" d="M516.74,326.75l-88.5,166.51c-9.3,17.47-34.54,16.89-43-1l-78-164.81a24.06,24.06,0,0,0-21.75-13.77H272.23a24.07,24.07,0,0,0-21.87,34.12L384.48,639.57c8.48,18.44,34.58,18.75,43.49.51l124.31-254.3a24.07,24.07,0,0,1,21-13.49l96.43-2.61-.36.77-76.05,163c-8.61,18.44-34.79,18.54-43.54.17l-4.85-10.2c-9-18.8-35.94-18.13-43.95,1.09h0a24.06,24.06,0,0,0,.72,20.07l50.91,101.17a24.07,24.07,0,0,0,42.84.31l154.91-297.1a24.07,24.07,0,0,0-21.38-35.2L538,314A24.07,24.07,0,0,0,516.74,326.75ZM691.82,344v0h0Zm0-13.43h0Z"/>
        </svg>
    </div>
</div>

    </div>
  </div>
</section><!-- End Hero -->

  <main id="main">
   <!-- ======= About Us Section (Company Infographic - Responsive & Interactive) ======= -->
<section id="about" class="about section-bg">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2><?= $lang['about_title'] ?? 'About Us' ?></h2>
      <?php if ($about_main_description): ?>
        <div><?= ($current_lang == 'ar' && !empty($about_main_description['details_ar'])) ? $about_main_description['details_ar'] : $about_main_description['details']; ?></div>
      <?php endif; ?>
    </div>

    <?php if (!empty($about_nodes)): ?>
      <div class="about-us-container company-infographic-container">
        
        <div class="background-particles">
          <?php for ($i = 0; $i < 15; $i++) { echo "<span></span>"; } ?>
        </div>
        
        <div class="infographic-grid">
           <div class="central-hub-animation">
            <div class="hub-sparkle"></div>
          </div>
          <?php foreach ($about_nodes as $index => $node): ?>
            <div class="infographic-node pos-<?= $index + 1 ?>" style="--animation-delay: <?= $index * 0.15 ?>s;">
              
              <div class="node-arrow-background"></div>
              
              <div class="node-main-plate">
                <span class="node-number-label"><?= ($index < 9 ? '0' : '') . ($index + 1) ?></span>
                <h4 class="node-title"><?= htmlspecialchars(($current_lang == 'ar' && !empty($node['title_ar'])) ? $node['title_ar'] : $node['title']) ?></h4>
                
                <div class="node-content-body">
                    <div class="node-brief-description"> 
                      <?= ($current_lang == 'ar' && !empty($node['details_ar'])) ? $node['details_ar'] : $node['details'] ?>
                    </div>
                    <button class="read-more-btn"><?= $lang['read_more'] ?? 'Read More' ?></button>
                    <button class="read-more-btn show-less-btn" style="display: none;"><?= $lang['show_less'] ?? 'Show Less' ?></button>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        
      </div>
    <?php endif; ?>

  </div>
</section>
<!-- ======= Services Section (The Luminous Touch v2) ======= -->
<section id="services" class="services-v-luminous">
  <div class="animated-grid"></div>

  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2><?= $lang['services_title'] ?? 'Services' ?></h2>
      <p><?= $lang['services_description'] ?? 'Our Services' ?></p>
    </div>
    <div class="row gy-4">
      <?php if ($services_homepage): foreach ($services_homepage as $index => $service): ?>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 100 ?>">
            <div class="luminous-card">
              <div class="spotlight"></div>
              
              <!-- Stardust particles container -->
              <div class="stardust-burst"></div>

              <div class="luminous-content glowing">
                <div class="icon"><img src="assets/img/services/<?= htmlspecialchars($service['image_file']) ?>" alt=""></div>
                <h4><?= htmlspecialchars($current_lang == 'en' ? $service['title'] : $service['title_ar'])  ?></h4>
                <p><?= htmlspecialchars($current_lang == 'en' ? $service['description'] : $service['description_ar']) ?></p>
              </div>

              <div class="luminous-content default">
                <div class="icon"><img src="assets/img/services/<?= htmlspecialchars($service['image_file']) ?>" alt=""></div>
                <h4><?= htmlspecialchars($current_lang == 'en' ? $service['title'] : $service['title_ar'])  ?></h4>
                <p><?= htmlspecialchars($current_lang == 'en' ? $service['description'] : $service['description_ar']) ?></p>
              </div>
            </div>
          </div>
      <?php endforeach; endif; ?>
    </div>
    <?php if ($total_services_count > 6): ?>
      <div class="text-center mt-5">
        <a href="services.php?lang=<?= $current_lang ?>" class="btn-see-all"><?= $lang['see_all_services_btn'] ?? 'See All Services' ?></a>
      </div>
    <?php endif; ?>
  </div>
</section>
<!-- End Services Section -->
   <!-- ======= Features Section (Interactive Holograms) ======= -->
<section id="features" class="features-v-hologram section-bg">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2><?= $lang['features_title'] ?? 'Our Core Features' ?></h2>
    </div>
    <div class="row gy-5">
      <?php if ($features_query && $features_query->num_rows > 0): 
        foreach ($features_query as $feature): ?>
        <div class="col-lg-6">
          <div class="hologram-card">
            <div class="hologram-emitter">
              <div class="hologram-light"></div>
              <div class="hologram-icon">
                <i class="<?= htmlspecialchars($feature['icon_class']) ?>"></i>
              </div>
            </div>
            <div class="hologram-content">
              <h3><?= htmlspecialchars($current_lang == 'en' ? $feature['title_en'] : $feature['title_ar']) ?></h3>
              <p><?= htmlspecialchars($current_lang == 'en' ? $feature['description_en'] : $feature['description_ar']) ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; endif; ?>
    </div>
  </div>
</section>
<!-- End Features Section -->


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
      <div class="modal_btn_see">
        <a href="project.php" class="modal-link btn-visit-website project_see_more " target="_blank"><?= $lang['see_project'] ?? 'See All Projects' ?></a>
      </div>

      <div class="portal-slideshow">
        <button class="slideshow-close-btn"><i class='bx bx-x'></i></button>
        <div class="slideshow-nav prev"><i class='bx bx-chevron-left'></i></div>
        <div class="slideshow-nav next"><i class='bx bx-chevron-right'></i></div>
        <div class="slideshow-track">

        </div>
      </div>
    </section>

    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2><?= $lang['team_title'] ?? 'Team' ?></h2>
          <p><?= $lang['team_description'] ?? 'Our Constellation of Experts' ?></p>
        </div>
        <div class="swiper team-slider">
          <div class="swiper-wrapper">
            <?php if ($team_members_query && $team_members_query->num_rows > 0): foreach ($team_members_query as $member): ?>
                <div class="swiper-slide">
                  <div class="celestial-profile">
                    <div class="profile-image-wrapper">
                      <div class="orbital-ring"></div>
                      <img src="assets/img/team/<?= htmlspecialchars($member['image_file']) ?>" class="img-fluid" alt="<?= htmlspecialchars($member['name']) ?>" loading="lazy">
                    </div>
                    <div class="member-info">
                      <h4><?= htmlspecialchars($member['name']) ?></h4>
                      <span><?= htmlspecialchars($member['position']) ?></span>
                    </div>
                    <div class="social-links">
                      <?php if (!empty($member['website_url'])): ?><a href="<?= htmlspecialchars($member['website_url']) ?>"><i class='bi bi-globe'></i></a><?php endif; ?>
                      <?php if (!empty($member['facebook_url'])): ?><a href="<?= htmlspecialchars($member['facebook_url']) ?>"><i class="bi bi-facebook"></i></a><?php endif; ?>
                      <?php if (!empty($member['instagram_url'])): ?><a href="<?= htmlspecialchars($member['instagram_url']) ?>"><i class="bi bi-instagram"></i></a><?php endif; ?>
                      <?php if (!empty($member['linkedin_url'])): ?><a href="<?= htmlspecialchars($member['linkedin_url']) ?>"><i class="bi bi-linkedin"></i></a><?php endif; ?>
                    </div>
                  </div>
                </div>
            <?php endforeach;
            endif; ?>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section>

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2><?= $lang['contact_title'] ?? 'Contact' ?></h2>
          <p><?= $lang['contact_description'] ?? '' ?></p>
        </div>

        <div class="contact-page-container show-info-mode">
          <div class="forms-container">
            <div class="contact-info-swap">

              <form action="forms/contact.php" method="POST" class="contact-form-main animated-contact-form">
                <h2 class="title"><?= $lang['contact_form_title'] ?? 'Send a Message' ?></h2>
                <div class="input-field">
                  <i class="bx bxs-user"></i>
                  <input type="text" name="name" placeholder="<?= $lang['contact_form_name_placeholder'] ?? 'Full Name' ?>" required>
                </div>
                <div class="input-field">
                  <i class='bx bx-envelope'></i>
                  <input type="email" name="email" placeholder="<?= $lang['contact_form_email_placeholder'] ?? 'Email' ?>" required>
                </div>
                <div class="input-field">
                  <i class='bx bxs-pen'></i>
                  <input type="text" name="subject" placeholder="<?= $lang['contact_form_subject_placeholder'] ?? 'Subject' ?>" required>
                </div>
                <div class="input-field textarea-field">
                  <i class='bx bxs-comment-dots'></i>
                  <textarea name="message" placeholder="<?= $lang['contact_form_message_placeholder'] ?? 'Your Message' ?>" required></textarea>
                </div>

                <div class="my-3">
                  <div class="loading"><?= $lang['form_loading'] ?? 'Loading' ?></div>
                  <div class="error-message"></div>
                  <div class="sent-message"><?= $lang['form_sent_message'] ?? 'Your message has been sent. Thank you!' ?></div>
                </div>

                <input type="submit" value="<?= $lang['contact_form_send_btn'] ?? 'Send' ?>" class="btns solid">
              </form>

              <div class="contact-info-panel">
                <h2 class="title"><?= $lang['contact_info_title'] ?? 'Our Information' ?></h2>
                <div class="info-item">
                  <i class='bx bxs-map-pin'></i>
                  <p>
                    <?php
                    if ($current_lang == 'ar' && !empty($contact['address_ar'])) {
                      echo htmlspecialchars($contact['address_ar']);
                    } else {
                      echo htmlspecialchars($contact['address'] ?? 'Address not available');
                    }
                    ?>
                  </p>
                </div>
                <div class="info-item">
                  <i class='bx bxs-phone-call'></i>
                  <p><?= htmlspecialchars($contact['phone'] ?? 'Phone not available') ?></p>
                </div>
                <div class="info-item">
                  <i class='bx bxs-paper-plane'></i>
                  <p><?= htmlspecialchars($contact['email'] ?? 'Email not available') ?></p>
                </div>
                <div class="info-social-links">
                  <?php if (!empty($contact['whatsapp_number'])): ?>
                    <a href="https://wa.me/<?= htmlspecialchars(preg_replace('/[^0-9]/', '', $contact['whatsapp_number'])) ?>" target="_blank" class="social-icon"><i class="bx bxl-whatsapp"></i></a>
                  <?php endif; ?>

                  <?php if (!empty($contact['fb_link'])): ?>
                    <a href="<?= htmlspecialchars($contact['fb_link']) ?>" target="_blank" class="social-icon"><i class="bx bxl-facebook"></i></a>
                  <?php endif; ?>

                  <?php if (!empty($contact['instagram_link'])): ?>
                    <a href="<?= htmlspecialchars($contact['instagram_link']) ?>" target="_blank" class="social-icon"><i class="bx bxl-instagram"></i></a>
                  <?php endif; ?>

                  <?php if (!empty($contact['linkedin_link'])): ?>
                    <a href="<?= htmlspecialchars($contact['linkedin_link']) ?>" target="_blank" class="social-icon"><i class="bx bxl-linkedin"></i></a>
                  <?php endif; ?>
                </div>
              </div>

            </div>
          </div>

          <div class="panels-container">
            <div class="panel left-panel">
              <div class="content">
                <h3><?= $lang['contact_panel_details_title'] ?? 'Contact Details' ?></h3>
                <p><?= $lang['contact_panel_details_desc'] ?? 'Need our address or phone number? Find all of our contact information here.' ?></p>
                <button class="btns transparent" id="show-info-btn"><?= $lang['contact_panel_show_info_btn'] ?? 'Show Info' ?></button>
              </div>
              <img src="assets/img/contact/info.png" class="image" alt="Contact Info Illustration">
            </div>

            <div class="panel right-panel">
              <div class="content">
                <h3><?= $lang['contact_panel_question_title'] ?? 'Have a Question?' ?></h3>
                <p><?= $lang['contact_panel_question_desc'] ?? 'Fill out our contact form and our team will get back to you as soon as possible.' ?></p>
                <button class="btns transparent" id="show-form-btn"><?= $lang['contact_panel_message_us_btn'] ?? 'Message Us' ?></button>
              </div>
              <img src="assets/img/contact/form.png" class="image" alt="Contact Form Illustration">
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php include 'partials/footer.php'; ?>

  </main>

  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>
  <script>
    
  </script>
</body>


</html>