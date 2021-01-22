<?php


use app\core\Application;

class m0003_create_contact
{
    public function up()
    {
        $db = Application::$app->db;
        $sql = '
            CREATE TABLE IF NOT EXISTS contact (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR (255) NOT NULL,
                subject MEDIUMTEXT NOT NULL,
                `body` MEDIUMTEXT NOT NULL,
                create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;
        ';
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = Application::$app->db;
        $sql = 'DROP TABLE IF EXISTS `contact`';
        $db->pdo->exec($sql);
    }
}
