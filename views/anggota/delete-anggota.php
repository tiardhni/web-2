<?php
require_once __DIR__ . '/../../models/Anggota.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    Anggota::delete($id);
}

header("Location: list-anggota.php");
exit;
