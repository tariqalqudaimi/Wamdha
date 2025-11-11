-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping structure for table wamdha.about_sections
CREATE TABLE IF NOT EXISTS `about_sections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `section_key` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `title_ar` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `details` text COLLATE utf8mb4_general_ci,
  `details_ar` text COLLATE utf8mb4_general_ci,
  `icon_class` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `section_key` (`section_key`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wamdha.about_sections: ~5 rows (approximately)
INSERT INTO `about_sections` (`id`, `section_key`, `title`, `title_ar`, `details`, `details_ar`, `icon_class`) VALUES
	(1, 'main_description', 'Main Description', 'الوصف الرئيسي', '<p>We are a leading company in providing innovative technological solutions aimed at enhancing businesses and achieving success for our clients. Our team of experts is committed to delivering the best services in software development, design, digital marketing, and content creation.</p>', '<p>نحن شركة رائدة في تقديم حلول تكنولوجية مبتكرة تهدف إلى تعزيز الأعمال وتحقيق النجاح لعملائنا. فريقنا من الخبراء ملتزم بتقديم أفضل الخدمات في مجالات تطوير البرمجيات، التصميم، التسويق الرقمي، وصناعة المحتوى.</p>', NULL),
	(2, NULL, 'Our Company', 'شركتنا', '<p>We are a technology company specialized in providing innovative and reliable software solutions that help individuals and organizations keep up with digital transformation and achieve their goals more efficiently. We focus on simplifying complexity through technology via our diverse services in website and application development, artificial intelligence solutions, and digital transformation.</p>', '<p>نحن شركة تقنية متخصصة في تقديم حلول برمجية مبتكرة وموثوقة تساعد الأفراد والمؤسسات على مواكبة التحول الرقمي وتحقيق أهدافهم بكفاءة أعلى. نركز على تبسيط التعقيد من خلال التكنولوجيا عبر خدماتنا المتنوعة في تطوير المواقع والتطبيقات، حلول الذكاء الاصطناعي، والتحول الرقمي.</p>', 'bx bx-buildings'),
	(3, NULL, 'Our Goals', 'أهدافنا', '<ul>\r\n<li><strong>Achievement</strong><br />We are one team with a constant drive to win; nothing stands between us and our goals, and our interactions are characterized by humility and respect.</li>\r\n<li><strong>Excellence</strong><br />We do not settle for what we have achieved. We celebrate our success, but we strive for excellence and mastery and lead change with all our strength.</li>\r\n<li><strong>Innovation</strong><br />We change the rules of the game and think creatively about how to change the present, so we can keep up with the world in technology and focus on ideas that will put us at the top.</li>\r\n<li><strong>Providing professional and innovative software solutions</strong><br />We strive to provide high-quality software services that meet clients needs and contribute to the development of their businesses through customized and effective technical solutions.</li>\r\n<li><strong>Achieving customer satisfaction</strong><br />We are committed to providing an exceptional experience for our clients by carefully listening to their needs, providing continuous support, and ensuring the highest levels of satisfaction.</li>\r\n<li><strong>Continuous innovation</strong><br />We are keen to keep up with the latest technologies and best practices in software development to ensure the delivery of advanced and modern solutions.</li>\r\n<li><strong>Enhancing operational efficiency for businesses</strong><br />We help organizations improve their performance and reduce costs by developing intelligent and secure systems that contribute to automating processes and improving resource management.</li>\r\n<li><strong>Building a professional and distinguished team</strong><br />We aim to attract and develop a select group of highly skilled engineers and programmers, and empower them to innovate and create in a professional work environment.</li>\r\n<li><strong>Expanding into local and regional markets</strong><br />We plan to expand the scope of our services to include various sectors and markets in the region, and strengthen our position as a trusted technical partner.</li>\r\n</ul>', '<ul>\r\n<li><strong>الإنجاز</strong><br />نحن فريق واحد لديه دافع دائم للفوز، لا شيء يقف بيننا وبين أهدافنا، وتتسم تعاملاتنا بالتواضع والاحترام.</li>\r\n<li><strong>التميز</strong><br />نحن لا نكتفي بما حققناه. نحتفل بنجاحنا ولكننا نسعى للتميز والإتقان ونقود التغيير بكل قوتنا.</li>\r\n<li><strong>الابتكار</strong><br />نحن نغير قواعد اللعبة ونفكر بطريقة إبداعية في كيفية تغيير الحاضر. لكي نواكب العالم في التكنولوجيا ونركز على الأفكار التي ستضعنا على القمة.</li>\r\n<li><strong>تقديم حلول برمجية احترافية ومبتكرة</strong><br />نسعى لتقديم خدمات برمجية عالية الجودة تلبي احتياجات العملاء، وتساهم في تطوير أعمالهم من خلال حلول تقنية مخصصة وفعالة.</li>\r\n<li><strong>تحقيق رضا العملاء</strong><br />نلتزم بتقديم تجربة مميزة لعملائنا عبر الاستماع الدقيق لاحتياجاتهم، وتوفير الدعم المستمر، وضمان أعلى مستويات الرضا.</li>\r\n<li><strong>الابتكار المستمر</strong><br />نحرص على مواكبة أحدث التقنيات وأفضل الممارسات في مجال تطوير البرمجيات لضمان تقديم حلول متطورة وعصرية.</li>\r\n<li><strong>تعزيز الكفاءة التشغيلية للشركات</strong><br />نساعد المؤسسات على تحسين أدائها، وتقليل التكاليف عبر تطوير أنظمة ذكية وآمنة تسهم في أتمتة العمليات وتحسين إدارة الموارد.</li>\r\n<li><strong>بناء فريق عمل محترف ومتميز</strong><br />نهدف إلى استقطاب وتطوير نخبة من المهندسين والمبرمجين ذوي الكفاءة العالية، وتمكينهم من الابتكار والإبداع في بيئة عمل احترافية.</li>\r\n<li><strong>التوسع في الأسواق المحلية والإقليمية</strong><br />نخطط لتوسيع نطاق خدماتنا لتشمل مختلف القطاعات والأسواق في المنطقة، وتعزيز مكانتنا كشريك تقني موثوق.</li>\r\n</ul>', 'bx bx-target-lock'),
	(4, NULL, 'Our Mission', 'رسالتنا', '<p>Our mission is to empower individuals and organizations to maximize the benefits of technology by providing innovative and reliable software solutions that contribute to improving operational efficiency, enhancing competitiveness, and supporting the digital transformation journey of society and businesses.</p>', '<p>رسالتنا هي تمكين الأفراد والمؤسسات من الاستفادة القصوى من التكنولوجيا عبر تقديم حلول برمجية مبتكرة وموثوقة، تسهم في رفع الكفاءة التشغيلية، وتعزيز القدرة التنافسية، ودعم رحلة التحول الرقمي للمجتمع والأعمال.</p>', 'bx bx-rocket'),
	(5, NULL, 'Our Vision', 'رؤيتنا', '<p>To be the first and preferred technical partner in the region for providing integrated software solutions, through continuous innovation, high quality, and dedication to meeting the needs of our clients, and making an effective contribution to the digital transformation of institutions of all sizes.</p>', '<p>أن نكون الشريك التقني الأول والمفضل في المنطقة لتقديم الحلول البرمجية المتكاملة، من خلال الابتكار المستمر، والجودة العالية، والتفاني في تلبية احتياجات عملائنا، والمساهمة الفعّالة في التحول الرقمي للمؤسسات بمختلف أحجامها.</p>', 'bx bx-show');

-- Dumping structure for table wamdha.company_settings
CREATE TABLE IF NOT EXISTS `company_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'wamdha',
  `company_name_ar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'ومضة',
  `company_logo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'assets/img/logo.png',
  `hero_title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'Better Digital Experience With Techie',
  `hero_title_ar` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `hero_subtitle` text COLLATE utf8mb4_general_ci,
  `hero_subtitle_ar` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wamdha.company_settings: ~1 rows (approximately)
INSERT INTO `company_settings` (`id`, `company_name`, `company_name_ar`, `company_logo`, `hero_title`, `hero_title_ar`, `hero_subtitle`, `hero_subtitle_ar`) VALUES
	(1, 'wamdha', 'ومضة', 'logo_1762617228.png', 'From the spark of the idea.. to the reality of achievement.', 'من شرارة الفكرة.. إلى واقع الإنجاز.', 'eferferf', 'ثصنقمثصن');

-- Dumping structure for table wamdha.contact_information
CREATE TABLE IF NOT EXISTS `contact_information` (
  `id` int NOT NULL AUTO_INCREMENT,
  `address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'A108 Adam Street, New York, NY 535022',
  `address_ar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'contact@example.com',
  `phone` varchar(50) COLLATE utf8mb4_general_ci DEFAULT '+1 5589 55488 55',
  `fb_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `whatsapp_number` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `instagram_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `linkedin_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `footer_description` text COLLATE utf8mb4_general_ci,
  `footer_description_ar` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wamdha.contact_information: ~1 rows (approximately)
