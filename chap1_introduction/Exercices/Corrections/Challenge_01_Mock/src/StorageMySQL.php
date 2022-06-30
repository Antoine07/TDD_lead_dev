<?php

namespace Cart;

use PDOException;
use PDO;

class StorageMySQL implements Storable
{
    private $connect;

    public function __construct(PDO $connect)
    {
        $this->connect = $connect;
    }

    function setValue(string $name, $price): void
    {
        $checked = $this->connect->prepare('SELECT 1 FROM product WHERE name=:name');
        $result = $checked->execute([':name' => $name]);

        if (count($checked->fetch()) == 0)
            throw new \PDOException(sprintf("Le produit n'est plus en base de données %s", $name));

        $stmt = $this->connect->prepare("UPDATE product SET total = total + :total WHERE name=:name");
        $stmt->execute([':name' => $name, ':total' => $price]);
    }

    function restore(string $name): void
    {
        $checked = $this->connect->prepare('SELECT 1 FROM product WHERE name=:name');
        $checked->execute([':name' => $name]);

        if (count($checked->fetch()) == 0)
            throw new \PDOException(sprintf("Le produit n'est plus en base de données %s", $name));

        $stmt = $this->connect->prepare("UPDATE product SET total =:total WHERE name=:name");
        $stmt->execute([':name' => $name, ':total' => 0]);
    }

    function reset(): void
    {
        $stmt = $this->connect->prepare("UPDATE product SET total = 0.0");
        $stmt->execute();
    }

    public function restoreQuantity(string $name, int $quantity): void
    {

        $checked = $this->connect->prepare('SELECT 1 FROM product WHERE name=:name');
        $checked->execute([':name' => $name]);

        if (count($checked->fetch()) == 0)
            throw new \PDOException(sprintf("Le produit n'est plus en base de données %s", $name));

        $stmt = $this->connect->prepare("UPDATE product SET total =:total WHERE name=:name");
        $stmt->execute([':name' => $name, ':total' => $quantity]);
    }

    public function getStorage(): array
    {
        $result = $this->connect->prepare('SELECT SUM(total) as total FROM product');
        $result->execute();

        return $result->fetch() ?? [];
    }
}
