<?php
require 'controller.php';

// INSERT DATA
if (isset($_POST["submit"])) {
    $result = insertBelanjaan();

    if ($result) {
        echo "<script>alert('Berhasil Menambahkan Belanjaan');</script>";
        header('Location: index.php');
        exit();
    } else {
        echo "<script>alert('Gagal Menambahkan Belanjaan !');</script>";
    }
}

// UPDATE STATUS
if (isset($_GET["status"])) {
    $id = $_GET["id"];
    $status = $_GET["status"];

    $result = updateStatus($id, $status);

    if ($result) {
        header('Location: index.php');
        exit();
    } else {
        echo "<script>alert('Gagal Update Status Belanjaan !');</script>";
    }
}

// DELETE DATA
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $result = deleteBelanjaan($id);

    if ($result) {
        echo "<script>alert('Berhasil Menghapus Belanjaan');</script>";
        header('Location: index.php');
        exit();
    } else {
        echo "<script>alert('Gagal Menghapus Belanjaan !');</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catatan Belanja</title>

    <!-- Bootsrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <!-- Bootsrap Icon CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card rounded-3">
                        <div class="card-body p-4">

                            <h4 class="text-center my-3 pb-3">Belanja Apa Hari Ini ?</h4>

                            <form action="" method="post" class="g-3 justify-content-center align-items-center mb-4 pb-2">
                                <div class="row mt-5">
                                    <div class="col form-outline">
                                        <label class="form-label">Nama :</label>
                                        <input type="text" name="nama" class="form-control" autocomplete="off" required />
                                    </div>

                                    <div class="col form-outline">
                                        <label class="form-label">Jumlah :</label>
                                        <input type="text" name="jumlah" class="form-control" autocomplete="off" required />
                                    </div>

                                    <div class="col form-outline">
                                        <label class="form-label">Perkiraan Harga :</label>
                                        <input type="number" name="harga" class="form-control" required />
                                    </div>
                                </div>

                                <div class="">
                                    <button type="submit" name="submit" class="btn btn-primary w-100 mt-2">Catat Belanjaan</button>
                                </div>
                            </form>

                            <div class="mt-4">
                                <h5>Total harga : Rp. <?= number_format(getTotalHarga(), 0, ",", ".") ?> </h5>
                            </div>

                            <table class="table mb-4">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Belanjaan</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Perkiraan Harga</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $belanjaanItems = getBelanjaan() ?>
                                    <?php $no = 1 ?>
                                    <?php foreach ($belanjaanItems as $item) : ?>
                                        <?php if (empty($item)) { ?>
                                            <tr>
                                                <td colspan="5">Tidak Ada Belanjaan</td>
                                            </tr>
                                        <?php } else { ?>
                                            <tr class="<?= $item['status'] === 'progres' ?  '' : 'bg-success fw-bold ' ?>">
                                                <th scope="row" style="<?= $item['status'] === 'selesai' ? 'color: white;' : '' ?>"><?= $no++ ?></th>
                                                <td style="<?= $item['status'] === 'selesai' ? 'color: white;' : '' ?>"><?= $item['nama'] ?></td>
                                                <td style="<?= $item['status'] === 'selesai' ? 'color: white;' : '' ?>"><?= $item['jumlah'] ?></td>
                                                <td style="<?= $item['status'] === 'selesai' ? 'color: white;' : '' ?>">Rp. <?= number_format($item['harga'], 0, ",", ".") ?></td>
                                                <td>
                                                    <?php if ($item['status'] === 'progres') { ?>
                                                        <a href="?id=<?= $item['id'] ?>&status=<?= $item['status'] ?>" class="btn btn-success ms-1">
                                                            <i class="bi bi-check2-square"></i>
                                                        </a>
                                                    <?php } else { ?>
                                                        <a href="?id=<?= $item['id'] ?>&status=<?= $item['status'] ?>" class="btn btn-warning ms-1">
                                                            <i class="bi bi-x-circle"></i>
                                                        </a>
                                                    <?php } ?>
                                                    <a href="?delete=<?= $item['id'] ?>" name="delete" onclick="return confirm('Yakin Ingin Menghapus Daftar belanjaan Ini ?')" class="btn btn-danger">
                                                        <i class="bi bi-trash3"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<!-- Bootstrap CDN JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</html>