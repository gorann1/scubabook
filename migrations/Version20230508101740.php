<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230508101740 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE country_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE country (id INT NOT NULL, zone_id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, iso3 VARCHAR(3) NOT NULL, slug VARCHAR(128) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5373C966989D9B62 ON country (slug)');
        $this->addSql('CREATE INDEX IDX_5373C9669F2C3FAB ON country (zone_id)');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C9669F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE country_id_seq CASCADE');
        $this->addSql('ALTER TABLE country DROP CONSTRAINT FK_5373C9669F2C3FAB');
        $this->addSql('DROP TABLE country');
    }
}
