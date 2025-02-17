<?php
session_start();
require '../koneksi.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_SESSION['id_user'];
    $username = $_POST['username'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $no_telp = $_POST['no_telp'];

    // Update data profil
    $stmt = $conn->prepare("UPDATE user SET username = ?, nama_lengkap = ?, no_telp = ? WHERE id_user = ?");
    $stmt->bind_param("sssi", $username, $nama_lengkap, $no_telp, $id_user);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Profil berhasil diperbarui!";
    } else {
        $_SESSION['error'] = "Gagal memperbarui profil: " . $conn->error;
    }

    header("Location: profile.php");
    exit;
}