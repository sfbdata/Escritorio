<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260118205647 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cliente (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telefone VARCHAR(20) NOT NULL, endereco LONGTEXT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE documento (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(255) NOT NULL, arquivo VARCHAR(255) NOT NULL, processo_id INT DEFAULT NULL, INDEX IDX_B6B12EC7AAA822D2 (processo_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE documento_cliente (documento_id INT NOT NULL, cliente_id INT NOT NULL, INDEX IDX_21A44BD345C0CF75 (documento_id), INDEX IDX_21A44BD3DE734E51 (cliente_id), PRIMARY KEY (documento_id, cliente_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE funcionario (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, cargo VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, telefone VARCHAR(20) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE processo (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(100) NOT NULL, descriçcao LONGTEXT DEFAULT NULL, status VARCHAR(50) DEFAULT NULL, data DATE DEFAULT NULL, proximo_prazo DATETIME DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE processo_cliente (processo_id INT NOT NULL, cliente_id INT NOT NULL, INDEX IDX_5894E40BAAA822D2 (processo_id), INDEX IDX_5894E40BDE734E51 (cliente_id), PRIMARY KEY (processo_id, cliente_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE processo_funcionario (processo_id INT NOT NULL, funcionario_id INT NOT NULL, INDEX IDX_466AA92FAAA822D2 (processo_id), INDEX IDX_466AA92F642FEB76 (funcionario_id), PRIMARY KEY (processo_id, funcionario_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE documento ADD CONSTRAINT FK_B6B12EC7AAA822D2 FOREIGN KEY (processo_id) REFERENCES processo (id)');
        $this->addSql('ALTER TABLE documento_cliente ADD CONSTRAINT FK_21A44BD345C0CF75 FOREIGN KEY (documento_id) REFERENCES documento (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE documento_cliente ADD CONSTRAINT FK_21A44BD3DE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE processo_cliente ADD CONSTRAINT FK_5894E40BAAA822D2 FOREIGN KEY (processo_id) REFERENCES processo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE processo_cliente ADD CONSTRAINT FK_5894E40BDE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE processo_funcionario ADD CONSTRAINT FK_466AA92FAAA822D2 FOREIGN KEY (processo_id) REFERENCES processo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE processo_funcionario ADD CONSTRAINT FK_466AA92F642FEB76 FOREIGN KEY (funcionario_id) REFERENCES funcionario (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE documento DROP FOREIGN KEY FK_B6B12EC7AAA822D2');
        $this->addSql('ALTER TABLE documento_cliente DROP FOREIGN KEY FK_21A44BD345C0CF75');
        $this->addSql('ALTER TABLE documento_cliente DROP FOREIGN KEY FK_21A44BD3DE734E51');
        $this->addSql('ALTER TABLE processo_cliente DROP FOREIGN KEY FK_5894E40BAAA822D2');
        $this->addSql('ALTER TABLE processo_cliente DROP FOREIGN KEY FK_5894E40BDE734E51');
        $this->addSql('ALTER TABLE processo_funcionario DROP FOREIGN KEY FK_466AA92FAAA822D2');
        $this->addSql('ALTER TABLE processo_funcionario DROP FOREIGN KEY FK_466AA92F642FEB76');
        $this->addSql('DROP TABLE cliente');
        $this->addSql('DROP TABLE documento');
        $this->addSql('DROP TABLE documento_cliente');
        $this->addSql('DROP TABLE funcionario');
        $this->addSql('DROP TABLE processo');
        $this->addSql('DROP TABLE processo_cliente');
        $this->addSql('DROP TABLE processo_funcionario');
    }
}
