<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260219035059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AB7D86653E3E11F0 ON cliente_pf (cpf)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A2CBCA4EC8C6906B ON cliente_pj (cnpj)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_AB7D86653E3E11F0');
        $this->addSql('DROP INDEX UNIQ_A2CBCA4EC8C6906B');
    }
}
