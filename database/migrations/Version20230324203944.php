<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230324203944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE rows ALTER content TYPE jsonb USING content::jsonb');
        $this->addSql('ALTER TABLE rows ALTER content DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE rows ALTER content TYPE TEXT');
        $this->addSql('ALTER TABLE rows ALTER content DROP DEFAULT');
    }
}
