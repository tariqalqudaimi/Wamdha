<?php
// manage_news.php

require_once "../UserSetting/user_auth.php";
require_once '../Database/db.php';

// --- منطق إضافة خبر جديد ---
if (isset($_POST['add_news'])) {
    $title_en = $_POST['title_en'];
    $title_ar = $_POST['title_ar'];
    $details_en = $_POST['details_en'];
    $details_ar = $_POST['details_ar'];
    $publication_date = $_POST['publication_date'];
    $status = $_POST['status'];
    $link = $_POST['link'];

    // التعامل مع رفع الصورة
    $image_name = "default_news.png"; // صورة افتراضية
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../../assets/img/news/";
        $file_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_name = "news-" . time() . "." . $file_ext;
        move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $image_name);
    }

    $stmt = $dbcon->prepare("INSERT INTO news (title_en, title_ar, details_en, details_ar, image, publication_date, status, link) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $title_en, $title_ar, $details_en, $details_ar, $image_name, $publication_date, $status, $link);
    $stmt->execute();
    $stmt->close();
    header('Location: manage_news.php');
    exit();
}

// --- منطق حذف خبر ---
if (isset($_GET['delete_id'])) {
    $id = (int)$_GET['delete_id'];
    // أولاً، احصل على اسم ملف الصورة لحذفه من السيرفر
    $stmt_img = $dbcon->prepare("SELECT image FROM news WHERE id = ?");
    $stmt_img->bind_param("i", $id);
    $stmt_img->execute();
    $image_to_delete = $stmt_img->get_result()->fetch_assoc()['image'];
    $stmt_img->close();

    // حذف الصورة من السيرفر إذا لم تكن الصورة الافتراضية
    if ($image_to_delete != 'default_news.png') {
        $filepath = '../../assets/img/news/' . $image_to_delete;
        if (file_exists($filepath)) {
            unlink($filepath);
        }
    }

    // حذف السجل من قاعدة البيانات
    $stmt_delete = $dbcon->prepare("DELETE FROM news WHERE id = ?");
    $stmt_delete->bind_param("i", $id);
    $stmt_delete->execute();
    $stmt_delete->close();
    header('Location: manage_news.php');
    exit();
}

// جلب جميع الأخبار لعرضها في الجدول
$news_result = $dbcon->query("SELECT id, title_en, image, publication_date, status FROM news ORDER BY publication_date DESC");
$title = "Manage News";
require_once "../Dashboard/header.php";
?>

<!-- === نموذج إضافة خبر جديد === -->
<div class="card mb-4">
    <div class="card-header"><h4 class="card-title">Add New Article</h4></div>
    <div class="card-body">
        <form action="manage_news.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6"><div class="form-group"><label>Title (English)</label><input type="text" class="form-control" name="title_en" required></div></div>
                <div class="col-md-6"><div class="form-group"><label>Title (Arabic)</label><input type="text" class="form-control" name="title_ar" required></div></div>
            </div>
            <div class="row">
                <div class="col-md-6"><div class="form-group"><label>Details (English)</label><textarea class="form-control" name="details_en" rows="4" required></textarea></div></div>
                <div class="col-md-6"><div class="form-group"><label>Details (Arabic)</label><textarea class="form-control" name="details_ar" rows="4" required></textarea></div></div>
            </div>
            <div class="row">
                <div class="col-md-4"><div class="form-group"><label>Publication Date</label><input type="date" class="form-control" name="publication_date" value="<?= date('Y-m-d') ?>" required></div></div>
                <div class="col-md-4"><div class="form-group"><label>Status</label><select name="status" class="form-control"><option value="published">Published</option><option value="draft" selected>Draft</option><option value="archived">Archived</option></select></div></div>
                 <div class="col-md-4"><div class="form-group"><label>External Link (Optional)</label><input type="url" class="form-control" name="link" placeholder="https://example.com"></div></div>
            </div>
            <div class="form-group"><label>Image</label><input type="file" class="form-control-file" name="image" required></div>
            <button type="submit" name="add_news" class="btn btn-primary">Add News</button>
        </form>
    </div>
</div>

<!-- === جدول الأخبار الموجودة === -->
<div class="card">
    <div class="card-header"><h4 class="card-title">Existing News Articles</h4></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead><tr><th>Image</th><th>Title (English)</th><th>Publication Date</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    <?php foreach ($news_result as $news) : ?>
                        <tr>
                            <td><img src="../../assets/img/news/<?= htmlspecialchars($news['image']) ?>" alt="" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;"></td>
                            <td><?= htmlspecialchars($news['title_en']) ?></td>
                            <td><?= htmlspecialchars($news['publication_date']) ?></td>
                            <td><span class="badge badge-<?= $news['status'] == 'published' ? 'success' : ($news['status'] == 'draft' ? 'warning' : 'secondary') ?>"><?= ucfirst($news['status']) ?></span></td>
                            <td>
                                <a href="news_edit.php?id=<?= $news['id'] ?>" class="btn btn-sm btn-info">Edit</a>
                                <a href="manage_news.php?delete_id=<?= $news['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure? This action cannot be undone.');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once "../Dashboard/footer.php";
?>