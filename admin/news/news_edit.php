<?php
// news_edit.php

require_once "../UserSetting/user_auth.php";
require_once '../Database/db.php';
ob_start();

// --- منطق تحديث الخبر ---
if (isset($_POST['update_news'])) {
    $id = (int)$_POST['id'];
    $title_en = $_POST['title_en'];
    $title_ar = $_POST['title_ar'];
    $details_en = $_POST['details_en'];
    $details_ar = $_POST['details_ar'];
    $publication_date = $_POST['publication_date'];
    $status = $_POST['status'];
    $link = $_POST['link'];

    // الحصول على اسم الصورة الحالية
    $stmt_img = $dbcon->prepare("SELECT image FROM news WHERE id = ?");
    $stmt_img->bind_param("i", $id);
    $stmt_img->execute();
    $current_image = $stmt_img->get_result()->fetch_assoc()['image'];
    $stmt_img->close();

    $new_image_name = $current_image; // القيمة الافتراضية

    // التحقق من رفع صورة جديدة
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // حذف الصورة القديمة
        if ($current_image != 'default_news.png') {
            $old_filepath = '../../assets/img/news/' . $current_image;
            if (file_exists($old_filepath)) {
                unlink($old_filepath);
            }
        }
        // رفع الصورة الجديدة
        $target_dir = "../../assets/img/news/";
        $file_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $new_image_name = "news-" . time() . "." . $file_ext;
        move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $new_image_name);
    }

    // تحديث قاعدة البيانات
    $stmt_update = $dbcon->prepare("UPDATE news SET title_en = ?, title_ar = ?, details_en = ?, details_ar = ?, image = ?, publication_date = ?, status = ?, link = ? WHERE id = ?");
    $stmt_update->bind_param("ssssssssi", $title_en, $title_ar, $details_en, $details_ar, $new_image_name, $publication_date, $status, $link, $id);
    $stmt_update->execute();
    $stmt_update->close();

    header('Location: manage_news.php');
    exit();
}

// --- جلب بيانات الخبر للتعديل ---
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: manage_news.php');
    exit();
}
$id_to_edit = (int)$_GET['id'];

$stmt = $dbcon->prepare("SELECT * FROM news WHERE id = ?");
$stmt->bind_param("i", $id_to_edit);
$stmt->execute();
$result = $stmt->get_result();
$news = $result->fetch_assoc();
$stmt->close();

if (!$news) {
    header('Location: manage_news.php');
    exit();
}

$title = "Edit News Article";
require_once "../Dashboard/header.php";
?>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit Article: <?= htmlspecialchars($news['title_en']) ?></h4>
    </div>
    <div class="card-body">
        <form action="news_edit.php?id=<?= $id_to_edit ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id_to_edit ?>">

            <div class="row">
                <div class="col-md-6"><div class="form-group"><label>Title (English)</label><input type="text" class="form-control" name="title_en" value="<?= htmlspecialchars($news['title_en']) ?>" required></div></div>
                <div class="col-md-6"><div class="form-group"><label>Title (Arabic)</label><input type="text" class="form-control" name="title_ar" value="<?= htmlspecialchars($news['title_ar']) ?>" required></div></div>
            </div>
            <div class="row">
                <div class="col-md-6"><div class="form-group"><label>Details (English)</label><textarea class="form-control" name="details_en" rows="4" required><?= htmlspecialchars($news['details_en']) ?></textarea></div></div>
                <div class="col-md-6"><div class="form-group"><label>Details (Arabic)</label><textarea class="form-control" name="details_ar" rows="4" required><?= htmlspecialchars($news['details_ar']) ?></textarea></div></div>
            </div>
             <div class="row">
                <div class="col-md-4"><div class="form-group"><label>Publication Date</label><input type="date" class="form-control" name="publication_date" value="<?= htmlspecialchars($news['publication_date']) ?>" required></div></div>
                <div class="col-md-4"><div class="form-group"><label>Status</label><select name="status" class="form-control">
                    <option value="published" <?= $news['status'] == 'published' ? 'selected' : '' ?>>Published</option>
                    <option value="draft" <?= $news['status'] == 'draft' ? 'selected' : '' ?>>Draft</option>
                    <option value="archived" <?= $news['status'] == 'archived' ? 'selected' : '' ?>>Archived</option>
                </select></div></div>
                 <div class="col-md-4"><div class="form-group"><label>External Link (Optional)</label><input type="url" class="form-control" name="link" value="<?= htmlspecialchars($news['link']) ?>" placeholder="https://example.com"></div></div>
            </div>
            <div class="form-group">
                <label>Current Image</label>
                <div><img src="../../assets/img/news/<?= htmlspecialchars($news['image']) ?>" alt="Current Image" style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px; margin-bottom: 10px;"></div>
                <label>Upload New Image (Optional)</label>
                <input type="file" class="form-control-file" name="image">
                <small class="form-text text-muted">Leave blank to keep the current image.</small>
            </div>
            <hr>
            <div class="text-right">
                 <a href="manage_news.php" class="btn btn-secondary">Cancel</a>
                 <button type="submit" name="update_news" class="btn btn-success">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<?php
require_once "../Dashboard/footer.php";
?>