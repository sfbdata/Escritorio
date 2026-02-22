<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260219034356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pre_cadastro ADD cliente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pre_cadastro ADD CONSTRAINT FK_CD10B6C1DE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id) NOT DEFERRABLE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CD10B6C1DE734E51 ON pre_cadastro (cliente_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pre_cadastro DROP CONSTRAINT FK_CD10B6C1DE734E51');
        $this->addSql('DROP INDEX UNIQ_CD10B6C1DE734E51');
        $this->addSql('ALTER TABLE pre_cadastro DROP cliente_id');
    }
}
