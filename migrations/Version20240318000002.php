<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240318000002 extends AbstractMigration
{
    private array $loremDescriptions = [
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore.',
        'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.',
        'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla.',
        'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.',
        'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.'
    ];

    public function getDescription(): string
    {
        return 'Add 5 animals for each breed with Lorem Ipsum descriptions';
    }

    public function up(Schema $schema): void
    {
        // Get all breeds
        $breeds = $this->connection->fetchAllAssociative('SELECT id, name, type, category FROM breed');

        foreach ($breeds as $breed) {
            for ($i = 1; $i <= 5; $i++) {
                $name = sprintf('%s %d', $breed['name'], $i);
                $description = $this->loremDescriptions[($i - 1) % count($this->loremDescriptions)];
                
                $this->addSql(
                    'INSERT INTO animal (age, breed_id, description, price_excluding_tax, for_sale, for_sale_soon, picture) 
                    VALUES (:age, :breed_id, :description, :priceExcludingTax, :forSale, :forSaleSoon, :picture)',
                    [
                        'age' => random_int(1, 10),
                        'breed_id' => $breed['id'],
                        'description' => $description,
                        'priceExcludingTax' => random_int(100, 1000),
                        'forSale' => random_int(0, 1),
                        'forSaleSoon' => random_int(0, 1),
                        'picture' => 'https://via.placeholder.com/150'
                    ]
                );
            }
        }
    }

    public function down(Schema $schema): void
    {
        // Remove all added animals
        $this->addSql('DELETE FROM animal WHERE 1=1');
        
        // Remove description column
        $this->addSql('ALTER TABLE animal DROP COLUMN description');
    }
} 