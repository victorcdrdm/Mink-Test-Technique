<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250327195516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (id SERIAL NOT NULL, breed_id INT DEFAULT NULL, age INT NOT NULL, description TEXT NOT NULL, picture VARCHAR(255) DEFAULT NULL, price_excluding_tax INT NOT NULL, for_sale BOOLEAN NOT NULL, for_sale_soon BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6AAB231FA8B4A30F ON animal (breed_id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FA8B4A30F FOREIGN KEY (breed_id) REFERENCES breed (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE animal DROP CONSTRAINT FK_6AAB231FA8B4A30F');
        $this->addSql('DROP TABLE animal');
    }
}
