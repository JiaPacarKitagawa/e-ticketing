<?php
session_start();
require '../koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: data_user.php");
    exit;
}

// $queryJadwal = ("
// SELECT
//     jadwal_penerbangan.*,
//     rute.rute_asal,
//     rute.rute_tujuan,
//     rute.tanggal_pergi,
//     maskapai.nama_maskapai,
//     maskapai.logo_maskapai
// FROM jadwal_penerbangan 
// INNER JOIN rute ON rute.id_rute = jadwal_penerbangan.id_rute 
// INNER JOIN maskapai ON rute.id_maskapai = maskapai.id_maskapai 
// ORDER BY rute.tanggal_pergi, jadwal_penerbangan.waktu_berangkat
// ");

$id_user = $_SESSION['id_user'];
$stmt = $conn->prepare("SELECT * FROM user WHERE id_user = ?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

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

    header("Location: data_user.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }

        
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <!-- Tambahkan di bawah tag <body> -->
    <div class="fixed left-0 top-0 h-screen w-64 bg-white shadow-lg z-50 border-r border-gray-100">
        <div class="p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Admin Panel</h2>
            <nav class="space-y-3">
                <a href="#profil" class="block p-2 hover:bg-indigo-50 rounded-lg text-gray-600 hover:text-indigo-600 transition-colors">
                    Profil Pengguna
                </a>
                <a href="#daftar-user" class="block p-2 hover:bg-indigo-50 rounded-lg text-gray-600 hover:text-indigo-600 transition-colors">
                    Daftar User
                </a>
                <a href="#daftar-kota" class="block p-2 hover:bg-indigo-50 rounded-lg text-gray-600 hover:text-indigo-600 transition-colors">
                    Daftar Kota
                </a>
                <a href="#rute-penerbangan" class="block p-2 hover:bg-indigo-50 rounded-lg text-gray-600 hover:text-indigo-600 transition-colors">
                    Rute Penerbangan
                </a>
                <a href="#jadwal-penerbangan" class="block p-2 hover:bg-indigo-50 rounded-lg text-gray-600 hover:text-indigo-600 transition-colors">
                    Jadwal Penerbangan
                </a>
                <a href="#maskapai" class="block p-2 hover:bg-indigo-50 rounded-lg text-gray-600 hover:text-indigo-600 transition-colors">
                    Maskapai
                </a>
            </nav>
        </div>
    </div>

    <!-- <div class="container mx-auto px-4 py-8 max-w-6xl animate-fade-in ml-64 text-4xl">
     Selamat datang king, <?= $user['username'] ?>
</div> -->

    <!-- Ubah div container utama menjadi seperti ini: -->
    <div class="container mx-auto px-4 py-8 max-w-6xl animate-fade-in ml-64"> <!-- Tambahkan ml-64 -->
        <div class="container mx-auto px-4 py-8 max-w-6xl animate-fade-in">
            <!-- Back Button -->
            <a href="index.php" class="mb-8 inline-flex items-center space-x-2 text-indigo-600 hover:text-indigo-800 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium">Kembali</span>
            </a>

            <!-- Main Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                <!-- Notifications Section -->
                <div class="px-8 pt-6">
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-lg flex items-center space-x-3">
                            <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-emerald-600 font-medium"><?= $_SESSION['success'] ?></span>
                            <?php unset($_SESSION['success']); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-lg flex items-center space-x-3">
                            <svg class="w-5 h-5 text-rose-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-rose-600 font-medium"><?= $_SESSION['error'] ?></span>
                            <?php unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Profile Section -->
                <div class="px-8 py-6">
                    <header class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center space-x-3">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <ul class="">
                                <li>Profile</li>
                                <li>Logout</li>
                            </ul>
                        </h2>

                        <span class="text-sm font-medium text-indigo-600 bg-indigo-50 px-3 mt-2 py-1 mt-1 rounded-full">
                            <?= ucfirst($user['roles']) ?>
                        </span>
                    </header>

                    <!-- Profile Content -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Profile Info dengan Profile Picture -->
                        <div class="space-y-6">
                            <div class="bg-gray-50 p-5 rounded-xl">
                                <!-- Profile Picture -->
                                <div class="flex justify-start mb-4">
                                    <!-- Tambahkan onclick untuk trigger input file -->
                                    <img src="../assets/images/<?= isset($user['profile_picture']) && !empty($user['profile_picture']) ? htmlspecialchars($user['profile_picture']) : 'default.png' ?>"
                                        alt="Profile Picture"
                                        class="w-32 h-32 rounded-full object-cover cursor-pointer hover:opacity-80 transition-opacity"
                                        id="profile-preview"
                                        onclick="document.getElementById('profile-input').click()">
                                </div>

                                <!-- Input file yang disembunyikan -->
                                <input type="file"
                                    name="profile_picture"
                                    id="profile-input"
                                    accept="image/*"
                                    class="hidden"
                                    onchange="previewImage(event)">
                                <dl class="space-y-4">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 mb-1">Username</dt>
                                        <dd class="font-medium text-gray-800"><?= htmlspecialchars($user['username']) ?></dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 mb-1">Nama Lengkap</dt>
                                        <dd class="font-medium text-gray-800"><?= htmlspecialchars($user['nama_lengkap']) ?></dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 mb-1">Nomor Telepon</dt>
                                        <dd class="font-medium text-gray-800">
                                            <?= $user['no_telp'] ? htmlspecialchars($user['no_telp']) : '-' ?>
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <!-- Forms Section -->
                        <div class="space-y-8">

                            <!-- Update Profile Form -->
                            <form method="POST" class="bg-white rounded-xl px-6  shadow-sm border border-gray-100">
                                <h3 class="text-lg font-semibold text-gray-800 mb-6">Ubah Profil</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                        <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                        <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($user['nama_lengkap']) ?>"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                        <input type="tel" name="no_telp" value="<?= htmlspecialchars($user['no_telp']) ?>"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all">
                                    </div>
                                    <button type="submit" class="w-full px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors shadow-sm">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mt-12 bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Semua User</h2>
                <?php
                $sqlAll = "SELECT * FROM user";
                $resultAll = $conn->query($sqlAll);
                ?>
                <?php if ($resultAll && $resultAll->num_rows > 0): ?>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Username</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Lengkap</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nomor Telepon</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Roles</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php while ($row = $resultAll->fetch_assoc()): ?>
                                    <tr class="hover:bg-gray-100">
                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['id_user']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['username']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['no_telp']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['roles']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="action_user/update_user.php?id_user=<?= htmlspecialchars($row['id_user']) ?>" class="text-indigo-600 hover:text-indigo-800 font-medium mr-4">Edit</a>
                                            <a href="action_user/delete_user.php?id_user=<?= htmlspecialchars($row['id_user']) ?>" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Apakah anda yakin untuk menghapus user ini?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-gray-600">Tidak ada data user yang ditemukan.</p>
                <?php endif; ?>
            </div>

            <div class="mt-12 bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Semua Kota</h2>
                <?php
                $sqlAll = "SELECT * FROM kota";
                $resultAll = $conn->query($sqlAll);
                ?>
                <?php if ($resultAll && $resultAll->num_rows > 0): ?>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Id</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kota</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php while ($row = $resultAll->fetch_assoc()): ?>
                                    <tr class="hover:bg-gray-100">
                                        <td class="px-6 py-4 whitespace-nowrap"><img src="" alt=""><?= htmlspecialchars($row['id_kota']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['nama_kota']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="action_user/update_kota.php?id_kota=<?= htmlspecialchars($row['id_kota']) ?>" class="text-indigo-600 hover:text-indigo-800 font-medium mr-4">Edit</a>
                                            <a href="action_user/delete_kota.php?id_kota=<?= htmlspecialchars($row['id_kota']) ?>" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Apakah anda yakin untuk menghapus kota ini?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-gray-600">Tidak ada data kota yang ditemukan.</p>
                <?php endif; ?>
            </div>
            <!-- Bagian Rute Penerbangan -->
            <div class="mt-12 bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Rute Penerbangan</h2>
                <?php
                $sqlAll = "SELECT * From rute";
                $resultAll = $conn->query($sqlAll);

                // Debugging: Check for SQL errors
                if (!$resultAll) {
                    echo "<p class='text-red-600'>Error: " . $conn->error . "</p>";
                } else {
                    if ($resultAll->num_rows > 0): ?>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Maskapai</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Asal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tujuan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Pergi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php while ($row = $resultAll->fetch_assoc()): ?>
                                        <tr class="hover:bg-gray-100">
                                            <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['id_rute']) ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['id_maskapai']) ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['rute_asal']) ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['rute_tujuan']) ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['tanggal_pergi']) ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="action_user/update_rute.php?id_rute=<?= $row['id_rute'] ?>" class="text-indigo-600 hover:text-indigo-800 font-medium mr-4">Edit</a>
                                                <a href="action_user/delete_rute.php?id_rute=<?= $row['id_rute'] ?>" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Hapus rute ini?')">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-600">Tidak ada data rute penerbangan.</p>
                <?php endif;
                }
                ?>
            </div>


            <div class="mt-12 bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Jadwal Penerbangan</h2>
                <?php
                $sqlJadwal = "SELECT 
                jadwal_penerbangan.*, 
                rute.rute_asal, 
                rute.rute_tujuan, 
                rute.tanggal_pergi,
                maskapai.nama_maskapai 
            FROM jadwal_penerbangan 
            INNER JOIN rute ON rute.id_rute = jadwal_penerbangan.id_rute 
            INNER JOIN maskapai ON rute.id_maskapai = maskapai.id_maskapai 
            ORDER BY rute.tanggal_pergi, jadwal_penerbangan.waktu_berangkat";
                $resultJadwal = $conn->query($sqlJadwal);

                if (!$resultJadwal) {
                    echo "<p class='text-red-600'>Error: " . $conn->error . "</p>";
                } else {
                    if ($resultJadwal->num_rows > 0): ?>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID Jadwal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Asal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tujuan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Pergi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu Berangkat</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu Tiba</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Maskapai</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php while ($row = $resultJadwal->fetch_assoc()): ?>
                                        <tr class="hover:bg-gray-100">
                                            <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['id_jadwal']) ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['rute_asal']) ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['rute_tujuan']) ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['tanggal_pergi']) ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['waktu_berangkat']) ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['waktu_tiba']) ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap">Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['nama_maskapai']) ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="action_user/update_jadwal.php?id_jadwal=<?= $row['id_jadwal'] ?>" class="text-indigo-600 hover:text-indigo-800 font-medium mr-4">Edit</a>
                                                <a href="action_user/delete_jadwal.php?id_jadwal=<?= $row['id_jadwal'] ?>" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Hapus jadwal ini?')">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-600">Tidak ada data jadwal penerbangan.</p>
                <?php endif;
                }
                ?>
            </div>


            <!-- Bagian Maskapai -->
            <div class="mt-12 bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Maskapai</h2>
                <?php
                $sqlAll = "SELECT * FROM maskapai";
                $resultAll = $conn->query($sqlAll);
                ?>
                <?php if ($resultAll && $resultAll->num_rows > 0): ?>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Logo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Maskapai</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kapasitas</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php while ($row = $resultAll->fetch_assoc()): ?>
                                    <tr class="hover:bg-gray-100">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <img src="../assets/images/<?= htmlspecialchars($row['logo_maskapai']) ?>" class="h-8 w-8 object-contain" alt="logo">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['nama_maskapai']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['kapasitas']) ?> Kursi</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="action_user/update_maskapai.php?id_maskapai=<?= $row['id_maskapai'] ?>" class="text-indigo-600 hover:text-indigo-800 font-medium mr-4">Edit</a>
                                            <a href="action_user/delete_maskapai.php?id_maskapai=<?= $row['id_maskapai'] ?>" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Hapus maskapai ini?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-gray-600">Tidak ada data maskapai.</p>
                <?php endif; ?>
            </div>

            <div class="mt-12 bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Jadwal Penerbangan</h2>
                <?php
                // Query Jadwal dengan JOIN
                $sqlJadwal = "SELECT 
        jadwal_penerbangan.*, 
        rute.rute_asal, 
        rute.rute_tujuan, 
        rute.tanggal_pergi,
        maskapai.nama_maskapai 
    FROM jadwal_penerbangan 
    INNER JOIN rute ON rute.id_rute = jadwal_penerbangan.id_rute 
    INNER JOIN maskapai ON rute.id_maskapai = maskapai.id_maskapai 
    ORDER BY rute.tanggal_pergi, jadwal_penerbangan.waktu_berangkat";
                $resultJadwal = $conn->query($sqlJadwal);

                if (!$resultJadwal) {
                    echo "<p class='text-red-600'>Error: " . $conn->error . "</p>";
                } else {
                    if ($resultJadwal->num_rows > 0): ?>
                        <!-- Grid Container -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php while ($row = $resultJadwal->fetch_assoc()):
                                // Variabel untuk menampilkan data
                                $idJadwal       = htmlspecialchars($row['id_jadwal']);
                                $ruteAsal       = htmlspecialchars($row['rute_asal']);
                                $ruteTujuan     = htmlspecialchars($row['rute_tujuan']);
                                $tanggalPergi   = htmlspecialchars($row['tanggal_pergi']);
                                $waktuBerangkat = htmlspecialchars($row['waktu_berangkat']);
                                $waktuTiba      = htmlspecialchars($row['waktu_tiba']);
                                $harga          = number_format($row['harga'], 0, ',', '.');
                                $maskapai       = htmlspecialchars($row['nama_maskapai']);

                                // (Opsional) Placeholder gambar, ganti sesuai kebutuhan
                                $imageSrc       = "https://via.placeholder.com/400x250.png?text=" . urlencode($ruteTujuan);
                            ?>
                                <!-- Card -->
                                <div class="bg-white shadow-lg rounded-lg overflow-hidden relative">
                                    <!-- Bagian Gambar -->
                                    <div class="relative">
                                        <img
                                            src="<?= $imageSrc ?>"
                                            alt="<?= $ruteTujuan ?>"
                                            class="w-full h-48 object-cover" />
                                        <!-- Label Kiri Atas (contoh): Sekali Jalan -->
                                        <span class="absolute top-2 left-2 bg-indigo-600 text-white text-xs px-2 py-1 rounded-full">
                                            Sekali jalan
                                        </span>
                                        <!-- Label Kanan Atas (contoh): Dom Deals -->
                                        <span class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                            Dom Deals
                                        </span>
                                    </div>

                                    <!-- Konten Detail -->
                                    <div class="p-4">
                                        <!-- Rute Penerbangan -->
                                        <h3 class="text-gray-800 text-lg font-semibold">
                                            <?= $ruteAsal ?> → <?= $ruteTujuan ?>
                                        </h3>
                                        <!-- Tanggal Pergi -->
                                        <p class="text-gray-500 text-sm mt-1">
                                            <?= $tanggalPergi ?>
                                        </p>
                                        <!-- Maskapai & Waktu -->
                                        <p class="text-gray-500 text-sm">
                                            <?= $maskapai ?> |
                                            <?= $waktuBerangkat ?> - <?= $waktuTiba ?>
                                        </p>
                                        <!-- Harga -->
                                        <div class="mt-4">
                                            <p class="text-sm text-gray-500">Mulai dari</p>
                                            <p class="text-red-600 text-xl font-bold">IDR <?= $harga ?></p>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="p-4 border-t border-gray-100 flex items-center justify-end space-x-4">
                                        <a
                                            href="action_user/update_jadwal.php?id_jadwal=<?= $idJadwal ?>"
                                            class="text-indigo-600 hover:text-indigo-800 font-medium">
                                            Edit
                                        </a>
                                        <a
                                            href="action_user/delete_jadwal.php?id_jadwal=<?= $idJadwal ?>"
                                            class="text-red-600 hover:text-red-800 font-medium"
                                            onclick="return confirm('Hapus jadwal ini?')">
                                            Delete
                                        </a>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-600">Tidak ada data jadwal penerbangan.</p>
                <?php endif;
                }
                ?>
            </div>
        </div>

        <script>
            function previewImage(event) {
                const input = event.target;
                const preview = document.getElementById('profile-preview');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        // Update preview gambar
                        preview.src = e.target.result;

                        // Tambahkan efek visual saat gambar baru dipilih
                        preview.classList.add('ring-2', 'ring-indigo-500', 'ring-offset-2');
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Optional: Tambahkan hover effect
            document.getElementById('profile-preview').addEventListener('mouseover', function() {
                this.style.transform = 'scale(1.05)';
            });

            document.getElementById('profile-preview').addEventListener('mouseout', function() {
                this.style.transform = 'scale(1)';
            });

          
                // Hamburger menu untuk mobile
                const hamburger = document.createElement('div');
            hamburger.className = 'sm:hidden fixed top-4 right-4 z-50 cursor-pointer p-2 bg-gray-100 rounded-lg';
            hamburger.innerHTML = `
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
`;

            const sidebar = document.querySelector('.fixed.left-0');
            hamburger.addEventListener('click', () => {
                sidebar.classList.toggle('hidden');
            });

            document.body.prepend(hamburger);

            // Sembunyikan sidebar default di mobile
            window.addEventListener('DOMContentLoaded', () => {
                if (window.innerWidth < 640) {
                    sidebar.classList.add('hidden');
                }
            });
        
        </script>
</body>

</html>