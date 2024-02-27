<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240226115657 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hotel (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, nb_etoiles INT NOT NULL, localisation VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, disponibilite VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, prix VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maison (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, nb_chambres INT NOT NULL, capacite VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, disponibilite VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, prix VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_h (id INT AUTO_INCREMENT NOT NULL, hotel_id INT DEFAULT NULL, user_id INT DEFAULT NULL, nb_adultes INT NOT NULL, nb_enfants INT NOT NULL, arrangement VARCHAR(255) NOT NULL, repartition VARCHAR(255) NOT NULL, INDEX IDX_F75FA8E33243BB18 (hotel_id), INDEX IDX_F75FA8E3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_m (id INT AUTO_INCREMENT NOT NULL, maison_id INT DEFAULT NULL, user_id INT DEFAULT NULL, nb_adultes INT NOT NULL, nb_enfants INT NOT NULL, arrangement VARCHAR(255) NOT NULL, repartition VARCHAR(255) NOT NULL, INDEX IDX_87355C6C9D67D8AF (maison_id), INDEX IDX_87355C6CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation_h ADD CONSTRAINT FK_F75FA8E33243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('ALTER TABLE reservation_h ADD CONSTRAINT FK_F75FA8E3A76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE reservation_m ADD CONSTRAINT FK_87355C6C9D67D8AF FOREIGN KEY (maison_id) REFERENCES maison (id)');
        $this->addSql('ALTER TABLE reservation_m ADD CONSTRAINT FK_87355C6CA76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_h DROP FOREIGN KEY FK_F75FA8E33243BB18');
        $this->addSql('ALTER TABLE reservation_h DROP FOREIGN KEY FK_F75FA8E3A76ED395');
        $this->addSql('ALTER TABLE reservation_m DROP FOREIGN KEY FK_87355C6C9D67D8AF');
        $this->addSql('ALTER TABLE reservation_m DROP FOREIGN KEY FK_87355C6CA76ED395');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('DROP TABLE maison');
        $this->addSql('DROP TABLE reservation_h');
        $this->addSql('DROP TABLE reservation_m');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