INSERT INTO `contact_information` (`id`, `address`, `address_ar`, `email`, `phone`, `fb_link`, `whatsapp_number`, `instagram_link`, `linkedin_link`, `footer_description`, `footer_description_ar`) VALUES
	(1, 'Sana\'a, Yemen', 'اليمن،صنعاء ', 'info@wamdhatech.com', '779602945', 'https://www.facebook.com/wamdhatech', '+967779602945', 'https://www.instagram.com/wamdhtech/', 'https://www.linkedin.com/company/wamdhatech/', 'We create an idea...for a better tomorrow', 'نصنع فكرة ...لغدًا افضل');

-- Dumping structure for table wamdha.contact_messages
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `received_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wamdha.contact_messages: ~4 rows (approximately)
INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `status`, `received_at`) VALUES
	(1, 'Malik Niyaz', 'mniaz1096@gmail.com', 'd', 'acsac', 1, '2025-08-10 10:41:27'),
	(2, 'Malik Niyaz', 'mniaz1096@gmail.com', 'fff', 'sadsadasda', 1, '2025-08-18 12:15:49'),
	(3, 'tariq mohammed', 'tariqalqudaimi@gmail.com.com', 'jhkjhkjhkhhkkl', 'jjkjljlkj', 1, '2025-08-23 20:45:22'),
	(4, 'renad', 'wuyffydcdop@gmail.com', 'ro7f578658', '[p5ui]987t', 1, '2025-09-08 18:11:33');

-- Dumping structure for table wamdha.features
CREATE TABLE IF NOT EXISTS `features` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title_en` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `title_ar` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description_en` text COLLATE utf8mb4_general_ci NOT NULL,
  `description_ar` text COLLATE utf8mb4_general_ci NOT NULL,
  `icon_class` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `display_order` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wamdha.features: ~4 rows (approximately)
INSERT INTO `features` (`id`, `title_en`, `title_ar`, `description_en`, `description_ar`, `icon_class`, `display_order`) VALUES
	(1, 'Clean & Scalable Code', 'كود نظيف وقابل للتطوير', 'We write high-quality, documented code that grows with your business, ensuring long-term performance and easy maintenance.', 'نكتب كودًا عالي الجودة وموثقًا ينمو مع أعمالك، مما يضمن أداءً طويل الأمد وسهولة في الصيانة والتطوير.', 'bx bx-code-alt', 1),
	(2, 'Agile Development & UI/UX', 'تطوير مرن وتصميم يركز على المستخدم', 'Our agile approach and focus on user experience (UI/UX) ensure your product is not only functional but also intuitive and loved by users.', 'منهجيتنا المرنة وتركيزنا على تجربة المستخدم (UI/UX) يضمن أن يكون منتجك فعالاً وسهل الاستخدام ومحبوبًا من قبل المستخدمين.', 'bx bx-rocket', 2),
	(3, 'Modern Tech Stack', 'تقنيات حديثة ومتطورة', 'We leverage the latest and most reliable technologies to build secure, fast, and future-proof applications for you.', 'نحن نستفيد من أحدث التقنيات وأكثرها موثوقية لبناء تطبيقات آمنة وسريعة ومستقبلية لك.', 'bx bx-layer', 3),
	(5, 'Ongoing Support & Maintenance', 'دعم وصيانة مستمرة', 'Our partnership doesn’t end at launch. We provide continuous support and maintenance to keep your application running smoothly.', 'شراكتنا لا تنتهي عند إطلاق المشروع. نقدم دعمًا وصيانة مستمرة للحفاظ على تشغيل تطبيقك بسلاسة وكفاءة.', 'bx bx-calendar', 0);

-- Dumping structure for table wamdha.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'default.png',
  `details_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `description_ar` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wamdha.products: ~5 rows (approximately)
