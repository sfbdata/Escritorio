<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260219021052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pre_cadastro ADD descricao_contrato TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE pre_cadastro ADD valor_contrato NUMERIC(10, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE pre_cadastro ALTER criado_at DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pre_cadastro DROP descricao_contrato');
        $this->addSql('ALTER TABLE pre_cadastro DROP valor_contrato');
        $this->addSql('ALTER TABLE pre_cadastro ALTER criado_at SET NOT NULL');
    }
}
