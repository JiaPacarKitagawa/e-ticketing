<?php
session_start();
require '../../koneksi.php';

// Cek apakah id_user telah diberikan melalui parameter GET


$id_user = $_GET['id_user'];

// Persiapkan statement untuk menghapus user
$stmt = $conn->prepare("DELETE FROM user WHERE id_user = ?");
$stmt->bind_param("i", $id_user);

if ($stmt->execute()) {
    $_SESSION['success'] = "User berhasil dihapus.";
} else {
    $_SESSION['error'] = "Gagal menghapus user: " . $conn->error;
}

header("Location: ../data_user.php");
exit;
?>