INSERT INTO `products` (`id`, `name`, `name_ar`, `image`, `details_url`, `description`, `description_ar`) VALUES
	(12, 'WAMDHA', 'ومضة', 'product_1761429843.png', '', 'd', 'ب'),
	(14, 'MESHINA', NULL, 'product_1758192480.jpg', 'https://aistudio.google.com', NULL, NULL),
	(15, 'WAMDHA', NULL, 'product_1758192532.jpg', '', NULL, NULL),
	(16, 'MESHINA', NULL, 'product_1758192575.jpg', 'https://aistudio.google.com', NULL, NULL),
	(17, 'spico', 'سبيكو', 'product_1761432039.jpeg', 'https://aistudio.google.com', '', '');

-- Dumping structure for table wamdha.product_categories
CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `filter_tag` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'e.g., filter-pipes, filter-fittings',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wamdha.product_categories: ~4 rows (approximately)
INSERT INTO `product_categories` (`id`, `name`, `filter_tag`) VALUES
	(7, 'Cloud-Based Solutions', 'filter--loud-ased-olutions'),
	(8, 'Desktop Applications', 'filter--esktop-pplications'),
	(9, 'Mobile Applications', 'filter--obile-pplications'),
	(10, 'Web Applications', 'filter--eb-pplications');

