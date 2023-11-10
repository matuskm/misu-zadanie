<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231110085804CreateEshopsProductsPivotTable  extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE eshops_products (
            id INT NOT NULL AUTO_INCREMENT,
            eshop_id INT NOT NULL,
            product_id INT NOT NULL,
            PRIMARY KEY(id),
            CONSTRAINT foreign_eshop_product FOREIGN KEY (eshop_id) REFERENCES eshops(id),
            CONSTRAINT foreign_product_eshop FOREIGN KEY (product_id) REFERENCES products(id)
        )');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE eshops_products');
    }
}
