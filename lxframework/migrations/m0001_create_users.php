<?php


use app\core\Application;

class m0001_create_users
{
    public function up()
    {
        $db = Application::$app->db;
        $sql = '
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR (255) NOT NULL,
                firstname VARCHAR (255) NOT NULL,
                lastname VARCHAR (255) NOT NULL,
                status TINYINT NOT NULL,
                create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;
        ';
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = Application::$app->db;
        $sql = 'DROP TABLE IF EXISTS `users`';
        $db->pdo->exec($sql);
    }
}
