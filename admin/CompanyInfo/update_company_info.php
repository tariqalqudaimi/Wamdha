<?php
session_start();
require_once '../Database/db.php';
ob_start();

if (isset($_POST['submit'])) {

    $current_data_result = $dbcon->query("SELECT company_logo FROM company_settings WHERE id=1");
    $current_data = $current_data_result->fetch_assoc();
    $current_logo_name = $current_data['company_logo'];

    $upload_dir = "../assets/img/CompanyInfo/"; 
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    function handleUpload($file_input_name, $current_filename, $upload_dir, $prefix) {
        if (isset($_FILES[$file_input_name]) && $_FILES[$file_input_name]['error'] == 0) {
            $old_file_path = $upload_dir . $current_filename;
            if ($current_filename && $current_filename != 'default.png' && file_exists($old_file_path)) {
                unlink($old_file_path);
            }
            $file_ext = pathinfo($_FILES[$file_input_name]['name'], PATHINFO_EXTENSION);
            $new_filename = $prefix . "_" . time() . "." . $file_ext;
            move_uploaded_file($_FILES[$file_input_name]['tmp_name'], $upload_dir . $new_filename);
            return $new_filename;
        }
        return $current_filename;
    }

    $new_logo_name = handleUpload('company_logo', $current_logo_name, $upload_dir, 'logo');

    $company_name = $_POST['company_name'];
    $hero_title = $_POST['hero_title'];
    $hero_title_ar = $_POST['hero_title_ar'];
    $hero_subtitle = $_POST['hero_subtitle'];
    $hero_subtitle_ar = $_POST['hero_subtitle_ar'];
    
    $stmt = $dbcon->prepare(
        "UPDATE company_settings SET 
            company_name = ?, company_logo = ?,
            hero_title = ?, hero_title_ar = ?, hero_subtitle = ?, hero_subtitle_ar = ?
        WHERE id=1"
    );

    $stmt->bind_param(
        "ssssss", 
        $company_name, $new_logo_name,
        $hero_title, $hero_title_ar, $hero_subtitle, $hero_subtitle_ar
    );

    if ($stmt->execute()) {
        $_SESSION['update_success'] = "Website settings updated successfully!";
    } else {
        $_SESSION['update_error'] = "Error updating settings: " . $stmt->error;
    }

    header('location: edit_company_info.php');
    exit();
} else {
    header('location: ../Dashboard/index.php');
    exit();
}