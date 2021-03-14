<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210310185146 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, prix DOUBLE PRECISION NOT NULL, date DATETIME NOT NULL, INDEX IDX_35D4282C79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservations (id INT AUTO_INCREMENT NOT NULL, id_horaire_id INT NOT NULL, id_commande_id INT NOT NULL, INDEX IDX_4DA239FD4FC5C2 (id_horaire_id), INDEX IDX_4DA2399AF8E3A3 (id_commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239FD4FC5C2 FOREIGN KEY (id_horaire_id) REFERENCES horaire (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA2399AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commandes (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA2399AF8E3A3');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE reservations');
    }
}
