<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250402191946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO \"user\" (email, roles, password, phone_number) VALUES ('admin@mink.fr', '[\"ROLE_ADMIN\"]', '\$2y\$13\$RlOM6g0PKBaUoZkYZPJTOeFJfBOOk3suBj7u.RVfN16j/n4vzsa.C', '0631758787')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
