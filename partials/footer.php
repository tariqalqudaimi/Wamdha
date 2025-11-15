<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$linkPrefix = ($currentPage === 'index.php') ? '' : 'index.php';
?>
<!-- ======= Cosmic Data Stream Footer ======= -->
<footer class="cosmic-footer">
  <!-- The Canvas for the particle animation -->


 
      <!-- Bottom Bar -->
      <div class="footer-bottom">
         <!-- The content that will float on top of the canvas -->
  <div class="footer-content-layer">
    <div class="container">
      <div class="row">
        
        <!-- Column 1: About -->
        <div class="col-lg-4 col-md-6 footer-col">
          <h5 class="footer-title"><?= htmlspecialchars($current_lang == 'en' ? ($settings['company_name'] ?? '') : ($settings['company_name_ar'] ?? '')) ?></h5>
          <p>
            <?php
              if ($current_lang == 'ar' && !empty($contact['footer_description_ar'])) {
                echo htmlspecialchars($contact['footer_description_ar']);
              } else {
                echo htmlspecialchars($contact['footer_description'] ?? 'Default footer description.');
              }
            ?>
          </p>
                    <div class="neon-social-links">
              <?php if (!empty($contact['fb_link'])): ?><a href="<?= htmlspecialchars($contact['fb_link']) ?>" class="facebook" target="_blank"><i class="bx bxl-facebook"></i></a><?php endif; ?>
              <?php if (!empty($contact['instagram_link'])): ?><a href="<?= htmlspecialchars($contact['instagram_link']) ?>" class="instagram" target="_blank"><i class="bx bxl-instagram"></i></a><?php endif; ?>
              <?php if (!empty($contact['linkedin_link'])): ?><a href="<?= htmlspecialchars($contact['linkedin_link']) ?>" class="linkedin" target="_blank"><i class="bx bxl-linkedin"></i></a><?php endif; ?>
              <?php if (!empty($contact['whatsapp_number'])): ?><a href="https://wa.me/<?= htmlspecialchars(preg_replace('/[^0-9]/', '', $contact['whatsapp_number'])) ?>" class="whatsapp" target="_blank"><i class="bx bxl-whatsapp"></i></a><?php endif; ?>
          </div>
        </div>

        <!-- Column 2: Quick Links -->
        <div class="col-lg-4 col-md-6 footer-col">
          <h5 class="footer-title "><?= $lang['footer_links'] ?? 'Quick Links' ?></h5>
          <ul class="list-unstyled footer-links-list">
            <li><a href="<?= $linkPrefix ?>#hero"><?= $lang['home_link'] ?></a></li>
            <li><a href="<?= $linkPrefix ?>#about"><?= $lang['about_link'] ?></a></li>
            <li><a href="<?= $linkPrefix ?>#services"><?= $lang['services_link'] ?></a></li>
            <li><a href="<?= $linkPrefix ?>#team"><?= $lang['team_link'] ?></a></li>
          </ul>
        </div>

        <!-- Column 3: Contact Info -->
        <div class="col-lg-4 col-md-12 footer-col">
          <h5 class="footer-title"><?= $lang['contact_info_title'] ?? 'Contact Info' ?></h5>
          <div class="footer-contact-info">
              <p><i class='bx bxs-map-pin'></i><span><?php echo ($current_lang == 'ar' && !empty($contact['address_ar'])) ? htmlspecialchars($contact['address_ar']) : htmlspecialchars($contact['address'] ?? 'Address not available.'); ?></span></p>
              <p><i class='bx bxs-phone-call'></i> <span><?= htmlspecialchars($contact['phone'] ?? 'Phone not available') ?></span></p>
              <p><i class='bx bxs-envelope'></i> <span><?= htmlspecialchars($contact['email'] ?? 'Email not available') ?></span></p>
          </div>
        </div>
      </div>


          <div class="copyright">
            &copy; <?= date('Y') ?> <strong><span><?= htmlspecialchars($current_lang == 'en' ? ($settings['company_name'] ?? '') : ($settings['company_name_ar'] ?? '')) ?></span></strong>. <?= $lang['footer_rights'] ?? 'All Rights Reserved.' ?>
          </div>
      </div>
    </div>
  </div>

  <!-- The Energy Core -->
  <div class="energy-core"></div>
</footer>