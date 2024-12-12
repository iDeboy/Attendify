<?php

declare(strict_types=1);

namespace Abstractions;

use mysqli;

require_once 'Core/functions.php';

final class DbContext {

    private readonly mysqli $db;

    public function __construct(
        ?string $hostname = null,
        ?string $username = null,
        ?string $password = null,
        ?string $database = null,
        ?int $port = null,
        ?string $socket = null
    ) {
        $this->db = new mysqli($hostname, $username, $password, $database, $port, $socket);
        $this->db->set_charset("utf8mb4");
    }

    public function begin_transaction(int $flags = 0, ?string $name = null): void {
        $this->db->autocommit(false);
        $this->db->begin_transaction($flags, $name);
    }

    public function commit(int $flag = 0, ?string $name = null): void {
        $this->db->commit($flag, $name);
        $this->db->autocommit(true);
    }

    public function rollback(int $flag = 0, ?string $name = null): void {
        $this->db->rollback($flag, $name);
        $this->db->autocommit(true);
    }

    public function query(string $query, ?array $params = null): array|false {

        $result = $this->db->execute_query($query, $params);

        if (!$result) return false;

        $entries = [];
        while ($entry = $result->fetch_object()) {
            $entries[] = $entry;
        }

        $result->free();

        return $entries;
    }

    public function execute(string $sql, string $types = "", array $values = []): bool {

        $stmt = $this->db->prepare($sql);

        if (strlen($types) !== count($values)) return false;

        if (!empty($types) && !empty($values))
            if (!$stmt->bind_param($types, ...$values)) return false;

        $result = $stmt->execute();

        $stmt->close();

        return $result;
    }
}
