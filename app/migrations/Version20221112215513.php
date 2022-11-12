<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221112215513 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categoria DROP CONSTRAINT fk_4e10122dbd0f409c');
        $this->addSql('DROP INDEX idx_4e10122dbd0f409c');
        $this->addSql('ALTER TABLE categoria RENAME COLUMN area_id TO id_area_id');
        $this->addSql('ALTER TABLE categoria ADD CONSTRAINT FK_4E10122D6392E9EC FOREIGN KEY (id_area_id) REFERENCES area (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_4E10122D6392E9EC ON categoria (id_area_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE categoria DROP CONSTRAINT FK_4E10122D6392E9EC');
        $this->addSql('DROP INDEX IDX_4E10122D6392E9EC');
        $this->addSql('ALTER TABLE categoria RENAME COLUMN id_area_id TO area_id');
        $this->addSql('ALTER TABLE categoria ADD CONSTRAINT fk_4e10122dbd0f409c FOREIGN KEY (area_id) REFERENCES area (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_4e10122dbd0f409c ON categoria (area_id)');
    }
}
