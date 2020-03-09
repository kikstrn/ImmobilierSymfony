<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200303081224 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE logement DROP FOREIGN KEY FK_F0FD4457C9BF5A6C');
        $this->addSql('ALTER TABLE logement DROP FOREIGN KEY FK_F0FD445781B13B0E');
        $this->addSql('ALTER TABLE logement DROP FOREIGN KEY FK_F0FD4457C68BE09C');
        $this->addSql('ALTER TABLE logement DROP FOREIGN KEY FK_F0FD445713B22EC4');
        $this->addSql('ALTER TABLE logement DROP FOREIGN KEY FK_F0FD44577DC7170A');
        $this->addSql('DROP TABLE chauffage');
        $this->addSql('DROP TABLE eau_chaude');
        $this->addSql('DROP TABLE localisation');
        $this->addSql('DROP TABLE logement');
        $this->addSql('DROP TABLE type_logement');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vente');
        $this->addSql('ALTER TABLE contact DROP tel, CHANGE email email VARCHAR(255) NOT NULL, CHANGE bien logement VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE chauffage (id INT AUTO_INCREMENT NOT NULL, nom_chauffage VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE eau_chaude (id INT AUTO_INCREMENT NOT NULL, nom_eau_chaude VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE localisation (id INT AUTO_INCREMENT NOT NULL, nom_localisation VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE logement (id INT AUTO_INCREMENT NOT NULL, type_logement_id INT NOT NULL, localisation_id INT NOT NULL, chauffage_id INT NOT NULL, eau_chaude_id INT NOT NULL, vente_id INT NOT NULL, nombre_piece INT NOT NULL, prix NUMERIC(10, 2) NOT NULL, surface_totale NUMERIC(10, 2) NOT NULL, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, photo_principale VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, photo_one VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, photo_two VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, photo_three VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_F0FD445713B22EC4 (type_logement_id), INDEX IDX_F0FD44577DC7170A (vente_id), INDEX IDX_F0FD445781B13B0E (eau_chaude_id), INDEX IDX_F0FD4457C68BE09C (localisation_id), INDEX IDX_F0FD4457C9BF5A6C (chauffage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE type_logement (id INT AUTO_INCREMENT NOT NULL, nom_type_logement VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles JSON NOT NULL, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE vente (id INT AUTO_INCREMENT NOT NULL, vente VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE logement ADD CONSTRAINT FK_F0FD445713B22EC4 FOREIGN KEY (type_logement_id) REFERENCES type_logement (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE logement ADD CONSTRAINT FK_F0FD44577DC7170A FOREIGN KEY (vente_id) REFERENCES vente (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE logement ADD CONSTRAINT FK_F0FD445781B13B0E FOREIGN KEY (eau_chaude_id) REFERENCES eau_chaude (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE logement ADD CONSTRAINT FK_F0FD4457C68BE09C FOREIGN KEY (localisation_id) REFERENCES localisation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE logement ADD CONSTRAINT FK_F0FD4457C9BF5A6C FOREIGN KEY (chauffage_id) REFERENCES chauffage (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE contact ADD tel INT NOT NULL, CHANGE email email VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE logement bien VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
