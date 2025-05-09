<?php

declare(strict_types=1);

namespace LevelsDoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250424140454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'adds level and user xp entity';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            <<<'SQL'
            CREATE TABLE levels (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, xp_threshold INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL
        );
        $this->addSql(
            <<<'SQL'
            CREATE TABLE user_xp (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, xp INT NOT NULL, UNIQUE INDEX UNIQ_EE6D24F8A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL
        );
        $this->addSql(
            <<<'SQL'
            ALTER TABLE user_xp ADD CONSTRAINT FK_EE6D24F8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
        SQL
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql(
            <<<'SQL'
            ALTER TABLE user_xp DROP FOREIGN KEY FK_EE6D24F8A76ED395
        SQL
        );
        $this->addSql(
            <<<'SQL'
            DROP TABLE levels
        SQL
        );
        $this->addSql(
            <<<'SQL'
            DROP TABLE user_xp
        SQL
        );
    }
}
