<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260205175613 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE advogado (id INT AUTO_INCREMENT NOT NULL, numero_oab VARCHAR(6) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE documento (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(255) NOT NULL, caminho VARCHAR(255) NOT NULL, criado_em DATETIME NOT NULL, modificado_em DATETIME NOT NULL, processo_id INT DEFAULT NULL, INDEX IDX_B6B12EC7AAA822D2 (processo_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE documento_user (documento_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_BD6DD78D45C0CF75 (documento_id), INDEX IDX_BD6DD78DA76ED395 (user_id), PRIMARY KEY (documento_id, user_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE funcionario (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, cargo VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, telefone VARCHAR(20) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE pj (id INT AUTO_INCREMENT NOT NULL, cnpj VARCHAR(14) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE processo (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(100) NOT NULL, descricao LONGTEXT DEFAULT NULL, status VARCHAR(50) DEFAULT NULL, data DATE DEFAULT NULL, proximo_prazo DATETIME DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE processo_user (processo_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_82908C0EAAA822D2 (processo_id), INDEX IDX_82908C0EA76ED395 (user_id), PRIMARY KEY (processo_id, user_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE processo_funcionario (processo_id INT NOT NULL, funcionario_id INT NOT NULL, INDEX IDX_466AA92FAAA822D2 (processo_id), INDEX IDX_466AA92F642FEB76 (funcionario_id), PRIMARY KEY (processo_id, funcionario_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, telefone VARCHAR(11) DEFAULT NULL, documentos VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE documento ADD CONSTRAINT FK_B6B12EC7AAA822D2 FOREIGN KEY (processo_id) REFERENCES processo (id)');
        $this->addSql('ALTER TABLE documento_user ADD CONSTRAINT FK_BD6DD78D45C0CF75 FOREIGN KEY (documento_id) REFERENCES documento (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE documento_user ADD CONSTRAINT FK_BD6DD78DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE processo_user ADD CONSTRAINT FK_82908C0EAAA822D2 FOREIGN KEY (processo_id) REFERENCES processo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE processo_user ADD CONSTRAINT FK_82908C0EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE processo_funcionario ADD CONSTRAINT FK_466AA92FAAA822D2 FOREIGN KEY (processo_id) REFERENCES processo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE processo_funcionario ADD CONSTRAINT FK_466AA92F642FEB76 FOREIGN KEY (funcionario_id) REFERENCES funcionario (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE documento DROP FOREIGN KEY FK_B6B12EC7AAA822D2');
        $this->addSql('ALTER TABLE documento_user DROP FOREIGN KEY FK_BD6DD78D45C0CF75');
        $this->addSql('ALTER TABLE documento_user DROP FOREIGN KEY FK_BD6DD78DA76ED395');
        $this->addSql('ALTER TABLE processo_user DROP FOREIGN KEY FK_82908C0EAAA822D2');
        $this->addSql('ALTER TABLE processo_user DROP FOREIGN KEY FK_82908C0EA76ED395');
        $this->addSql('ALTER TABLE processo_funcionario DROP FOREIGN KEY FK_466AA92FAAA822D2');
        $this->addSql('ALTER TABLE processo_funcionario DROP FOREIGN KEY FK_466AA92F642FEB76');
        $this->addSql('DROP TABLE advogado');
        $this->addSql('DROP TABLE documento');
        $this->addSql('DROP TABLE documento_user');
        $this->addSql('DROP TABLE funcionario');
        $this->addSql('DROP TABLE pj');
        $this->addSql('DROP TABLE processo');
        $this->addSql('DROP TABLE processo_user');
        $this->addSql('DROP TABLE processo_funcionario');
        $this->addSql('DROP TABLE user');
    }
}
