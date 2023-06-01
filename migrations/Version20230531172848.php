<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230531172848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE booking_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE booking (id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, dive_number INT NOT NULL, divers INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, message TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE booking_location (booking_id INT NOT NULL, location_id INT NOT NULL, PRIMARY KEY(booking_id, location_id))');
        $this->addSql('CREATE INDEX IDX_65AA17463301C60 ON booking_location (booking_id)');
        $this->addSql('CREATE INDEX IDX_65AA174664D218E ON booking_location (location_id)');
        $this->addSql('ALTER TABLE booking_location ADD CONSTRAINT FK_65AA17463301C60 FOREIGN KEY (booking_id) REFERENCES booking (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE booking_location ADD CONSTRAINT FK_65AA174664D218E FOREIGN KEY (location_id) REFERENCES location (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE booking_id_seq CASCADE');
        $this->addSql('ALTER TABLE booking_location DROP CONSTRAINT FK_65AA17463301C60');
        $this->addSql('ALTER TABLE booking_location DROP CONSTRAINT FK_65AA174664D218E');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE booking_location');
    }
}
