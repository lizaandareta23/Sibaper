<!DOCTYPE html>
<html>
<head>
  <title>User</title>
  <style>
    /* CSS untuk menu navigasi vertikal */
    body {
      margin: 0;
      background-color: #e2e1e1;
    }
    ul.navbar {
      list-style-type: none;
      margin: 0;
      padding: 0;
      width: 200px;
      background-color: #2dbd6e;
      position: fixed;
      height: 100%;
      overflow: auto;
      left: 0; /* Menampilkan menu secara default */
    }
    
    ul.navbar li a {
      display: block;
      color: white;
      padding: 16px;
      text-decoration: none;
    }
    
    ul.navbar li a:hover {
      background-color: #a6f77b;
    }
    .menu-button {
      display: none; /* Menyembunyikan tombol menu */
    }
  </style>
</head>
<body>
  <div class="menu-button" onclick="toggleMenu()">&#9776;</div>
  <ul class="navbar">
  <div><img src="karawang.png" alt="" width="150" height="100"></div>
  <li><a href="penduduk.php" target=aku>Formulir Pendaftaran</a></li>
  <li><a href="lihat_penduduk2.php.?tcari" target=aku>Pengumuman</a></li>
  <li><a href="kontak.php" target=aku>Kontak</a></li>
  <li><a href="../index.php">Logout</a></li>

  </ul>
  <div>
  <iframe name=aku src="cek_sesi.php" width="1700" height="800">iii</iframe>
    </div>
  <script>
    // Fungsi untuk menampilkan menu saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
      var navbar = document.querySelector('.navbar');
      navbar.classList.add('show');
    });
  </script>
</body>
</html>
