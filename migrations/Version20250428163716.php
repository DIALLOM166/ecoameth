<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250428163716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment DROP article_id');
        $this->addSql('ALTER TABLE image DROP user_id, CHANGE product_id product_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_items DROP FOREIGN KEY FK_62809DB0E982E6B2');
        $this->addSql('DROP INDEX IDX_62809DB0E982E6B2 ON order_items');
        $this->addSql('ALTER TABLE order_items DROP order_id, CHANGE product_id product_id INT NOT NULL, CHANGE orderitems_id order_items_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_items ADD CONSTRAINT FK_62809DB08A484C35 FOREIGN KEY (order_items_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_62809DB08A484C35 ON order_items (order_items_id)');
        $this->addSql('ALTER TABLE payment DROP user_id, DROP order_id');
        $this->addSql('ALTER TABLE shipment DROP product_id, CHANGE user_id user_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD user_id INT DEFAULT NULL, CHANGE product_id product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE order_items DROP FOREIGN KEY FK_62809DB08A484C35');
        $this->addSql('DROP INDEX IDX_62809DB08A484C35 ON order_items');
        $this->addSql('ALTER TABLE order_items ADD order_id INT DEFAULT NULL, CHANGE product_id product_id INT DEFAULT NULL, CHANGE order_items_id orderitems_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_items ADD CONSTRAINT FK_62809DB0E982E6B2 FOREIGN KEY (orderitems_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_62809DB0E982E6B2 ON order_items (orderitems_id)');
        $this->addSql('ALTER TABLE payment ADD user_id INT DEFAULT NULL, ADD order_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE shipment ADD product_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL');
    }
}
