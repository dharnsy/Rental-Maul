<?php
$password = "petugas"; // Password yang akan di-hash
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
echo "Hashed Password: " . $hashed_password;

?>