<?php
session_start();
require '../koneksi.php';

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
                <div class="relative inline-block text-left md:order-2">
                    <button id="dropdownButton" data-dropdown-toggle="dropdownMenu" type="button" class="inline-flex items-center justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-700 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        Halo, <?php echo $_SESSION["username"]; ?>
                        <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                <!-- Dropdown menu -->
                <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-44 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="dropdownButton">
                        <a href="../ProfileFunction/profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Profile</a>
                        <a href="../logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Logout</a>
                    </div>
                </div>
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

    <section id="destinasi">

        <div class="container pt-8">
            <h2 class="text-destinasi text-slate-900 tracking-wide mb-8">Destinasi Wisata Populer</h2>
        </div>

        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Card 1 -->
                <div class="overflow-hidden rounded-xl bg-white shadow-md">
                    <div class="md:flex">
                        <div class="md:shrink-0">
                            <img
                                class="h-48 w-full object-cover md:h-full md:w-48"
                                src="./assets/images/international.png"
                                alt="Modern building architecture" />
                        </div>
                        <div class="p-8">
                            <div class="text-sm font-semibold tracking-wide text-indigo-500 uppercase">Wisata International</div>
                            <a href="#" class="mt-1 block text-lg leading-tight font-medium text-black hover:underline">
                                Incredible accommodation for your team
                            </a>
                            <p class="mt-2 text-gray-500">
                                Looking to take your team away on a retreat to enjoy awesome food and take in some sunshine? We have a list of
                                places to do just that.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="overflow-hidden rounded-xl bg-white shadow-md">
                    <div class="md:flex">
                        <div class="md:shrink-0">
                            <img
                                class="h-48 w-full object-cover md:h-full md:w-48"
                                src="./assets/images/international.png"
                                alt="Modern building architecture" />
                        </div>
                        <div class="p-8">
                            <div class="text-sm font-semibold tracking-wide text-indigo-500 uppercase">Wisata International</div>
                            <a href="#" class="mt-1 block text-lg leading-tight font-medium text-black hover:underline">
                                Incredible accommodation for your team
                            </a>
                            <p class="mt-2 text-gray-500">
                                Looking to take your team away on a retreat to enjoy awesome food and take in some sunshine? We have a list of
                                places to do just that.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8 py-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Card 1 -->
                <div class="overflow-hidden rounded-xl bg-white shadow-md">
                    <div class="md:flex">
                        <div class="md:shrink-0">
                            <img
                                class="h-48 w-full object-cover md:h-full md:w-48"
                                src="./assets/images/international.png"
                                alt="Modern building architecture" />
                        </div>
                        <div class="p-8">
                            <div class="text-sm font-semibold tracking-wide text-indigo-500 uppercase">Wisata International</div>
                            <a href="#" class="mt-1 block text-lg leading-tight font-medium text-black hover:underline">
                                Incredible accommodation for your team
                            </a>
                            <p class="mt-2 text-gray-500">
                                Looking to take your team away on a retreat to enjoy awesome food and take in some sunshine? We have a list of
                                places to do just that.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="overflow-hidden rounded-xl bg-white shadow-md">
                    <div class="md:flex">
                        <div class="md:shrink-0">
                            <img
                                class="h-48 w-full object-cover md:h-full md:w-48"
                                src="./assets/images/international.png"
                                alt="Modern building architecture" />
                        </div>
                        <div class="p-8">
                            <div class="text-sm font-semibold tracking-wide text-indigo-500 uppercase">Wisata International</div>
                            <a href="#" class="mt-1 block text-lg leading-tight font-medium text-black hover:underline">
                                Incredible accommodation for your team
                            </a>
                            <p class="mt-2 text-gray-500">
                                Looking to take your team away on a retreat to enjoy awesome food and take in some sunshine? We have a list of
                                places to do just that.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8 pb-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Card 1 -->
                <div class="overflow-hidden rounded-xl bg-white shadow-md">
                    <div class="md:flex">
                        <div class="md:shrink-0">
                            <img
                                class="h-48 w-full object-cover md:h-full md:w-48"
                                src="./assets/images/international.png"
                                alt="Modern building architecture" />
                        </div>
                        <div class="p-8">
                            <div class="text-sm font-semibold tracking-wide text-indigo-500 uppercase">Wisata International</div>
                            <a href="#" class="mt-1 block text-lg leading-tight font-medium text-black hover:underline">
                                Incredible accommodation for your team
                            </a>
                            <p class="mt-2 text-gray-500">
                                Looking to take your team away on a retreat to enjoy awesome food and take in some sunshine? We have a list of
                                places to do just that.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="overflow-hidden rounded-xl bg-white shadow-md">
                    <div class="md:flex">
                        <div class="md:shrink-0">
                            <img
                                class="h-48 w-full object-cover md:h-full md:w-48"
                                src="./assets/images/international.png"
                                alt="Modern building architecture" />
                        </div>
                        <div class="p-8">
                            <div class="text-sm font-semibold tracking-wide text-indigo-500 uppercase">Wisata International</div>
                            <a href="#" class="mt-1 block text-lg leading-tight font-medium text-black hover:underline">
                                Incredible accommodation for your team
                            </a>
                            <p class="mt-2 text-gray-500">
                                Looking to take your team away on a retreat to enjoy awesome food and take in some sunshine? We have a list of
                                places to do just that.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- maskapai -->

    <section id="maskapai" class="bg-sky-600">
        <div class="container pt-8">
            <h2 class="text-maskapai text-white tracking-wide mb-8">Maskapai Penerbangan</h2>
        </div>

        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Card 1 -->
                <div class="overflow-hidden rounded-xl bg-white shadow-md">
                    <div class="md:flex">
                        <div class="md:shrink-0">
                            <img
                                class="h-48 w-full object-cover md:h-full md:w-48"
                                src="./assets/images/international.png"
                                alt="Modern building architecture" />
                        </div>
                        <div class="p-8">
                            <div class="text-sm font-semibold tracking-wide text-indigo-500 uppercase">Wisata International</div>
                            <a href="#" class="mt-1 block text-lg leading-tight font-medium text-black hover:underline">
                                Incredible accommodation for your team
                            </a>
                            <p class="mt-2 text-gray-500">
                                Looking to take your team away on a retreat to enjoy awesome food and take in some sunshine? We have a list of
                                places to do just that.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="overflow-hidden rounded-xl bg-white shadow-md">
                    <div class="md:flex">
                        <div class="md:shrink-0">
                            <img
                                class="h-48 w-full object-cover md:h-full md:w-48"
                                src="./assets/images/international.png"
                                alt="Modern building architecture" />
                        </div>
                        <div class="p-8">
                            <div class="text-sm font-semibold tracking-wide text-indigo-500 uppercase">Wisata International</div>
                            <a href="#" class="mt-1 block text-lg leading-tight font-medium text-black hover:underline">
                                Incredible accommodation for your team
                            </a>
                            <p class="mt-2 text-gray-500">
                                Looking to take your team away on a retreat to enjoy awesome food and take in some sunshine? We have a list of
                                places to do just that.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8 py-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Card 1 -->
                <div class="overflow-hidden rounded-xl bg-white shadow-md">
                    <div class="md:flex">
                        <div class="md:shrink-0">
                            <img
                                class="h-48 w-full object-cover md:h-full md:w-48"
                                src="./assets/images/international.png"
                                alt="Modern building architecture" />
                        </div>
                        <div class="p-8">
                            <div class="text-sm font-semibold tracking-wide text-indigo-500 uppercase">Wisata International</div>
                            <a href="#" class="mt-1 block text-lg leading-tight font-medium text-black hover:underline">
                                Incredible accommodation for your team
                            </a>
                            <p class="mt-2 text-gray-500">
                                Looking to take your team away on a retreat to enjoy awesome food and take in some sunshine? We have a list of
                                places to do just that.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="overflow-hidden rounded-xl bg-white shadow-md">
                    <div class="md:flex">
                        <div class="md:shrink-0">
                            <img
                                class="h-48 w-full object-cover md:h-full md:w-48"
                                src="./assets/images/international.png"
                                alt="Modern building architecture" />
                        </div>
                        <div class="p-8">
                            <div class="text-sm font-semibold tracking-wide text-indigo-500 uppercase">Wisata International</div>
                            <a href="#" class="mt-1 block text-lg leading-tight font-medium text-black hover:underline">
                                Incredible accommodation for your team
                            </a>
                            <p class="mt-2 text-gray-500">
                                Looking to take your team away on a retreat to enjoy awesome food and take in some sunshine? We have a list of
                                places to do just that.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8 pb-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Card 1 -->
                <div class="overflow-hidden rounded-xl bg-white shadow-md">
                    <div class="md:flex">
                        <div class="md:shrink-0">
                            <img
                                class="h-48 w-full object-cover md:h-full md:w-48"
                                src="./assets/images/international.png"
                                alt="Modern building architecture" />
                        </div>
                        <div class="p-8">
                            <div class="text-sm font-semibold tracking-wide text-indigo-500 uppercase">Wisata International</div>
                            <a href="#" class="mt-1 block text-lg leading-tight font-medium text-black hover:underline">
                                Incredible accommodation for your team
                            </a>
                            <p class="mt-2 text-gray-500">
                                Looking to take your team away on a retreat to enjoy awesome food and take in some sunshine? We have a list of
                                places to do just that.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="overflow-hidden rounded-xl bg-white shadow-md">
                    <div class="md:flex">
                        <div class="md:shrink-0">
                            <img
                                class="h-48 w-full object-cover md:h-full md:w-48"
                                src="./assets/images/international.png"
                                alt="Modern building architecture" />
                        </div>
                        <div class="p-8">
                            <div class="text-sm font-semibold tracking-wide text-indigo-500 uppercase">Wisata International</div>
                            <a href="#" class="mt-1 block text-lg leading-tight font-medium text-black hover:underline">
                                Incredible accommodation for your team
                            </a>
                            <p class="mt-2 text-gray-500">
                                Looking to take your team away on a retreat to enjoy awesome food and take in some sunshine? We have a list of
                                places to do just that.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="promo">
        <div class="container pt-8">
            <h2 class="text-promo tracking-wide mb-8">Promo Menarik Bulan Ini ! ...</h2>
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