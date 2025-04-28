<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250313143012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_items ADD orderitems_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_items ADD CONSTRAINT FK_62809DB0E982E6B2 FOREIGN KEY (orderitems_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_62809DB0E982E6B2 ON order_items (orderitems_id)');
        $this->addSql('ALTER TABLE payment ADD payment_id INT NOT NULL');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D4C3A3BB FOREIGN KEY (payment_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_6D28840D4C3A3BB ON payment (payment_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_items DROP FOREIGN KEY FK_62809DB0E982E6B2');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D4C3A3BB');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP INDEX IDX_62809DB0E982E6B2 ON order_items');
        $this->addSql('ALTER TABLE order_items DROP orderitems_id');
        $this->addSql('DROP INDEX IDX_6D28840D4C3A3BB ON payment');
        $this->addSql('ALTER TABLE payment DROP payment_id');
    }
}
