<?php
require_once __DIR__ . '/../config/Connection.php';

class Pegawai
{
    public static function db()
    {
        return Connection::getConnection();
    }

    public static function getAll()
    {
        try {
            $stmt = self::db()->query("SELECT * FROM pegawai ORDER BY nama ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error saat mengambil data pegawai: " . $e->getMessage());
        }
    }

    public static function findById($id)
    {
        $stmt = self::db()->prepare("SELECT * FROM pegawai WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $pdo = self::db();
        $stmt = $pdo->prepare("INSERT INTO pegawai (nip, nama, jenis_kelamin, jabatan) 
                               VALUES (:nip, :nama, :jenis_kelamin, :jabatan)");
        $stmt->bindParam(':nip', $data['nip']);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':jenis_kelamin', $data['jenis_kelamin']);
        $stmt->bindParam(':jabatan', $data['jabatan']);
        return $stmt->execute();
    }

    public static function update($id, $data)
    {
        $pdo = self::db();
        $stmt = $pdo->prepare("UPDATE pegawai 
                               SET nip = :nip, nama = :nama, jenis_kelamin = :jenis_kelamin, jabatan = :jabatan 
                               WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nip', $data['nip']);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':jenis_kelamin', $data['jenis_kelamin']);
        $stmt->bindParam(':jabatan', $data['jabatan']);
        return $stmt->execute();
    }

    public static function delete($id)
    {
        $pdo = self::db();
        $stmt = $pdo->prepare("DELETE FROM pegawai WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
