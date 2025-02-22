<?php
session_start();
require '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_SESSION['id_user'];
    $username = $_POST['username'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $no_telp = $_POST['no_telp'];

    // Handle file upload
    $targetDir = "../assets/images/";
    $fileName = basename($_FILES["profile_picture"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Jika user mengupload gambar baru
    if(!empty($_FILES["profile_picture"]["name"])) {
        // Validasi file
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];
        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        
        if($check === false) {
            $_SESSION['error'] = "File yang diupload bukan gambar";
            header("Location: profile.php");
            exit;
        }
        
        if(!in_array($fileType, $allowedTypes)) {
            $_SESSION['error'] = "Hanya file JPG, JPEG, PNG & GIF yang diizinkan";
            header("Location: profile.php");
            exit;
        }

        // Generate unique filename
        $newFileName = uniqid() . "." . $fileType;
        $targetFilePath = $targetDir . $newFileName;

        // Upload file ke server
        if(move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFilePath)) {
            $profile_picture = $newFileName;
        } else {
            $_SESSION['error'] = "Gagal mengupload gambar";
            header("Location: profile.php");
            exit;
        }
    } else {
        // Jika tidak upload gambar baru, gunakan yang lama
        $stmt = $conn->prepare("SELECT profile_picture FROM user WHERE id_user = ?");
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $profile_picture = $user['profile_picture'];
    }

    // Update data profil
    $stmt = $conn->prepare("UPDATE user SET username = ?, profile_picture = ?, nama_lengkap = ?, no_telp = ? WHERE id_user = ?");
    $stmt->bind_param("ssssi", $username, $profile_picture, $nama_lengkap, $no_telp, $id_user);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Profil berhasil diperbarui!";
    } else {
        $_SESSION['error'] = "Gagal memperbarui profil: " . $conn->error;
    }

    header("Location: profile.php");
    exit;
}
?>