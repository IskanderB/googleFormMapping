<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230312164851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE documents (id SERIAL NOT NULL, row_id INT DEFAULT NULL, file_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A2B0728883A269F2 ON documents (row_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A2B0728893CB796C ON documents (file_id)');
        $this->addSql('CREATE TABLE files (id SERIAL NOT NULL, uuid UUID NOT NULL, storage VARCHAR(255) NOT NULL, original_name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, filename VARCHAR(255) NOT NULL, extension VARCHAR(255) NOT NULL, mime_type VARCHAR(255) NOT NULL, size INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6354059D17F50A6 ON files (uuid)');
        $this->addSql('COMMENT ON COLUMN files.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE layouts (id SERIAL NOT NULL, task_id INT DEFAULT NULL, file_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_553076348DB60186 ON layouts (task_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5530763493CB796C ON layouts (file_id)');
        $this->addSql('ALTER TABLE documents ADD CONSTRAINT FK_A2B0728883A269F2 FOREIGN KEY (row_id) REFERENCES rows (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE documents ADD CONSTRAINT FK_A2B0728893CB796C FOREIGN KEY (file_id) REFERENCES files (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE layouts ADD CONSTRAINT FK_553076348DB60186 FOREIGN KEY (task_id) REFERENCES tasks (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE layouts ADD CONSTRAINT FK_5530763493CB796C FOREIGN KEY (file_id) REFERENCES files (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE documents DROP CONSTRAINT FK_A2B0728893CB796C');
        $this->addSql('ALTER TABLE layouts DROP CONSTRAINT FK_5530763493CB796C');
        $this->addSql('DROP TABLE documents');
        $this->addSql('DROP TABLE files');
        $this->addSql('DROP TABLE layouts');
    }
}
