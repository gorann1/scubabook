<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230527143637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE location_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE location (id INT NOT NULL, type_id INT NOT NULL, category_id INT NOT NULL, visibility_id INT NOT NULL, depth_id INT NOT NULL, current_id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, ltd NUMERIC(20, 10) DEFAULT NULL, lng NUMERIC(20, 10) DEFAULT NULL, slug VARCHAR(128) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5E9E89CB989D9B62 ON location (slug)');
        $this->addSql('CREATE INDEX IDX_5E9E89CBC54C8C93 ON location (type_id)');
        $this->addSql('CREATE INDEX IDX_5E9E89CB12469DE2 ON location (category_id)');
        $this->addSql('CREATE INDEX IDX_5E9E89CBB7157780 ON location (visibility_id)');
        $this->addSql('CREATE INDEX IDX_5E9E89CB88EF9A6A ON location (depth_id)');
        $this->addSql('CREATE INDEX IDX_5E9E89CBF58A7A5C ON location (current_id)');
        $this->addSql('CREATE TABLE location_city (location_id INT NOT NULL, city_id INT NOT NULL, PRIMARY KEY(location_id, city_id))');
        $this->addSql('CREATE INDEX IDX_AD5FB77464D218E ON location_city (location_id)');
        $this->addSql('CREATE INDEX IDX_AD5FB7748BAC62AF ON location_city (city_id)');
        $this->addSql('CREATE TABLE location_center (location_id INT NOT NULL, center_id INT NOT NULL, PRIMARY KEY(location_id, center_id))');
        $this->addSql('CREATE INDEX IDX_B82632664D218E ON location_center (location_id)');
        $this->addSql('CREATE INDEX IDX_B8263265932F377 ON location_center (center_id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBB7157780 FOREIGN KEY (visibility_id) REFERENCES visibility (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB88EF9A6A FOREIGN KEY (depth_id) REFERENCES depth (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBF58A7A5C FOREIGN KEY (current_id) REFERENCES current (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE location_city ADD CONSTRAINT FK_AD5FB77464D218E FOREIGN KEY (location_id) REFERENCES location (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE location_city ADD CONSTRAINT FK_AD5FB7748BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE location_center ADD CONSTRAINT FK_B82632664D218E FOREIGN KEY (location_id) REFERENCES location (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE location_center ADD CONSTRAINT FK_B8263265932F377 FOREIGN KEY (center_id) REFERENCES center (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE location_id_seq CASCADE');
        $this->addSql('ALTER TABLE location DROP CONSTRAINT FK_5E9E89CBC54C8C93');
        $this->addSql('ALTER TABLE location DROP CONSTRAINT FK_5E9E89CB12469DE2');
        $this->addSql('ALTER TABLE location DROP CONSTRAINT FK_5E9E89CBB7157780');
        $this->addSql('ALTER TABLE location DROP CONSTRAINT FK_5E9E89CB88EF9A6A');
        $this->addSql('ALTER TABLE location DROP CONSTRAINT FK_5E9E89CBF58A7A5C');
        $this->addSql('ALTER TABLE location_city DROP CONSTRAINT FK_AD5FB77464D218E');
        $this->addSql('ALTER TABLE location_city DROP CONSTRAINT FK_AD5FB7748BAC62AF');
        $this->addSql('ALTER TABLE location_center DROP CONSTRAINT FK_B82632664D218E');
        $this->addSql('ALTER TABLE location_center DROP CONSTRAINT FK_B8263265932F377');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE location_city');
        $this->addSql('DROP TABLE location_center');
    }
}
