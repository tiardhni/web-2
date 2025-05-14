<?php
require_once __DIR__ . '/../config/Connection.php';

class Pemesanan
{
    private static $table = 'pesanan';

    // Ambil semua pesanan dengan nama anggota dan produk
    public static function getAll()
    {
        $sql = "SELECT p.*, pg.nama AS nama_anggota, d.produk_id, prd.nama AS nama_produk, d.jumlah
                FROM pesanan p
                JOIN anggota a ON p.anggota_id = a.id
                JOIN pegawai pg ON a.pegawai_id = pg.id
                LEFT JOIN detail_pesanan d ON p.id = d.pesanan_id
                LEFT JOIN produk prd ON d.produk_id = prd.id
                ORDER BY p.id DESC";

        $pdo = Connection::getConnection();
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil 1 pesanan berdasarkan ID
    public static function getById($id)
    {
        $sql = "SELECT * FROM " . self::$table . " WHERE id = :id";
        $stmt = Connection::getConnection()->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        // Insert ke tabel pesanan (bukan ke produk atau detail_pesanan langsung)
        $sql = "INSERT INTO " . self::$table . " (anggota_id, tanggal, diskon, status_bayar)
            VALUES (:anggota_id, :tanggal, :diskon, :status_bayar)";
        $stmt = Connection::getConnection()->prepare($sql);
        $stmt->execute([
            'anggota_id' => $data['anggota_id'],
            'tanggal' => $data['tanggal'],
            'diskon' => $data['diskon'] ?? 0,
            'status_bayar' => $data['status_bayar'] ?? 0
        ]);

        // Dapatkan ID pesanan baru
        $pesanan_id = Connection::getConnection()->lastInsertId();

        // Tambahkan detail pesanan (1 produk)
        $sql_detail = "INSERT INTO detail_pesanan (pesanan_id, produk_id, jumlah)
                   VALUES (:pesanan_id, :produk_id, :jumlah)";
        $stmt_detail = Connection::getConnection()->prepare($sql_detail);
        return $stmt_detail->execute([
            'pesanan_id' => $pesanan_id,
            'produk_id' => $data['produk_id'],
            'jumlah' => $data['jumlah']
        ]);
    }

    // Update pesanan dan detail (optional: bisa ditambahkan jika diperlukan)
    public static function update($id, $data)
    {
        $sql = "UPDATE pesanan SET anggota_id = ?, tanggal = ? WHERE id = ?";
        $stmt = Connection::getConnection()->prepare($sql);
        return $stmt->execute([
            $data['anggota_id'],
            $data['tanggal'],
            $id
        ]);
    }

    // Menambahkan status pembayaran
    public static function updateStatus($id, $status)
    {
        try {
            $sql = "UPDATE pesanan SET status_bayar = ? WHERE id = ?";
            $stmt = Connection::getConnection()->prepare($sql);
            return $stmt->execute([$status, $id]);
        } catch (PDOException $e) {
            die("Error saat mengupdate status pembayaran: " . $e->getMessage());
        }
    }

    // Hapus pesanan (beserta detailnya)
    public static function delete($id)
    {
        $pdo = Connection::getConnection();

        try {
            $pdo->beginTransaction();

            // Hapus dari detail_pesanan dulu
            $stmtDetail = $pdo->prepare("DELETE FROM detail_pesanan WHERE pesanan_id = :id");
            $stmtDetail->execute(['id' => $id]);

            // Baru hapus dari pesanan
            $stmtPesanan = $pdo->prepare("DELETE FROM pesanan WHERE id = :id");
            $stmtPesanan->execute(['id' => $id]);

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            die("Error saat menghapus pesanan: " . $e->getMessage());
        }
    }

    public static function getBelumBayar()
    {
        try {
            $stmt = self::db()->prepare("SELECT * FROM pesanan WHERE status_bayar = 0 ORDER BY id DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error saat mengambil pesanan belum bayar: " . $e->getMessage());
        }
    }

    public static function db() {
    try {
        return Connection::getConnection(); // Pastikan file Connection.php benar
    } catch (PDOException $e) {
        die("Koneksi database gagal: " . $e->getMessage());
    }
}

}
