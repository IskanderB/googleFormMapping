<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230304134154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE rows (id SERIAL NOT NULL, task_id INT DEFAULT NULL, content TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A8BF4A18DB60186 ON rows (task_id)');
        $this->addSql('CREATE TABLE task_fields (id SERIAL NOT NULL, task_id INT DEFAULT NULL, sheet_key VARCHAR(255) NOT NULL, document_key VARCHAR(255) NOT NULL, preview BOOLEAN DEFAULT \'false\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_454C675B8DB60186 ON task_fields (task_id)');
        $this->addSql('CREATE TABLE tasks (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, spreadsheet_id VARCHAR(255) NOT NULL, sheet_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE rows ADD CONSTRAINT FK_A8BF4A18DB60186 FOREIGN KEY (task_id) REFERENCES tasks (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task_fields ADD CONSTRAINT FK_454C675B8DB60186 FOREIGN KEY (task_id) REFERENCES tasks (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE rows DROP CONSTRAINT FK_A8BF4A18DB60186');
        $this->addSql('ALTER TABLE task_fields DROP CONSTRAINT FK_454C675B8DB60186');
        $this->addSql('DROP TABLE rows');
        $this->addSql('DROP TABLE task_fields');
        $this->addSql('DROP TABLE tasks');
    }
}
