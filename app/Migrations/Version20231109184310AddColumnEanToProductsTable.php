<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231109184310AddColumnEanToProductsTable extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE products ADD COLUMN ean VARCHAR(18) NOT NULL AFTER name');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE products DROP COLUMN ean');
    }
}
