<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Admin</title>
</head>
<body>
    <div class="sidebar-admin">
        <a href="index.php">Dashboard</a>&nbsp;&nbsp;
        <a href="/e-ticketing/admin/pengguna/">Data Pengguna</a>&nbsp;&nbsp;
        <a href="/e-ticketing/admin/maskapai/">Data Maskapai</a>&nbsp;&nbsp;
        <a href="/e-ticketing/admin/kota/">Data Kota</a>&nbsp;&nbsp;
        <a href="/e-ticketing/admin/rute/">Data Rute</a>&nbsp;&nbsp;
        <a href="/e-ticketing/admin/jadwal/">Data Jadwal Penerbangan</a>&nbsp;&nbsp;
        <a href="/e-ticketing/admin/order/">Pemesanan Tiket</a>&nbsp;&nbsp;
        <a href="../../logout.php" onClick="return confirm('Apakah anda yakin ingin logout?')">Logout</a>
    </div>

    <div class="bg-white p-8 rounded-lg shadow-lg text-center space-y-6">
        <!-- Display Counter -->
        <div class="text-4xl font-bold text-blue-600" id="counter">1</div>
        
        <!-- Navigation Buttons -->
        <div class="flex justify-center space-x-4">
            <button onclick="prevItem()" 
                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors">
                Previous
            </button>
            <button onclick="nextItem()" 
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                Next
            </button>
        </div>
        
        <!-- Additional Info (Optional) -->
        <p class="text-gray-600 text-sm" id="page-info">
            Showing item <span id="current">1</span> of <span id="total">5</span>
        </p>
    </div>

    <script>
        // Inisialisasi counter
        let currentItem = 1;
        const totalItems = 5; // Ganti dengan jumlah total item sesuai kebutuhan

        function updateDisplay() {
            document.getElementById('counter').textContent = currentItem;
            document.getElementById('current').textContent = currentItem;
            document.getElementById('total').textContent = totalItems;
        }

        function nextItem() {
            if(currentItem < totalItems) {
                currentItem++;
                updateDisplay();
            }
        }

        function prevItem() {
            if(currentItem > 1) {
                currentItem--;
                updateDisplay();
            }
        }

        // Inisialisasi awal
        updateDisplay();
    </script>
</body>
</html>

