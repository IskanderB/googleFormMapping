<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230330062422 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE locks (id SERIAL NOT NULL, locked_until TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE rows ADD lock_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rows ADD CONSTRAINT FK_A8BF4A1836D25DD FOREIGN KEY (lock_id) REFERENCES locks (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A8BF4A1836D25DD ON rows (lock_id)');
        $this->addSql('ALTER TABLE tasks ADD lock_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tasks ADD CONSTRAINT FK_50586597836D25DD FOREIGN KEY (lock_id) REFERENCES locks (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_50586597836D25DD ON tasks (lock_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE rows DROP CONSTRAINT FK_A8BF4A1836D25DD');
        $this->addSql('ALTER TABLE tasks DROP CONSTRAINT FK_50586597836D25DD');
        $this->addSql('DROP TABLE locks');
        $this->addSql('DROP INDEX UNIQ_50586597836D25DD');
        $this->addSql('ALTER TABLE tasks DROP lock_id');
        $this->addSql('DROP INDEX UNIQ_A8BF4A1836D25DD');
        $this->addSql('ALTER TABLE rows DROP lock_id');
    }
}
