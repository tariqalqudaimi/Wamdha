<?php
require_once "../UserSetting/user_auth.php";
require_once '../Database/db.php';
ob_start();

if (isset($_POST['submit'])) {
    // UPDATED: Now saves everything from this page in one go
    $stmt = $dbcon->prepare("UPDATE contact_information SET
        address = ?,
        address_ar = ?,
        email = ?,
        phone = ?,
        fb_link = ?,
        whatsapp_number = ?,
        instagram_link = ?,
        linkedin_link = ?,
        footer_description = ?,
        footer_description_ar = ?
        WHERE id=1");

    // UPDATED: Bind all 10 parameters
    $stmt->bind_param("ssssssssss", // 10 's' characters
        $_POST['address'],
        $_POST['address_ar'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['fb_link'],
        $_POST['whatsapp_number'],
        $_POST['instagram_link'],
        $_POST['linkedin_link'],
        $_POST['footer_description'],
        $_POST['footer_description_ar']
    );

    if ($stmt->execute()) {
        $_SESSION['update_success'] = "Contact information updated successfully!";
    } else {
        $_SESSION['update_error'] = "Error updating information: " . $stmt->error;
    }

    header('Location: manage_contact.php');
    exit();
}

$contact = $dbcon->query("SELECT * FROM contact_information WHERE id=1")->fetch_assoc();

$title = "Manage Contact Page";
require_once "../Dashboard/header.php";
?>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit Contact & Footer Details</h4>
    </div>
    <div class="card-body">

        <?php if (isset($_SESSION['update_success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['update_success'] ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php unset($_SESSION['update_success']); ?>
        <?php endif; ?>

        <form action="manage_contact.php" method="post">
            <h5 class="mt-3">Primary Contact Info</h5>
            <div class="form-group">
                <label>Address (English)</label>
                <input type="text" class="form-control" name="address" value="<?= htmlspecialchars($contact['address'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Address (Arabic)</label>
                <input type="text" class="form-control" name="address_ar" value="<?= htmlspecialchars($contact['address_ar'] ?? '') ?>" dir="rtl">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($contact['email'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" class="form-control" name="phone" value="<?= htmlspecialchars($contact['phone'] ?? '') ?>">
            </div>

            <hr>
            <h5 class="mt-3">Social Media Links</h5>
            <div class="form-group">
                <label>Facebook Link</label>
                <input type="url" class="form-control" name="fb_link" value="<?= htmlspecialchars($contact['fb_link'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>WhatsApp Number</label>
                <input type="text" class="form-control" name="whatsapp_number" placeholder="e.g., +967771234567" value="<?= htmlspecialchars($contact['whatsapp_number'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Instagram Link</label>
                <input type="url" class="form-control" name="instagram_link" value="<?= htmlspecialchars($contact['instagram_link'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>LinkedIn Link</label>
                <input type="url" class="form-control" name="linkedin_link" value="<?= htmlspecialchars($contact['linkedin_link'] ?? '') ?>">
            </div>

            <hr>
            <h5 class="mt-3">Footer Description</h5>
            <div class="form-group">
                <label>Footer Description (English)</label>
                <textarea class="form-control" name="footer_description" rows="3"><?= htmlspecialchars($contact['footer_description'] ?? '') ?></textarea>
            </div>
            <div class="form-group">
                <label>Footer Description (Arabic)</label>
                <textarea class="form-control" name="footer_description_ar" rows="3" dir="rtl"><?= htmlspecialchars($contact['footer_description_ar'] ?? '') ?></textarea>
            </div>


            <button type="submit" name="submit" class="btn btn-primary mt-3">Save All Contact & Footer Info</button>
        </form>
    </div>
</div>

<?php
require_once "../Dashboard/footer.php";
?>