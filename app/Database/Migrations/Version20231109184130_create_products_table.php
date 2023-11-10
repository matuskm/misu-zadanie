<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231109184130CreateProductsTable extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE products (
            id INT NOT NULL AUTO_INCREMENT,
            eshop_id INTEGER NOT NULL,
            name VARCHAR(255) NOT NULL,
            ean VARCHAR(18) NOT NULL,
            old_price DECIMAL(7, 2) NOT NULL,
            new_price DECIMAL(7, 2) NOT NULL,
            PRIMARY KEY(id),
            CONSTRAINT foreign_eshop_id  FOREIGN KEY (eshop_id) REFERENCES eshops(id)
        )');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS products');
    }
}
