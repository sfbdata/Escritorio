<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260219040724 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
            $this->addSql("ALTER TABLE cliente ADD COLUMN IF NOT EXISTS contrato_arquivo VARCHAR(255) DEFAULT NULL");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
            $this->addSql('ALTER TABLE cliente DROP COLUMN IF EXISTS contrato_arquivo');
    }
}
