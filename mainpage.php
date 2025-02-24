<?php

session_start();
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    header("Location: penumpang/index.php");
    exit;
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicketinAja!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        .text-destinasi {
            padding-left: 265px;
            font-family: "Lexend Deca", serif;
            font-optical-sizing: auto;
            font-weight: 500;
            font-style: normal;
            font-size: 36px;
        }

        .text-maskapai {
            padding-left: 265px;
            font-family: "Lexend Deca", serif;
            font-optical-sizing: auto;
            font-weight: 500;
            font-style: normal;
            font-size: 36px;
        }

        .text-promo {
            padding-left: 265px;
            font-family: "Lexend Deca", serif;
            font-optical-sizing: auto;
            font-weight: 500;
            font-style: normal;
            font-size: 36px;
        }

        @media screen and (max-width: 768px) {
            .text-destinasi {
                padding-left: 0;
                text-align: center;
                font-size: 24px;

            }

            .text-maskapai {
                padding-left: 0;
                text-align: center;
                font-size: 24px;
            }

            .text-promo {
                padding-left: 0;
                text-align: center;
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600 opacity-75">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4 ">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">TiketinAja!</span>
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <a href="./auth/login/index.php" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Pesan Sekarang !</a>
                <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <!-- Centered Navigation -->
            <div class="items-center justify-center hidden w-full md:flex md:w-auto md:order-1 py-3" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-12 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="#home" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Home</a>
                    </li>
                    <li>
                        <a href="#destinasi" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Destinasi</a>
                    </li>
                    <li>
                        <a href="#maskapai" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Maskapai</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="relative" id="home">
        <div class="w-full bg-cover bg-center h-[50vh] sm:h-[70vh] md:h-[85vh]" style="background-image: url('./assets/images/maingpage.webp');"></div>
        <div class="absolute bottom-0 left-0 px-5 py-5">
            <h1 class="text-white text-2xl sm:text-3xl md:text-4xl font-bold mb-2">
                Selamat Datang di TiketinAja!
            </h1>
            <p class="text-white text-base sm:text-lg md:text-xl">
                Pesan tiket pesawat mudah! Cari, bandingkan, dan beli cepat dari berbagai maskapai. Harga kompetitif, pembayaran aman, konfirmasi instan. Fleksibel, kapan saja dan di mana saja. Segera booking!.
            </p>
        </div>
    </div>

    <section class="max-w-7xl mx-auto px-4 py-8" id="destinasi">
        <!-- Judul & Subjudul -->
        <h1 class="text-2xl md:text-3xl font-bold mb-2">
            Promo tiket pesawat terbaik dari Indonesia
        </h1>
        <p class="text-gray-600 mb-6">
            Berikut promo tiket pesawat dengan harga terendah. Pesan segera – semuanya berangkat
            dalam tiga bulan ke depan.
        </p>

        <!-- Grid Card -->
        <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-3">
            <!-- Card 1: Kuala Lumpur -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <!-- Gambar -->
                <img
                    src="https://via.placeholder.com/600x300"
                    alt="Kuala Lumpur"
                    class="w-full h-48 object-cover" />
                <!-- Konten card -->
                <div class="p-4">
                    <h2 class="text-xl font-bold text-gray-800">Kuala Lumpur</h2>
                    <p class="text-sm text-gray-500 mb-4">Malaysia</p>
                    <!-- Jadwal penerbangan berangkat -->
                    <div class="flex items-start gap-2 mb-2">
                        <!-- Ikon pesawat -->
                        <span class="text-xl">✈️</span>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-800">Jum, 7 Mar</p>
                            <p class="text-xs text-gray-500">PDG - KUL dengan Super Air Jet</p>
                        </div>
                        <span class="text-xs text-gray-500">Langsung</span>
                    </div>
                    <!-- Jadwal penerbangan pulang -->
                    <div class="flex items-start gap-2 mb-4">
                        <span class="text-xl">✈️</span>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-800">Min, 9 Mar</p>
                            <p class="text-xs text-gray-500">KUL - PDG dengan Super Air Jet</p>
                        </div>
                        <span class="text-xs text-gray-500">Langsung</span>
                    </div>
                    <!-- Harga -->
                    <p class="text-sm font-semibold text-blue-600">
                        mulai Rp 628.437 &gt;
                    </p>
                </div>
            </div>

            <!-- Card 2: Kota Bandar Lampung -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <!-- Gambar (contoh ilustrasi) -->
                <img
                    src="https://via.placeholder.com/600x300/edf2f7/000000?text=Ilustrasi+Lampung"
                    alt="Kota Bandar Lampung"
                    class="w-full h-48 object-cover" />
                <!-- Konten card -->
                <div class="p-4">
                    <h2 class="text-xl font-bold text-gray-800">Kota Bandar Lampung</h2>
                    <p class="text-sm text-gray-500 mb-4">Indonesia</p>
                    <!-- Jadwal penerbangan berangkat -->
                    <div class="flex items-start gap-2 mb-2">
                        <span class="text-xl">✈️</span>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-800">Sab, 15 Mar</p>
                            <p class="text-xs text-gray-500">PDG - TKG dengan Citilink</p>
                        </div>
                        <span class="text-xs text-gray-500">Langsung</span>
                    </div>
                    <!-- Jadwal penerbangan pulang -->
                    <div class="flex items-start gap-2 mb-4">
                        <span class="text-xl">✈️</span>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-800">Sen, 17 Mar</p>
                            <p class="text-xs text-gray-500">TKG - PDG dengan Citilink</p>
                        </div>
                        <span class="text-xs text-gray-500">Langsung</span>
                    </div>
                    <!-- Harga -->
                    <p class="text-sm font-semibold text-blue-600">
                        mulai Rp 762.652 &gt;
                    </p>
                </div>
            </div>

            <!-- Card 3: Singapura -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <!-- Gambar -->
                <img
                    src="https://via.placeholder.com/600x300"
                    alt="Singapura"
                    class="w-full h-48 object-cover" />
                <!-- Konten card -->
                <div class="p-4">
                    <h2 class="text-xl font-bold text-gray-800">Singapura</h2>
                    <p class="text-sm text-gray-500 mb-4">Singapore</p>
                    <!-- Jadwal penerbangan berangkat -->
                    <div class="flex items-start gap-2 mb-2">
                        <span class="text-xl">✈️</span>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-800">Rab, 12 Mar</p>
                            <p class="text-xs text-gray-500">PDG - SIN dengan Indonesia AirAsia</p>
                        </div>
                        <span class="text-xs text-gray-500">Langsung</span>
                    </div>
                    <!-- Jadwal penerbangan pulang -->
                    <div class="flex items-start gap-2 mb-4">
                        <span class="text-xl">✈️</span>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-800">Jum, 14 Mar</p>
                            <p class="text-xs text-gray-500">SIN - PDG dengan Indonesia AirAsia</p>
                        </div>
                        <span class="text-xs text-gray-500">Langsung</span>
                    </div>
                    <!-- Harga -->
                    <p class="text-sm font-semibold text-blue-600">
                        mulai Rp 1.286.037 &gt;
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 ">


        <div class=" border border-gray-300 bg-white rounded-lg p-4 flex items-start space-x-3">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 text-gray-400 mt-1 flex-shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M13 16h-1v-4h-1m1-4h.01M12 3c-4.418 0-8 
             3.582-8 8s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8z" />
            </svg>

            <p class="text-sm text-gray-700 leading-relaxed">
                <strong>Bagaimana kami mendapatkan promo ini?</strong> Kami mencari semua penerbangan
                kelas ekonomi dari Indonesia yang berangkat dalam tiga bulan ke depan. Semua tarif ini
                menawarkan harga terhemat bila dibandingkan dengan harga rata-rata. Data kami diperbarui
                secara berkala dan tanggal keberangkatan dapat berubah sewaktu-waktu.
            </p>
        </div>
    </section>



    <section class="max-w-7xl mx-auto px-4 py-12">
        <div class="bg-gray-200 py-10 rounded-xl">
            <h2 class="text-2xl md:text-3xl font-bold text-center mb-4 ">
                Mencari promo tiket pesawat terbaik ke mana saja di seluruh dunia?
            </h2>
            < class="text-center text-gray-700 px-5 mx-auto mb-12 leading-relaxed">
                Semua jadi mudah dengan Skyscanner. 100 juta wisatawan menggunakan Skyscanner
                untuk membandingkan promo dan penawaran tiket pesawat dengan lebih dari
                1200 maskapai dan vendor perjalanan. Dengan begitu banyak pilihan penerbangan
                dan hotel dalam satu tempat, Anda bisa merencanakan perjalanan Anda dengan
                lebih cerdas dan mudah.
                </p>

                <div class="grid gap-8 md:grid-cols-3">
                    <!-- Kolom 1 -->
                    <div class="flex flex-col items-center text-center p-4">
                        <!-- Ikon (contoh globe) -->
                        <img
                            src="assets/images/icon/planet-earth.png"
                            alt="Ikon Globe"
                            class="mb-4 h-20" />
                        <h3 class="text-lg font-semibold mb-2">
                            Cari 'Semua Tempat' dan telusuri semua destinasi
                        </h3>
                        <p class="text-sm text-gray-600">
                            Dengan fitur 'Semua Tempat', Anda tak perlu kebingungan memikirkan tujuan.
                            Temukan penerbangan terbaik ke berbagai destinasi, bahkan yang belum Anda
                            pikirkan sebelumnya.
                        </p>
                    </div>

                    <!-- Kolom 2 -->
                    <div class="flex flex-col items-center text-center p-4">
                        <!-- Ikon (contoh tiket) -->
                        <img
                            src="https://via.placeholder.com/80"
                            alt="Ikon Tiket"
                            class="mb-4" />
                        <h3 class="text-lg font-semibold mb-2">
                            Bayar lebih murah dengan harga transparan
                        </h3>
                        <p class="text-sm text-gray-600">
                            Promo tiket pesawat? Tenang. Kami menampilkan harga jujur.
                            Bersama kami, Anda tak perlu khawatir ada biaya tambahan yang tersembunyi.
                        </p>
                    </div>

                    <!-- Kolom 3 -->
                    <div class="flex flex-col items-center text-center p-4">
                        <!-- Ikon (contoh alarm) -->
                        <img
                            src="https://via.placeholder.com/80"
                            alt="Ikon Alarm"
                            class="mb-4" />
                        <h3 class="text-lg font-semibold mb-2">
                            Pesan harga terbaik dengan Notifikasi Harga
                        </h3>
                        <p class="text-sm text-gray-600">
                            Semua orang suka diskon! Aktifkan Notifikasi Harga untuk rute penerbangan
                            yang Anda inginkan. Kami akan memberi tahu ketika tarif turun.
                        </p>
                    </div>
                </div>
        </div>
    </section>



    <section class="max-w-7xl mx-auto px-4 py-12">
        <!-- Judul -->
        <h2 class="text-2xl md:text-3xl font-semibold mb-2">
            Rencanakan perjalanan Anda tanpa khawatir
        </h2>
        <!-- Subjudul -->
        <p class="text-gray-700 mb-8">
            Misi kami adalah membantu Anda bepergian tanpa khawatir dan memperlancar perjalanan Anda.
        </p>

        <!-- Dua Kolom Poin -->
        <div class="grid gap-8 md:grid-cols-2">
            <!-- Kolom 1 -->
            <div class="flex items-start space-x-3">
                <!-- Ikon (contoh Heroicons: Ticket) -->
                <div class="w-8 h-8 text-blue-500 flex-shrink-0">
                    <!-- Anda bisa ganti ikon sesuai keinginan, misalnya: -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 21V8a2 2 0 012-2h8a2 2 0 012 2v13m-5-9H4a2 2 0 00-2 2v5a2 2 0 002 2h12m-3-5v4" />
                    </svg>
                </div>
                <!-- Teks -->
                <div>
                    <h3 class="text-lg font-semibold mb-1">
                        Dapatkan promo tiket pesawat fleksibel
                    </h3>
                    <p class="text-sm text-gray-600">
                        Cari promo tiket fleksibel untuk penyesuaian ulang jika penerbangan Anda berubah
                        atau dibatalkan.
                    </p>
                </div>
            </div>

            <!-- Kolom 2 -->
            <div class="flex items-start space-x-3">
                <!-- Ikon (contoh Heroicons: Building) -->
                <div class="w-8 h-8 text-blue-500 flex-shrink-0">
                    <!-- Anda bisa ganti ikon sesuai keinginan, misalnya: -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 7v10a1 1 0 001 1h3m12-11v11a1 1 0 01-1 1h-3m-8 0h8m-8-5h8m-8-4h8m-9 9V7a2 2 0 012-2h8a2 2 0 012 2v10" />
                    </svg>
                </div>
                <!-- Teks -->
                <div>
                    <h3 class="text-lg font-semibold mb-1">
                        Tambahkan hotel dan sewa mobil
                    </h3>
                    <p class="text-sm text-gray-600">
                        Rencanakan perjalanan Anda berikut hotel dan sewa mobil, dan simpan semua pesanan
                        Anda di satu tempat.
                    </p>
                </div>
            </div>
        </div>
    </section>



    <footer class="bg-white text-black pt-12">
        <div class="container mx-auto px-6 md:px-12 py-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Kolom 1: Logo dan Deskripsi -->
                <div>
                    <a href="#" class="flex items-center mb-4">
                        <!-- Ganti URL gambar dengan logo Tiket.com jika tersedia -->
                        <img src="https://via.placeholder.com/150x50?text=Tiket.com" alt="Tiket.com Logo" class="h-10 mr-3">
                        <span class="self-center text-2xl font-semibold whitespace-nowrap">Tiket.com</span>
                    </a>
                    <p class="text-sm">
                        Tiket.com adalah platform pemesanan tiket online untuk penerbangan, hotel, kereta, dan hiburan.
                    </p>
                </div>
                <!-- Kolom 2: Navigasi Perusahaan -->
                <div>
                    <h3 class="mb-4 text-sm font-semibold uppercase">Perusahaan</h3>
                    <ul class="text-sm font-medium space-y-2">
                        <li><a href="#" class="hover:underline">Tentang Kami</a></li>
                        <li><a href="#" class="hover:underline">Karir</a></li>
                        <li><a href="#" class="hover:underline">Blog</a></li>
                        <li><a href="#" class="hover:underline">Hubungi Kami</a></li>
                    </ul>
                </div>
                <!-- Kolom 3: Bantuan -->
                <div>
                    <h3 class="mb-4 text-sm font-semibold uppercase">Bantuan</h3>
                    <ul class="text-sm font-medium space-y-2">
                        <li><a href="#" class="hover:underline">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:underline">Syarat &amp; Ketentuan</a></li>
                        <li><a href="#" class="hover:underline">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:underline">FAQ</a></li>
                    </ul>
                </div>
                <!-- Kolom 4: Ikuti Kami (Sosial Media) -->
                <div>
                    <h3 class="mb-4 text-sm font-semibold uppercase">Ikuti Kami</h3>
                    <ul class="flex space-x-4">
                        <!-- Facebook -->
                        <li>
                            <a href="#" class="hover:text-black">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.675 0h-21.35C.597 0 0 .597 0 1.326v21.348C0 23.403.597 24 1.326 24h11.494v-9.294H9.691v-3.622h3.129V8.413c0-3.1 1.894-4.788 4.659-4.788 1.325 0 2.464.099 2.795.143v3.24l-1.918.001c-1.504 0-1.796.715-1.796 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.403 24 24 23.403 24 22.674V1.326C24 .597 23.403 0 22.675 0z" />
                                </svg>
                            </a>
                        </li>
                        <!-- Twitter -->
                        <li>
                            <a href="#" class="hover:text-black">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557a9.83 9.83 0 0 1-2.828.775A4.932 4.932 0 0 0 23.337 3.1a9.864 9.864 0 0 1-3.127 1.195 4.92 4.92 0 0 0-8.384 4.482A13.978 13.978 0 0 1 1.671 3.149 4.922 4.922 0 0 0 3.195 9.723a4.904 4.904 0 0 1-2.229-.616c-.054 2.281 1.581 4.415 3.949 4.89a4.936 4.936 0 0 1-2.224.084 4.923 4.923 0 0 0 4.6 3.417 9.868 9.868 0 0 1-6.102 2.105c-.396 0-.788-.023-1.175-.068a13.945 13.945 0 0 0 7.557 2.213c9.054 0 14.001-7.496 14.001-13.986 0-.21 0-.423-.015-.635A9.935 9.935 0 0 0 24 4.557z" />
                                </svg>
                            </a>
                        </li>
                        <!-- Instagram -->
                        <li>
                            <a href="#" class="hover:text-black">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.849.07 1.366.062 2.633.342 3.608 1.317.975.975 1.255 2.242 1.317 3.608.058 1.265.07 1.645.07 4.849s-.012 3.584-.07 4.849c-.062 1.366-.342 2.633-1.317 3.608-.975.975-2.242 1.255-3.608 1.317-1.265.058-1.645.07-4.849.07s-3.584-.012-4.849-.07c-1.366-.062-2.633-.342-3.608-1.317-.975-.975-1.255-2.242-1.317-3.608C2.175 15.584 2.163 15.204 2.163 12s.012-3.584.07-4.849c.062-1.366.342-2.633 1.317-3.608C4.518 2.505 5.785 2.225 7.151 2.163 8.416 2.105 8.796 2.093 12 2.093m0-2.093C8.741 0 8.332.012 7.052.07 5.771.128 4.613.443 3.68 1.377 2.747 2.311 2.432 3.469 2.374 4.75.012 8.332 0 8.741 0 12c0 3.259.012 3.668.07 4.948.058 1.281.373 2.439 1.307 3.373.934.934 2.092 1.249 3.373 1.307 1.28.058 1.689.07 4.948.07s3.668-.012 4.948-.07c1.281-.058 2.439-.373 3.373-1.307.934-.934 1.249-2.092 1.307-3.373.058-1.28.07-1.689.07-4.948s-.012-3.668-.07-4.948c-.058-1.281-.373-2.439-1.307-3.373C19.387.443 18.229.128 16.948.07 15.668.012 15.259 0 12 0z" />
                                    <path d="M12 5.838A6.162 6.162 0 1 0 18.162 12 6.169 6.169 0 0 0 12 5.838zm0 10.162A3.999 3.999 0 1 1 16 12a3.999 3.999 0 0 1-4 4z" />
                                    <circle cx="18.406" cy="5.594" r="1.44" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Garis pemisah -->
            <hr class="my-8 border-gray-300" />
            <div class="flex flex-col md:flex-row justify-between items-center text-sm">
                <p>&copy; 2025 TiketinAja.com All Rights Reserved.</p>
                <ul class="flex space-x-4 mt-4 md:mt-0">
                    <li><a href="#" class="hover:underline">Syarat &amp; Ketentuan</a></li>
                    <li><a href="#" class="hover:underline">Kebijakan Privasi</a></li>
                    <li><a href="#" class="hover:underline">FAQ</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1, // Hanya 1 card per slide
            spaceBetween: 10, // Jarak antar slide
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 1
                },
                1024: {
                    slidesPerView: 1
                }
            }
        });
    </script>

</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</html>