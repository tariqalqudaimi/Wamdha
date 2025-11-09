
<footer class="site-footer text-white pt-5 pb-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6 mb-4">
        <h5 class="footer-title"><?= htmlspecialchars($settings['company_name'] ?? 'Company Name') ?></h5>
        <p>
          <?php
            if ($current_lang == 'ar' && !empty($contact['footer_description_ar'])) {
              echo htmlspecialchars($contact['footer_description_ar']);
            } else {
              echo htmlspecialchars($contact['footer_description'] ?? 'Default footer description.');
            }
          ?>
        </p>
      </div>

      <!-- Footer Links -->
      <div class="col-lg-4 col-md-6 mb-4">
        <h5 class="footer-title"><?= $lang['footer_links'] ?? 'Quick Links' ?></h5>
        <ul class="list-unstyled">
          <li><a href="index.php?lang=<?= $current_lang ?>" class="text-white"><?= $lang['home_link'] ?></a></li>
          <li><a href="index.php#about" class="text-white"><?= $lang['about_link'] ?></a></li>
          <li><a href="index.php#services" class="text-white"><?= $lang['services_link'] ?></a></li>
          <li><a href="index.php#team" class="text-white"><?= $lang['team_link'] ?></a></li>
          <li><a href="index.php#contact" class="text-white"><?= $lang['contact_link'] ?></a></li>
        </ul>
      </div>

      <!-- Footer Contact -->
      <div class="col-lg-4 col-md-12 mb-4">
        <h5 class="footer-title"><?= $lang['contact_info_title'] ?? 'Contact Info' ?></h5>
        <p><i class='bx bxs-map-pin'></i> 
          <?php
            if ($current_lang == 'ar' && !empty($contact['address_ar'])) {
              echo htmlspecialchars($contact['address_ar']);
            } else {
              echo htmlspecialchars($contact['address'] ?? 'Address not available.');
            }
          ?>
        </p>
        <p><i class='bx bxs-phone-call'></i> <?= htmlspecialchars($contact['phone'] ?? 'Phone not available') ?></p>
        <p><i class='bx bxs-envelope'></i> <?= htmlspecialchars($contact['email'] ?? 'Email not available') ?></p>
      </div>
    </div>

    <div class="footer-bottom mt-4 text-center">
      <p class="mb-0">&copy; <?= date('Y') ?> <?= htmlspecialchars($settings['company_name'] ?? 'Company Name') ?>. <?= $lang['footer_rights'] ?? 'All Rights Reserved.' ?></p>
    </div>

  </div>
</footer>

<div class="floating-logo-animation">
    <svg width="194" height="97" viewBox="0 0 194 97" fill="none" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="light-flare" x1="0%" y1="0%" x2="100%" y2="0%">
          <stop offset="0%" stop-color="rgba(138, 79, 255, 0)" />
          <stop offset="50%" stop-color="rgba(255, 255, 255, 0.8)" />
          <stop offset="100%" stop-color="rgba(138, 79, 255, 0)" />
        </linearGradient>
      </defs>
      <path class="logo-path " d="M519.74,326.75l-88.51,166.5c-9.29,17.48-34.53,16.89-43-1l-78-164.81a24.07,24.07,0,0,0-21.75-13.77H275.23a24.07,24.07,0,0,0-21.87,34.12L387.48,639.57c8.48,18.44,34.57,18.75,43.49.52L555.28,385.78a24.07,24.07,0,0,1,21-13.49l96.43-2.61-.36.77-76.05,163c-8.6,18.44-34.79,18.54-43.54.17l-4.86-10.2c-9-18.8-35.93-18.13-43.94,1.09h0a24.07,24.07,0,0,0,.72,20.07l50.91,101.17a24.07,24.07,0,0,0,42.84.31l154.91-297.1a24.07,24.07,0,0,0-21.37-35.19L541,314A24.07,24.07,0,0,0,519.74,326.75ZM694.82,344v0h0Zm0-13.43h0Z" />
    </svg>
</div>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>