<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210211165138 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pedido DROP FOREIGN KEY FK_C4EC16CE9D86650F');
        $this->addSql('DROP INDEX IDX_C4EC16CE9D86650F ON pedido');
        $this->addSql('ALTER TABLE pedido CHANGE user_id user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pedido ADD CONSTRAINT FK_C4EC16CE9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C4EC16CE9D86650F ON pedido (user_id_id)');
        $this->addSql('ALTER TABLE producto CHANGE tama tamaño VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE producto_pedido DROP precio_producto, DROP cantidad_producto');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pedido DROP FOREIGN KEY FK_C4EC16CE9D86650F');
        $this->addSql('DROP INDEX IDX_C4EC16CE9D86650F ON pedido');
        $this->addSql('ALTER TABLE pedido CHANGE user_id_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pedido ADD CONSTRAINT FK_C4EC16CE9D86650F FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_C4EC16CE9D86650F ON pedido (user_id)');
        $this->addSql('ALTER TABLE producto CHANGE tamaño tama VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE producto_pedido ADD precio_producto DOUBLE PRECISION NOT NULL, ADD cantidad_producto INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP is_verified');
    }
}
