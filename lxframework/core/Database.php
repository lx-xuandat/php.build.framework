<?php


namespace app\core;


use MongoDB\Driver\Exception\Exception;

class Database
{

    public \PDO $pdo;

    /**
     * Database constructor.
     */
    public function __construct(array $config = [])
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable();

        $appliedMigrations = $this->getAppliedMigratons();

        $files = scandir(__MIGRATIONS__);
        $toAppliedMigrations = array_diff($files, $appliedMigrations);

        $newMigrstions = [];

        foreach ($toAppliedMigrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }

            require_once __MIGRATIONS__ . $migration;

            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className;
            $this->log("Applying migration " . $migration);
            $instance->up();
            $this->log("Applied migration " . $migration);
            $newMigrstions[] = $migration;
        }

        if (!empty($newMigrstions)) {
            $this->saveMigrations($newMigrstions);
        } else {
            $this->log("All migrations are applied.");
        }
    }

    public function saveMigrations(array $migrations)
    {
        $str = implode(',', array_map(fn($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare('INSERT INTO migrations (migration) VALUES ' . $str);
        $statement->execute();
    }

    public function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                migration VARCHAR(255),
                create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ) ENGINE=INNODB;");
    }

    public function getAppliedMigratons()
    {
        $statement = $this->pdo->prepare("select migration from migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    protected function log($message)
    {
        echo PHP_EOL . '[' . date('Y-m-d H:i:s') . '] - ' . $message . PHP_EOL;
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }
}
