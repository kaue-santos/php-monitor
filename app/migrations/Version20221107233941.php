<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221107233941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE alertas_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE anexo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE area_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE categoria_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE comentario_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE conexao_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE evento_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ocorrencia_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE usuario_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE alertas (id INT NOT NULL, id_area_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, cor VARCHAR(255) NOT NULL, dias_inicio INT NOT NULL, dias_fim INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B96D7DC86392E9EC ON alertas (id_area_id)');
        $this->addSql('CREATE TABLE anexo (id INT NOT NULL, id_comentario_id INT DEFAULT NULL, criado_em DATE NOT NULL, descricao VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CD7EAF2C4DDA0689 ON anexo (id_comentario_id)');
        $this->addSql('CREATE TABLE area (id INT NOT NULL, nome VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE categoria (id INT NOT NULL, nome VARCHAR(255) NOT NULL, ativo BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE comentario (id INT NOT NULL, id_evento_id INT DEFAULT NULL, criado_em DATE NOT NULL, descricao VARCHAR(255) NOT NULL, tipo_operacao VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4B91E7027904465 ON comentario (id_evento_id)');
        $this->addSql('CREATE TABLE conexao (id INT NOT NULL, nome VARCHAR(255) NOT NULL, tipo VARCHAR(255) NOT NULL, host VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE evento (id INT NOT NULL, id_ocorrencia_id INT DEFAULT NULL, dados VARCHAR(255) NOT NULL, situacao VARCHAR(255) NOT NULL, reincidencia INT NOT NULL, tipo_evento VARCHAR(255) NOT NULL, ignorar BOOLEAN NOT NULL, criado_em DATE NOT NULL, atualizado_em DATE NOT NULL, chave VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_47860B056B8C8797 ON evento (id_ocorrencia_id)');
        $this->addSql('CREATE TABLE ocorrencia (id INT NOT NULL, id_categoria_id INT DEFAULT NULL, id_area_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, descricao VARCHAR(255) NOT NULL, script VARCHAR(255) NOT NULL, coluna_chave VARCHAR(255) NOT NULL, colunas VARCHAR(255) NOT NULL, ativo BOOLEAN NOT NULL, tipo_ocorrencia VARCHAR(255) NOT NULL, qtd_dias_para_atraso INT NOT NULL, qtd_dias_para_alerta_atraso INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DC6ED96110560508 ON ocorrencia (id_categoria_id)');
        $this->addSql('CREATE INDEX IDX_DC6ED9616392E9EC ON ocorrencia (id_area_id)');
        $this->addSql('CREATE TABLE ocorrencia_alertas (ocorrencia_id INT NOT NULL, alertas_id INT NOT NULL, PRIMARY KEY(ocorrencia_id, alertas_id))');
        $this->addSql('CREATE INDEX IDX_91C48674D5A456F2 ON ocorrencia_alertas (ocorrencia_id)');
        $this->addSql('CREATE INDEX IDX_91C48674506F182F ON ocorrencia_alertas (alertas_id)');
        $this->addSql('CREATE TABLE usuario (id INT NOT NULL, nome VARCHAR(255) NOT NULL, user_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, ativo BOOLEAN NOT NULL, acessos INT NOT NULL, qtd_acessos INT NOT NULL, ultimo_login DATE NOT NULL, roles TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN usuario.roles IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE alertas ADD CONSTRAINT FK_B96D7DC86392E9EC FOREIGN KEY (id_area_id) REFERENCES area (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE anexo ADD CONSTRAINT FK_CD7EAF2C4DDA0689 FOREIGN KEY (id_comentario_id) REFERENCES comentario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E7027904465 FOREIGN KEY (id_evento_id) REFERENCES evento (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE evento ADD CONSTRAINT FK_47860B056B8C8797 FOREIGN KEY (id_ocorrencia_id) REFERENCES ocorrencia (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ocorrencia ADD CONSTRAINT FK_DC6ED96110560508 FOREIGN KEY (id_categoria_id) REFERENCES categoria (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ocorrencia ADD CONSTRAINT FK_DC6ED9616392E9EC FOREIGN KEY (id_area_id) REFERENCES area (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ocorrencia_alertas ADD CONSTRAINT FK_91C48674D5A456F2 FOREIGN KEY (ocorrencia_id) REFERENCES ocorrencia (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ocorrencia_alertas ADD CONSTRAINT FK_91C48674506F182F FOREIGN KEY (alertas_id) REFERENCES alertas (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE alertas_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE anexo_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE area_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE categoria_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE comentario_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE conexao_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE evento_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ocorrencia_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE usuario_id_seq CASCADE');
        $this->addSql('ALTER TABLE alertas DROP CONSTRAINT FK_B96D7DC86392E9EC');
        $this->addSql('ALTER TABLE anexo DROP CONSTRAINT FK_CD7EAF2C4DDA0689');
        $this->addSql('ALTER TABLE comentario DROP CONSTRAINT FK_4B91E7027904465');
        $this->addSql('ALTER TABLE evento DROP CONSTRAINT FK_47860B056B8C8797');
        $this->addSql('ALTER TABLE ocorrencia DROP CONSTRAINT FK_DC6ED96110560508');
        $this->addSql('ALTER TABLE ocorrencia DROP CONSTRAINT FK_DC6ED9616392E9EC');
        $this->addSql('ALTER TABLE ocorrencia_alertas DROP CONSTRAINT FK_91C48674D5A456F2');
        $this->addSql('ALTER TABLE ocorrencia_alertas DROP CONSTRAINT FK_91C48674506F182F');
        $this->addSql('DROP TABLE alertas');
        $this->addSql('DROP TABLE anexo');
        $this->addSql('DROP TABLE area');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE comentario');
        $this->addSql('DROP TABLE conexao');
        $this->addSql('DROP TABLE evento');
        $this->addSql('DROP TABLE ocorrencia');
        $this->addSql('DROP TABLE ocorrencia_alertas');
        $this->addSql('DROP TABLE usuario');
    }
}
