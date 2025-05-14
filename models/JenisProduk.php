<?php
require_once __DIR__ . '/../config/Connection.php';

class JenisProduk
{
    private static $table = 'jenis_produk';

    public static function getAll()
    {
        $sql = "SELECT * FROM " . self::$table;
        $stmt = Connection::getConnection()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        $sql = "SELECT * FROM " . self::$table . " WHERE id = :id";
        $stmt = Connection::getConnection()->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
