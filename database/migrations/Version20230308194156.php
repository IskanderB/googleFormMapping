<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308194156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE files (id SERIAL NOT NULL, task_id INT DEFAULT NULL, uuid UUID NOT NULL, original_name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, filename VARCHAR(255) NOT NULL, extension VARCHAR(255) NOT NULL, mime_type VARCHAR(255) NOT NULL, size INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6354059D17F50A6 ON files (uuid)');
        $this->addSql('CREATE INDEX IDX_63540598DB60186 ON files (task_id)');
        $this->addSql('COMMENT ON COLUMN files.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE files ADD CONSTRAINT FK_63540598DB60186 FOREIGN KEY (task_id) REFERENCES tasks (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE files');
    }
}
