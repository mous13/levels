<?php

declare(strict_types=1);

namespace LevelsDoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250505160405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'adds level banners';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            ALTER TABLE levels ADD image VARCHAR(255) DEFAULT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            ALTER TABLE levels DROP image
        SQL);
    }
}
