
<?php
$file = "guestbook.txt";
$pesan = "";

// Menyimpan nama dan komentar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST["nama"] ?? "");
    $komentar = trim($_POST["komentar"] ?? "");

    if ($nama != "" && $komentar != "") {
        $data = $nama . ";" . $komentar . PHP_EOL;

        if (file_put_contents($file, $data, FILE_APPEND | LOCK_EX) !== false) {
            $pesan = "Data berhasil disimpan!";
        } else {
            $pesan = "Data gagal disimpan!";
        }
    } else {
        $pesan = "Nama dan komentar harus diisi!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Guestbook</title>
</head>
<body>
    <h2>Buku Tamu</h2>

    <form method="post" action="">
        <label>Nama:</label><br>
        <input type="text" name="nama" required>
        <br><br>

        <label>Komentar:</label><br>
        <textarea name="komentar" required></textarea>
        <br><br>

        <button type="submit">Kirim</button>
    </form>

    <p><?= htmlspecialchars($pesan) ?></p>

    <hr>
    <h3>Daftar Komentar</h3>

    <?php
    if (file_exists($file)) {
        $isiFile = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($isiFile as $baris) {
            $data = explode(";", $baris, 2);

            if (count($data) == 2) {
                echo "<p><b>" .
                    htmlspecialchars($data[0]) .
                    "</b>: " .
                    htmlspecialchars($data[1]) .
                    "</p>";
            }
        }
    }
    ?>
</body>
</html>
