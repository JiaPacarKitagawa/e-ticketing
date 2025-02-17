<?php
session_start();
require '../../koneksi.php';

// Cek apakah id_user telah diberikan melalui parameter GET


$id_user = $_GET['id_user'];

// Ambil data user berdasarkan id_user
$stmt = $conn->prepare("SELECT * FROM user WHERE id_user = ?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    $_SESSION['error'] = "User tidak ditemukan.";
    header("Location: ../data_user.php");
    exit;
}

// Proses submit form edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $no_telp = $_POST['no_telp'];
    
    // Update data user
    $stmt = $conn->prepare("UPDATE user SET username = ?, nama_lengkap = ?, no_telp = ? WHERE id_user = ?");
    $stmt->bind_param("sssi", $username, $nama_lengkap, $no_telp, $id_user);
    if ($stmt->execute()) {
        $_SESSION['success'] = "Data user berhasil diperbarui!";
        header("Location: ../data_user.php");
        exit;
    } else {
        $_SESSION['error'] = "Gagal memperbarui data: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <!-- Back Button -->
        <a href="profile.php" class="mb-8 inline-flex items-center text-indigo-600 hover:text-indigo-800 transition-colors">
            &larr; Kembali ke Profile
        </a>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Data User</h2>
            <form method="POST" action="">
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Username</label>
                    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($user['nama_lengkap']) ?>" class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Nomor Telepon</label>
                    <input type="tel" name="no_telp" value="<?= htmlspecialchars($user['no_telp']) ?>" class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Roles</label>
                    <input type="tel" name="no_telp" value="<?= htmlspecialchars($user['no_telp']) ?>" class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all">
                </div>
                <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition-colors">
                    Update User
                </button>
            </form>
        </div>
    </div>
</body>
</html>
