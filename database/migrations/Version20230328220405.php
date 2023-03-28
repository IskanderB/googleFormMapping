<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328220405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE task_fields DROP preview');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE task_fields ADD preview BOOLEAN DEFAULT \'false\' NOT NULL');
    }
}
