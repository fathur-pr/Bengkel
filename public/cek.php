<?php
echo "<h3>🔍 DIAGNOSA SERVER</h3>";
echo "<b>PHP Version:</b> " . phpversion() . "<br>";
echo "<b>File Pengaturan (php.ini) yang dipakai:</b> " . php_ini_loaded_file() . "<br>";
echo "<b>Status MySQLi:</b> " . (extension_loaded('mysqli') ? '<span style="color:green">AKTIF ✅</span>' : '<span style="color:red">MATI ❌</span>') . "<br>";
?>