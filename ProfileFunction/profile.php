<?php
session_start();
require '../koneksi.php';

// Cek apakah user sudah login

// Ambil data user dari database
$id_user = $_SESSION['id_user'];
$stmt = $conn->prepare("SELECT * FROM user WHERE id_user = ?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!-- ... (PHP part remains the same) ... -->

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

        .password-strength-meter {
            @apply h-1.5 rounded-full mt-2 transition-all duration-500;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-6xl animate-fade-in">
        <!-- Back Button -->
        <a href="javascript:history.back()" class="mb-8 inline-flex items-center space-x-2 text-indigo-600 hover:text-indigo-800 transition-colors">
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
                        <span>Profil Pengguna</span>
                    </h2>
                    <span class="text-sm font-medium text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">
                        <?= ucfirst($user['roles']) ?>
                    </span>
                </header>

                <!-- Profile Content -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Profile Info -->
                    <div class="space-y-6">
                        <div class="bg-gray-50 p-5 rounded-xl">
                        <div class="flex justify-start mb-4">
                <img src="../assets/images/<?= isset($user['profile_picture']) && !empty($user['profile_picture']) ? htmlspecialchars($user['profile_picture']) : 'https://via.placeholder.com/150' ?>" alt="Profile Picture" class="w-32 h-32 rounded-full object-cover">
              </div>
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
                        <form method="POST" action="update_profile.php" enctype="multipart/form-data" class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-800 mb-6">Ubah Profil</h3>
                            <div class="space-y-4">
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>"
                                    class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all">
                                </div>
                                <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Profile</label>
                                        <input type="file" name="profile_picture" value="<?= htmlspecialchars($user ['profile_picture'] )?>"
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

                        <!-- Update Password Form -->
                        <form method="POST" action="update_password.php" class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-800 mb-6">Ubah Password</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Password Saat Ini</label>
                                    <input type="password" name="current_password" required
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all">
                                </div>
                                <div>x`
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                                    <input type="password" name="new_password" id="new_password" required
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all"
                                        onkeyup="checkPasswordStrength(this.value)">
                                    <div class="password-strength-meter">
                                        <div id="password-strength-bar" class="h-full rounded-full w-0 transition-all duration-500"></div>
                                    </div>
                                    <div id="password-strength-text" class="text-sm mt-1 font-medium"></div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                                    <input type="password" name="confirm_password" required
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all">
                                </div>
                                <button type="submit" class="w-full px-6 py-3 bg-gray-800 hover:bg-gray-900 text-white font-medium rounded-lg transition-colors shadow-sm">
                                    Ubah Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function checkPasswordStrength(password) {
            const strength = {
                0: {
                    text: "Sangat Lemah",
                    color: "bg-rose-500",
                    textColor: "text-rose-500"
                },
                1: {
                    text: "Lemah",
                    color: "bg-rose-400",
                    textColor: "text-rose-400"
                },
                2: {
                    text: "Sedang",
                    color: "bg-amber-400",
                    textColor: "text-amber-400"
                },
                3: {
                    text: "Kuat",
                    color: "bg-emerald-400",
                    textColor: "text-emerald-400"
                },
                4: {
                    text: "Sangat Kuat",
                    color: "bg-emerald-600",
                    textColor: "text-emerald-600"
                }
            };

            let strengthValue = 0;
            const bar = document.getElementById('password-strength-bar');
            const text = document.getElementById('password-strength-text');
            const meter = document.querySelector('.password-strength-meter');

            meter.className = 'password-strength-meter h-1.5 rounded-full mt-2 transition-all duration-500 bg-gray-200';
            bar.className = 'h-full rounded-full w-0 transition-all duration-500';

            if (password.length >= 8) strengthValue++;
            if (password.length >= 12) strengthValue++;
            if (/[A-Z]/.test(password) && /[a-z]/.test(password)) strengthValue++;
            if (/\d/.test(password)) strengthValue++;
            if (/[^A-Za-z0-9]/.test(password)) strengthValue++;

            const currentStrength = Math.min(strengthValue, 4);
            const width = ((currentStrength + 1) / 5) * 100;

            bar.style.width = `${width}%`;
            bar.classList.add(strength[currentStrength].color);
            text.textContent = `Kekuatan Password: ${strength[currentStrength].text}`;
            text.className = `text-sm mt-1 font-medium ${strength[currentStrength].textColor}`;
            meter.classList.add(strength[currentStrength].color.replace('bg', 'border'));
        }
    </script>
</body>

</html>