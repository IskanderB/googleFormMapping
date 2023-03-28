<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230327211906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE documents_id_seq CASCADE');
        $this->addSql('CREATE TABLE rows_documents (row_id INT NOT NULL, document_id INT NOT NULL, PRIMARY KEY(row_id, document_id))');
        $this->addSql('CREATE INDEX IDX_C88DE62E83A269F2 ON rows_documents (row_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C88DE62EC33F7837 ON rows_documents (document_id)');
        $this->addSql('ALTER TABLE rows_documents ADD CONSTRAINT FK_C88DE62E83A269F2 FOREIGN KEY (row_id) REFERENCES rows (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rows_documents ADD CONSTRAINT FK_C88DE62EC33F7837 FOREIGN KEY (document_id) REFERENCES files (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE documents');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE documents_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE documents (id SERIAL NOT NULL, row_id INT DEFAULT NULL, file_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_a2b0728893cb796c ON documents (file_id)');
        $this->addSql('CREATE INDEX idx_a2b0728883a269f2 ON documents (row_id)');
        $this->addSql('ALTER TABLE documents ADD CONSTRAINT fk_a2b0728883a269f2 FOREIGN KEY (row_id) REFERENCES rows (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE documents ADD CONSTRAINT fk_a2b0728893cb796c FOREIGN KEY (file_id) REFERENCES files (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE rows_documents');
    }
}
