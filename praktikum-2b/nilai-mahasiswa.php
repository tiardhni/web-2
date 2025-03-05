<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $nama_lengkap = $_POST['nama_lengkap'];
    $mata_kuliah = $_POST['mata_kuliah'];
    $nilai_uts = $_POST['nilai_uts'];
    $nilai_uas = $_POST['nilai_uas'];
    $nilai_tugas = $_POST['nilai_tugas'];

    // Menghitung nilai akhir
    $nilai_akhir = ($nilai_uts * 0.3) + ($nilai_uas * 0.35) + ($nilai_tugas * 0.35);

    // Menentukan kelulusan
    if ($nilai_akhir >= 55) {
        $status = "Lulus";
    } else {
        $status = "Tidak Lulus";
    }

    // Menentukan grade nilai
    if ($nilai_akhir < 0 || $nilai_akhir > 100) {
        $grade = "I";
    } elseif ($nilai_akhir >= 85) {
        $grade = "A";
    } elseif ($nilai_akhir >= 70) {
        $grade = "B";
    } elseif ($nilai_akhir >= 56) {
        $grade = "C";
    } elseif ($nilai_akhir >= 36) {
        $grade = "D";
    } else {
        $grade = "E";
    }

    // Menentukan predikat nilai menggunakan switch
    switch ($grade) {
        case 'E':
            $predikat = "Sangat Kurang";
            break;
        case 'D':
            $predikat = "Kurang";
            break;
        case 'C':
            $predikat = "Cukup";
            break;
        case 'B':
            $predikat = "Memuaskan";
            break;
        case 'A':
            $predikat = "Sangat Memuaskan";
            break;
        case 'I':
            $predikat = "Tidak ada";
            break;
    }

    // Menampilkan hasil
    echo '<div class="container mt-5">';
    echo '<h2>Hasil Penilaian</h2>';
    echo '<p>Nama: ' . htmlspecialchars($nama_lengkap) . '</p>';
    echo '<p>Mata Kuliah: ' . htmlspecialchars($mata_kuliah) . '</p>';
    echo '<p>Nilai UTS: ' . htmlspecialchars($nilai_uts) . '</p>';
    echo '<p>Nilai UAS: ' . htmlspecialchars($nilai_uas) . '</p>';
    echo '<p>Nilai Tugas/Praktikum: ' . htmlspecialchars($nilai_tugas) . '</p>';
    echo '<p>Nilai Akhir: ' . number_format($nilai_akhir, 2, '.', '.') . '</p>';
    echo '<p>Status: ' . $status . '</p>';
    echo '<p>Grade: ' . $grade . '</p>';
    echo '<p>Predikat: ' . $predikat . '</p>';
    echo '</div>';
}
?>