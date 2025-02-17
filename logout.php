<?php
session_start();

// Cek apakah logout terjadi setelah password update
if (isset($_SESSION['password_updated'])) {
    $message = "Password berhasil diperbarui! Silahkan login kembali.";
    // Hapus flag agar tidak tertampil pada logout berikutnya
    unset($_SESSION['password_updated']);
} else {
    $message = "Silahkan login kembali.";
}

// Hapus data session yang diperlukan dan destroy session
unset($_SESSION["username"]);
session_destroy();

echo "
<script type='text/javascript'>
    alert('$message');
    window.location = 'mainpage.php';
</script>
";
?>

<!-- testtt -->