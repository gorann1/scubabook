<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230508192622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE city_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE city (id INT NOT NULL, region_id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, slug VARCHAR(128) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2D5B0234989D9B62 ON city (slug)');
        $this->addSql('CREATE INDEX IDX_2D5B023498260155 ON city (region_id)');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B023498260155 FOREIGN KEY (region_id) REFERENCES region (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE city_id_seq CASCADE');
        $this->addSql('ALTER TABLE city DROP CONSTRAINT FK_2D5B023498260155');
        $this->addSql('DROP TABLE city');
    }
}
