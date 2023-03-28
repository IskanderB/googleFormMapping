<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230326161030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE layouts_id_seq CASCADE');
        $this->addSql('CREATE TABLE tasks_layouts (task_id INT NOT NULL, layout_id INT NOT NULL, PRIMARY KEY(task_id, layout_id))');
        $this->addSql('CREATE INDEX IDX_57D0CB28DB60186 ON tasks_layouts (task_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_57D0CB28C22AA1A ON tasks_layouts (layout_id)');
        $this->addSql('ALTER TABLE tasks_layouts ADD CONSTRAINT FK_57D0CB28DB60186 FOREIGN KEY (task_id) REFERENCES tasks (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tasks_layouts ADD CONSTRAINT FK_57D0CB28C22AA1A FOREIGN KEY (layout_id) REFERENCES files (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE layouts');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE layouts_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE layouts (id SERIAL NOT NULL, task_id INT DEFAULT NULL, file_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_5530763493cb796c ON layouts (file_id)');
        $this->addSql('CREATE INDEX idx_553076348db60186 ON layouts (task_id)');
        $this->addSql('ALTER TABLE layouts ADD CONSTRAINT fk_553076348db60186 FOREIGN KEY (task_id) REFERENCES tasks (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE layouts ADD CONSTRAINT fk_5530763493cb796c FOREIGN KEY (file_id) REFERENCES files (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE tasks_layouts');
    }
}
