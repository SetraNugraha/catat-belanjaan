<?php
$host = 'localhost';
$dbname = 'catatbelanja';
$user = 'postgres';
$pass = 'postgresdb';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname;user=$user;password=$pass");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Koneksi Berhasil";
} catch (PDOException $e) {
    die("Koneksi Gagal: " . $e->getMessage());
}
