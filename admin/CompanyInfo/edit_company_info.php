<?php
require_once "../UserSetting/user_auth.php";
$title = "Edit Company Information";
require_once "../Dashboard/header.php";
require_once '../Database/db.php';
$data_from_db = $dbcon->query("SELECT * FROM company_settings WHERE id=1");
$settings = $data_from_db->fetch_assoc();
?>
<div class="card">
    <div class="card-header bg-success text-center">
        <h2>Edit Website Content & Settings</h2>
    </div>
    <div class="card-body">
        <?php if (isset($_SESSION['update_success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['update_success'] ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php unset($_SESSION['update_success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['update_error'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['update_error'] ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php unset($_SESSION['update_error']); ?>
        <?php endif; ?>

        <form action="update_company_info.php" method="post" enctype="multipart/form-data">
            <h4>General Settings</h4>
            <div class="form-group">
                <label>Company Name</label>
                <input type="text" class="form-control" name="company_name" value="<?= htmlspecialchars($settings['company_name'] ?? '') ?>">
                  <label>Company Name Arabic</label>
                <input type="text" class="form-control" name="company_name_ar" value="<?= htmlspecialchars($settings['company_name_ar'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Company Logo</label>
                <input type="file" class="form-control-file" name="company_logo">
                <small>Current: <img src="../../assets/img/CompanyInfo/<?= htmlspecialchars($settings['company_logo']) ?>" alt="logo" style="height: 30px; background: #eee; padding: 2px; border-radius: 3px;"></small>
            </div>
            <hr>
            <!-- Hero Section -->
            <h4>Hero Section</h4>
            <div class="form-group"><label>Hero Title</label><input type="text" class="form-control" name="hero_title" value="<?= htmlspecialchars($settings['hero_title'] ?? '') ?>"></div>
            <div class="form-group"><label>Hero Title Arabic</label><input type="text" class="form-control" name="hero_title_ar" value="<?= htmlspecialchars($settings['hero_title_ar'] ?? '') ?>"></div>
            <div class="form-group"><label>Hero Subtitle </label><textarea name="hero_subtitle" class="form-control"><?= htmlspecialchars($settings['hero_subtitle'] ?? '') ?></textarea></div>
            <div class="form-group"><label>Hero Subtitle Arabic</label><textarea name="hero_subtitle_ar" class="form-control"><?= htmlspecialchars($settings['hero_subtitle_ar'] ?? '') ?></textarea></div>
            <hr>

            <div class="form-group"><input class="btn btn-block btn-success" type="submit" value="Save All Changes" name="submit"></div>

        </form>
    </div>
</div>
<?php require_once "../Dashboard/footer.php"; ?>