-- Dumping structure for table wamdha.product_category_map
CREATE TABLE IF NOT EXISTS `product_category_map` (
  `product_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `product_category_map_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_category_map_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wamdha.product_category_map: ~7 rows (approximately)
INSERT INTO `product_category_map` (`product_id`, `category_id`) VALUES
	(14, 9),
	(15, 9),
	(16, 9),
	(12, 10),
	(14, 10),
	(15, 10),
	(17, 10);

-- Dumping structure for table wamdha.product_images
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `image_filename` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_id` (`product_id`),
  CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wamdha.product_images: ~4 rows (approximately)
INSERT INTO `product_images` (`id`, `product_id`, `image_filename`) VALUES
	(5, 12, 'prod_add_12_1761430441_0.png'),
	(6, 17, 'prod_add_17_1761432039_0.jpeg'),
	(7, 17, 'prod_add_17_1761432039_1.jpeg'),
	(8, 17, 'prod_add_17_1761432039_2.jpeg');

-- Dumping structure for table wamdha.services
CREATE TABLE IF NOT EXISTS `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `box_color_class` varchar(100) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'e.g., iconbox-blue',
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `title_ar` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `description_ar` text COLLATE utf8mb4_general_ci NOT NULL,
  `image_file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wamdha.services: ~3 rows (approximately)
INSERT INTO `services` (`id`, `box_color_class`, `title`, `title_ar`, `description`, `description_ar`, `image_file`) VALUES
	(9, 'iconbox-blue', 'Mobile App Development', 'تطوير التطبيقات المحمولة', 'Our mobile app development expertise extends to iOS and Android platforms. We turn your app ideas into reality, ensuring seamless user experiences that\r\nkeep your audience engaged and satisfied.', 'تتمتع خبرتنا في تطوير التطبيقات المحمولة بالتوسع إلى منصات iOS و Android. نحول أفكار تطبيقاتك إلى واقع، مع ضمان تجارب مستخدم سلسة تحافظ على انخراط جمهورك ورضاه.', 'service-1755980462.png'),
	(10, 'iconbox-blue', 'Web Development', 'تطوير الويب', ' web development services are all about building stunning, user-centric websites. From e-commerce platforms to corporate sites, we create web solutions that captivate your audience and drive results.', 'تتعلق خدمات تطوير الويب في بناء مواقع ويب مذهلة وموجهة للمستخدمين. من منصات التجارة الإلكترونية إلى المواقع الشركية، نقوم بإنشاء حلول ويب تجذب جمهورك وتحقق النتائج.', 'service-1755980452.png'),
	(11, 'iconbox-blue', 'Custom Software Development', 'تطوير البرمجيات المخصصة', 'specializes in crafting custom software solutions tailored to your business needs. Whether it\'s an ERP system, a CMS, or powerful dashboards, our experts create software that aligns with your unique vision.', 'تخصص إنفوسبارك في صياغة حلول برمجية مخصصة تتناسب مع احتياجات عملك. سواء كانت نظام ERP أو نظام إدارة المحتوى أو لوحات القيادة القوية، يقوم خبراؤنا بإنشاء برمجيات تتوافق مع رؤيتك الفريدة.', 'service-1758190852.png');

-- Dumping structure for table wamdha.team_members
CREATE TABLE IF NOT EXISTS `team_members` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image_file` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `website_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `facebook_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `instagram_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `linkedin_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `display_order` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wamdha.team_members: ~5 rows (approximately)
INSERT INTO `team_members` (`id`, `name`, `position`, `image_file`, `website_url`, `facebook_url`, `instagram_url`, `linkedin_url`, `display_order`) VALUES
	(13, 'Tariq Alqudaimi', 'Full-Stack Software Developer', 'team_updated_1761816699.PNG', 'https://tariqalqudaimi.wamdhatech.com/', 'https://www.facebook.com/share/1CRfqGNEJT/', 'https://www.instagram.com/kb_0k?igsh=OGMycmljb2RjZTRv', 'https://www.linkedin.com/in/tariq-mohammed-252bab31b?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app', 0),
	(14, 'Malik Niaz', 'CEO', 'team_1758193321.jpg', 'http://malik-niyaz.wamdhatech.com', 'https://www.facebook.com/malek.niaz', 'https://www.instagram.com/malik_ni3/', 'https://www.linkedin.com/in/malik-niyaz', 0),
	(15, 'Hasan Fuaad', 'IT Engineer – DevOps & QA Focus', 'team_1758193427.jpg', 'https://hasan-fuaad.vercel.app/', 'https://www.facebook.com/share/17LT3yaQj9/', 'https://www.instagram.com/hasan_fuaad?igsh=ZXF5b3hjbTMwcmh1', 'https://www.linkedin.com/in/hasan-fuaad-3591a918b', 0),
	(16, 'Osama Alhakimi', 'System & Application Developer', 'team_1758195207.jpg', '', 'https://www.facebook.com/share/19xZupMhd7/', 'https://www.instagram.com/hakimi.osama24?igsh=MTY1dmNlenh1ZGFibA==', 'https://www.linkedin.com/in/osama-al-hakimi?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app', 0),
	(17, 'Mِِajd Tawfiq', 'Finance and Marketing Director', 'team_1761146658.jpg', 'https://majd-tawfiq.wamdhatech.com/', 'https://www.facebook.com/share/199tM8yL52/?mibextid=wwXIfr', 'https://www.instagram.com/majdtawfiq/', '', 0);

-- Dumping structure for table wamdha.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'default.png',
  `status` int NOT NULL DEFAULT '1' COMMENT '1=deactive, 2=active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table wamdha.users: ~5 rows (approximately)
INSERT INTO `users` (`id`, `fname`, `email`, `password`, `photo`, `status`) VALUES
	(1, 'malik', 'm@gmail.com', 'Malik@123', 'default.png', 1),
	(2, 'malik', 's@gmail.com', '$2y$10$A4fHKceauAKhNJ3lRTT0MurK7PHlQhJr7XTdoXlVaNy3Aa0HrnhQO', 'default.png', 2),
	(3, 'tariq', 'tariqalqudaimi@gmail.com.com', '$2y$10$pbNLEyJ1eEP8lac/cUrFRulTVZ.BVqxpG29gieuu7kKdDS9GIKB.C', 'default.png', 2),
	(4, 'Majd Tawfiq', 'majdtawfiq@icloud.com', '$2y$10$kkIwf0JYp06KSaaeumtEHO3ibZO/eOu5rnL.RmsQnWG8v722lasei', '4.jpg', 2),
	(5, 'Hasan Fuaad Hasan AbdulrazzaK', 'hasan.fuaad02@gmail.com', '$2y$10$EB38Dfj8Kbnbw5ffXzdWpe5Sott3Oc1yCZNfgsqBKZpjS16DBX0tW', '5.jpg', 2);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
