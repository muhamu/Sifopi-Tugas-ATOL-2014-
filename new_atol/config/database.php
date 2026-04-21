<?php
/**
 * Database Connection and Access Layer
 * Uses PDO for secure, prepared statement-based database access
 */

class Database {
    private static $instance = null;
    private $pdo;
    private $lastError = null;

    private function __construct() {
        $this->connect();
    }

    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function connect(): void {
        try {
            $host = $_ENV['DB_HOST'] ?? 'localhost';
            $port = $_ENV['DB_PORT'] ?? 3306;
            $dbname = $_ENV['DB_NAME'] ?? 'atol_akademik_smk_pi';
            $user = $_ENV['DB_USER'] ?? 'root';
            $password = $_ENV['DB_PASSWORD'] ?? '';

            $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";

            $this->pdo = new PDO(
                $dsn,
                $user,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $e) {
            die('Database connection failed: ' . htmlspecialchars($e->getMessage()));
        }
    }

    public function query(string $sql, array $params = []): PDOStatement {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            $this->lastError = $e->getMessage();
            if ($_ENV['APP_DEBUG'] ?? false) {
                error_log('SQL Error: ' . $e->getMessage() . "\nSQL: " . $sql);
            }
            throw new Exception('Database query failed. Please try again.');
        }
    }

    public function insert(string $table, array $data): int {
        $columns = array_keys($data);
        $placeholders = array_fill(0, count($columns), '?');

        $sql = "INSERT INTO {$table} (" . implode(',', $columns) . ") VALUES (" . implode(',', $placeholders) . ")";

        $this->query($sql, array_values($data));
        return (int)$this->pdo->lastInsertId();
    }

    public function update(string $table, array $data, string $where): int {
        $sets = [];
        $values = [];

        foreach ($data as $key => $value) {
            $sets[] = "{$key} = ?";
            $values[] = $value;
        }

        $sql = "UPDATE {$table} SET " . implode(', ', $sets) . " WHERE {$where}";

        $stmt = $this->query($sql, $values);
        return $stmt->rowCount();
    }

    public function delete(string $table, string $where): int {
        $sql = "DELETE FROM {$table} WHERE {$where}";
        $stmt = $this->query($sql);
        return $stmt->rowCount();
    }

    public function find(string $table, int $id, string $idColumn = 'id'): ?array {
        $sql = "SELECT * FROM {$table} WHERE {$idColumn} = ?";
        $stmt = $this->query($sql, [$id]);
        return $stmt->fetch() ?: null;
    }

    public function all(string $table, string $where = '', array $params = []): array {
        $sql = "SELECT * FROM {$table}";
        if ($where) {
            $sql .= " WHERE {$where}";
        }
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll();
    }

    public function count(string $table, string $where = '', array $params = []): int {
        $sql = "SELECT COUNT(*) as count FROM {$table}";
        if ($where) {
            $sql .= " WHERE {$where}";
        }
        $stmt = $this->query($sql, $params);
        $result = $stmt->fetch();
        return (int)($result['count'] ?? 0);
    }

    public function paginate(string $table, int $page = 1, int $perPage = 15, string $where = '', array $params = []): array {
        $total = $this->count($table, $where, $params);
        $pages = ceil($total / $perPage);
        $offset = ($page - 1) * $perPage;

        $sql = "SELECT * FROM {$table}";
        if ($where) {
            $sql .= " WHERE {$where}";
        }
        $sql .= " LIMIT ? OFFSET ?";

        $params[] = $perPage;
        $params[] = $offset;

        $stmt = $this->query($sql, $params);
        $data = $stmt->fetchAll();

        return [
            'data' => $data,
            'page' => $page,
            'per_page' => $perPage,
            'total' => $total,
            'pages' => $pages,
            'has_prev' => $page > 1,
            'has_next' => $page < $pages,
        ];
    }

    public function getLastError(): ?string {
        return $this->lastError;
    }

    public function close(): void {
        $this->pdo = null;
    }
}

// Load .env file if it exists
if (file_exists(__DIR__ . '/../.env')) {
    $env = parse_ini_file(__DIR__ . '/../.env');
    foreach ($env as $key => $value) {
        $_ENV[$key] = $value;
    }
}

// Get database instance
$db = Database::getInstance();
