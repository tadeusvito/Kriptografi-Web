<?php
session_start();          // mengaktifkan session
session_destroy();       // menghapus semua session

// mengalihkan halaman sambil mengirim pesan logout
header("location:../page/login.php?pesan=logout");
