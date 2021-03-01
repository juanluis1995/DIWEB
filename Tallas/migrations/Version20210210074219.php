<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210210074219 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pedido DROP FOREIGN KEY FK_C4EC16CE629AF449');
        $this->addSql('DROP INDEX IDX_C4EC16CE629AF449 ON pedido');
        $this->addSql('ALTER TABLE pedido ADD user_id_id INT DEFAULT NULL, DROP usuario_id_id');
        $this->addSql('ALTER TABLE pedido ADD CONSTRAINT FK_C4EC16CE9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C4EC16CE9D86650F ON pedido (user_id_id)');
        $this->addSql('ALTER TABLE producto CHANGE tama tamaño VARCHAR(10) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pedido DROP FOREIGN KEY FK_C4EC16CE9D86650F');
        $this->addSql('DROP INDEX IDX_C4EC16CE9D86650F ON pedido');
        $this->addSql('ALTER TABLE pedido ADD usuario_id_id INT NOT NULL, DROP user_id_id');
        $this->addSql('ALTER TABLE pedido ADD CONSTRAINT FK_C4EC16CE629AF449 FOREIGN KEY (usuario_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_C4EC16CE629AF449 ON pedido (usuario_id_id)');
        $this->addSql('ALTER TABLE producto CHANGE tamaño tama VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
