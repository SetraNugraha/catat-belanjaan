<?php
require 'db.php';


// SELECT DATA
function getBelanjaan()
{
    global $pdo;
    try {
        $query = "SELECT * FROM belanjaan ORDER BY id DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $e) {
        die("Error : " . $e->getMessage());
    }
}

// GET TOTAL HARGA
function getTotalHarga()
{
    global $pdo;

    $query = "SELECT SUM(harga) FROM belanjaan";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return $result ?? 0;
}

// INSERT DATA
function insertBelanjaan()
{
    global $pdo;

    try {
        $nama = $_POST["nama"];
        $jumlah = $_POST["jumlah"];
        $harga = $_POST["harga"];

        $query = "INSERT INTO belanjaan (nama, jumlah, harga) VALUES (:nama, :jumlah, :harga)";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':nama', $nama, PDO::PARAM_STR);
        $stmt->bindParam(':jumlah', $jumlah, PDO::PARAM_STR);
        $stmt->bindParam(':harga', $harga, PDO::PARAM_INT);

        return $stmt->execute();
    } catch (PDOException $e) {
        die("Error :  " . $e->getMessage());
    }
}

// UPDATE STATUS
function updateStatus($id, $status)
{
    global $pdo;

    if ($status === 'progres') {
        $query = "UPDATE belanjaan SET status = 'selesai' WHERE id = :id";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    } else {
        $query = "UPDATE belanjaan SET status = 'progres' WHERE id = :id";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}

// DELETE DATA
function deleteBelanjaan($id)
{
    global $pdo;
    try {
        $query = 'DELETE FROM belanjaan WHERE id = :id';
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    } catch (PDOException $e) {
        die("Error : " . $e->getMessage());
    }
}
