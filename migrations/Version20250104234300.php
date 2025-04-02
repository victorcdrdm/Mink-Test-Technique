<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240318000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add cattle and sheep breeds';
    }

    public function up(Schema $schema): void
    {

        $this->addSql("INSERT INTO breed (name, type, category) VALUES 
            ('Angus', 'bovin', 'viande'),
            ('Texas Longhorn', 'bovin', 'viande'),
            ('Hereford', 'bovin', 'viande'),
            ('Holstein-Frisonne', 'bovin', 'laitiere'),
            ('Guernesey', 'bovin', 'laitiere')
        ");

        // Insert sheep breeds (Ovins)
        $this->addSql("INSERT INTO breed (name, type, category) VALUES 
            ('Suffolk', 'ovin', 'viande'),
            ('Texel', 'ovin', 'viande')
        ");
    }

    public function down(Schema $schema): void
    {
        // Remove the inserted breeds
        $this->addSql("DELETE FROM breed WHERE type IN ('bovin', 'ovin')");
    }
} 