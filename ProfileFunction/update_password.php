<?php
session_start();
require '../koneksi.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_SESSION['id_user'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi password
    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = "Password baru dan konfirmasi password tidak cocok!";
        header("Location: profile.php");
        exit;
    }

    // Ambil password saat ini dari database
    $stmt = $conn->prepare("SELECT password FROM user WHERE id_user = ?");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!password_verify($current_password, $user['password'])) {
        $_SESSION['error'] = "Password saat ini salah!";
        header("Location: profile.php");
        exit;
    }

    // Update password baru
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $update_stmt = $conn->prepare("UPDATE user SET password = ? WHERE id_user = ?");
    $update_stmt->bind_param("si", $hashed_password, $id_user);

    if ($update_stmt->execute()) {
        // Set flag untuk menandai bahwa password berhasil diperbarui
        $_SESSION['password_updated'] = true;
        header("Location: ../logout.php");
        exit;
    } else {
        $_SESSION['error'] = "Gagal memperbarui password: " . $conn->error;
        header("Location: profile.php");
        exit;
    }
    
}