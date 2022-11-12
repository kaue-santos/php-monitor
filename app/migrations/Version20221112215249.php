<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221112215249 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categoria ADD area_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categoria ADD CONSTRAINT FK_4E10122DBD0F409C FOREIGN KEY (area_id) REFERENCES area (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_4E10122DBD0F409C ON categoria (area_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE categoria DROP CONSTRAINT FK_4E10122DBD0F409C');
        $this->addSql('DROP INDEX IDX_4E10122DBD0F409C');
        $this->addSql('ALTER TABLE categoria DROP area_id');
    }
}
