<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328205530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE files DROP cloud_id');
        $this->addSql('ALTER TABLE task_fields ADD type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE task_fields ALTER sheet_key DROP NOT NULL');
        $this->addSql('ALTER TABLE task_fields ALTER document_key DROP NOT NULL');
        $this->addSql('ALTER TABLE tasks DROP preview');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE files ADD cloud_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE tasks ADD preview VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE task_fields DROP type');
        $this->addSql('ALTER TABLE task_fields ALTER sheet_key SET NOT NULL');
        $this->addSql('ALTER TABLE task_fields ALTER document_key SET NOT NULL');
    }
}
