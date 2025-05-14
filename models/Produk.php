<?php
require_once __DIR__ . '/../config/Connection.php';

class Produk {
    private static $table = 'produk';

    public static function getAll() {
        $sql = "SELECT * FROM " . self::$table;
        $stmt = Connection::getConnection()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $sql = "SELECT * FROM " . self::$table . " WHERE id = :id";
        $stmt = Connection::getConnection()->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $sql = "INSERT INTO " . self::$table . " (nama, harga, jenis_produk_id) VALUES (:nama, :harga, :jenis_produk_id)";
        $stmt = Connection::getConnection()->prepare($sql);
        return $stmt->execute([
            'nama' => $data['nama'],
            'harga' => $data['harga'],
            'jenis_produk_id' => $data['jenis_produk_id']
        ]);
    }

    public static function update($id, $data) {
        $sql = "UPDATE " . self::$table . " SET nama = :nama, harga = :harga, jenis_produk_id = :jenis_produk_id WHERE id = :id";
        $stmt = Connection::getConnection()->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'nama' => $data['nama'],
            'harga' => $data['harga'],
            'jenis_produk_id' => $data['jenis_produk_id']
        ]);
    }

    public static function delete($id) {
        $sql = "DELETE FROM " . self::$table . " WHERE id = :id";
        $stmt = Connection::getConnection()->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
?>
