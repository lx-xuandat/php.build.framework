<?php


namespace app\core;


class Migrations
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = Application::$app->db->pdo;

        $this->createTableMigrations();
        $this->refresh();
    }

    private function createTableMigrations()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS migrations (
                    id int AUTO_INCREMENT PRIMARY KEY,
                    migration VARCHAR (255),
                    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
                ) ENGINE=INNODB;';
        $this->pdo->exec($sql);
    }

    public function refresh()
    {
        $directory = __MIGRATIONS__;
        $migrationsScanned = array_diff(scandir($directory), array('..', '.'));
        $migrationsApplied = $this->getApplied();
        $migrations = array_diff($migrationsScanned, $migrationsApplied);

        $files = [];
        foreach ($migrations as $migration) {
            $class = pathinfo($migration, PATHINFO_FILENAME);
            require_once __MIGRATIONS__ . $migration;
            $object = new $class();
            $object->up();
            $files[] = $migration;
        }
        if (!empty($files)) {
            $str = implode(',', array_map(fn($m) => "('$m')", $files));
            $statement = $this->pdo->prepare('INSERT INTO migrations (migration) VALUES ' . $str);
            $statement->execute();
        } else {
            echo 'All migrations are applied';
        }

    }

    private function getApplied()
    {
        $sql = 'select migration from migrations';
        $state = $this->pdo->prepare($sql);
        $state->execute();
        return $state->fetchAll(\PDO::FETCH_COLUMN);
    }
}
