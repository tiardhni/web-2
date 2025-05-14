<?php
require_once __DIR__ . '/../config/Connection.php';

class Anggota
{
    public static function db()
    {
        try {
            return Connection::getConnection();
        } catch (PDOException $e) {
            die("Koneksi database gagal: " . $e->getMessage());
        }
    }

    public static function getAll()
    {
        try {
            $stmt = self::db()->query("SELECT a.*, p.nama AS nama_pegawai 
                                        FROM anggota a 
                                        JOIN pegawai p ON a.pegawai_id = p.id 
                                        ORDER BY a.id DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error saat mengambil data anggota: " . $e->getMessage());
        }
    }

    public static function getById($id)
    {
        try {
            $stmt = self::db()->prepare("SELECT a.*, p.nama AS nama_pegawai 
                                         FROM anggota a 
                                         JOIN pegawai p ON a.pegawai_id = p.id 
                                         WHERE a.id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error saat mengambil data anggota: " . $e->getMessage());
        }
    }

    public static function getAllWithNama()
    {
        try {
            $sql = "SELECT a.id, p.nama AS nama_pegawai
                    FROM anggota a
                    JOIN pegawai p ON a.pegawai_id = p.id";
            return self::db()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error saat mengambil data anggota dengan nama: " . $e->getMessage());
        }
    }

    public static function create($data)
    {
        try {
            if (empty($data['pegawai_id']) || !isset($data['status_aktif']) || empty($data['kartu_diskon_id'])) {
                throw new Exception("Data yang diperlukan tidak lengkap.");
            }

            $stmt = self::db()->prepare("INSERT INTO anggota (pegawai_id, status_aktif, kartu_diskon_id) VALUES (?, ?, ?)");
            return $stmt->execute([
                $data['pegawai_id'],
                $data['status_aktif'],
                $data['kartu_diskon_id']
            ]);
        } catch (PDOException $e) {
            die("Error saat menambahkan anggota: " . $e->getMessage());
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function update($id, $data)
    {
        try {
            $stmt = self::db()->prepare("UPDATE anggota SET pegawai_id = ?, status_aktif = ?, kartu_diskon_id = ? WHERE id = ?");
            return $stmt->execute([
                $data['pegawai_id'],
                $data['status_aktif'],
                $data['kartu_diskon_id'],
                $id
            ]);
        } catch (PDOException $e) {
            die("Error saat mengupdate anggota: " . $e->getMessage());
        }
    }

    public static function delete($id)
    {
        try {
            $stmt = self::db()->prepare("DELETE FROM anggota WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            die("Error saat menghapus anggota: " . $e->getMessage());
        }
    }

    public static function getAvailablePegawai()
    {
        try {
            $sql = "SELECT p.id, p.nama 
                    FROM pegawai p 
                    LEFT JOIN anggota a ON p.id = a.pegawai_id 
                    WHERE a.pegawai_id IS NULL";
            return self::db()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error saat mengambil data pegawai yang tersedia: " . $e->getMessage());
        }
    }
}
