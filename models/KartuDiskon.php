<?php

require_once __DIR__ . '/../config/Connection.php';

class KartuDiskon {
    // Fungsi untuk mengambil semua data kartu diskon
    public static function getAll() {
        try {
            $pdo = Connection::getConnection();
            $stmt = $pdo->query('SELECT * FROM kartu_diskon');
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Jika ada error, tangani dan return false atau log error
            return false;
        }
    }

    // Fungsi untuk mengambil data kartu diskon berdasarkan ID
    public static function getById($id) {
        try {
            $pdo = Connection::getConnection();
            $stmt = $pdo->prepare('SELECT * FROM kartu_diskon WHERE id = :id');
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Fungsi untuk menambahkan data kartu diskon
    public static function create($data) {
        try {
            $pdo = Connection::getConnection();
            $stmt = $pdo->prepare('INSERT INTO kartu_diskon (nama, deskripsi, persen_diskon) VALUES (:nama, :deskripsi, :persen_diskon)');
            $stmt->execute([
                'nama' => $data['nama'],
                'deskripsi' => $data['deskripsi'],
                'persen_diskon' => $data['persen_diskon']
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Fungsi untuk mengupdate data kartu diskon
    public static function update($id, $data) {
        try {
            $pdo = Connection::getConnection();
            $stmt = $pdo->prepare('UPDATE kartu_diskon SET nama = :nama, deskripsi = :deskripsi, persen_diskon = :persen_diskon WHERE id = :id');
            $stmt->execute([
                'id' => $id,
                'nama' => $data['nama'],
                'deskripsi' => $data['deskripsi'],
                'persen_diskon' => $data['persen_diskon']
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Fungsi untuk menghapus data kartu diskon
    public static function delete($id) {
        try {
            $pdo = Connection::getConnection();
            $stmt = $pdo->prepare('DELETE FROM kartu_diskon WHERE id = :id');
            $stmt->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
