<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210210073548 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE producto CHANGE tama tamaño VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE producto_pedido DROP precio_producto, DROP cantidad_producto');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, DROP contrase, DROP rol, CHANGE nombre nombre VARCHAR(180) NOT NULL, CHANGE correo password VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6493A909126 ON user (nombre)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE producto CHANGE tamaño tama VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE producto_pedido ADD precio_producto DOUBLE PRECISION NOT NULL, ADD cantidad_producto INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_8D93D6493A909126 ON user');
        $this->addSql('ALTER TABLE user ADD contrase VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD rol VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP roles, CHANGE nombre nombre VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password correo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
